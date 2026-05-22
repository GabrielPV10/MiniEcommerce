<?php

namespace App\Http\Controllers;

use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correo'    => 'required|email|unique:usuarios,correo',
            'clave'     => 'required|min:6|confirmed',
        ]);

        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo'    => $request->correo,
            'clave'     => $request->clave,
            'rol'       => 'cliente',
        ]);

        Log::channel('autenticacion')->info('Nuevo registro', [
            'usuario_id' => $usuario->id,
            'correo'     => $usuario->correo,
            'ip'         => $request->ip(),
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect('/dashboard/cliente');
    }

    // ── Fase 1: verificar credenciales y generar OTP ──────────────────────────

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave'  => 'required|min:3',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario || !Hash::check($request->clave, $usuario->clave)) {
            Log::channel('autenticacion')->warning('Login fallido - credenciales incorrectas', [
                'correo' => $request->correo,
                'ip'     => $request->ip(),
            ]);

            return back()->withErrors([
                'correo' => 'Las credenciales no son correctas.',
            ]);
        }

        Log::channel('autenticacion')->info('Login fase 1 correcto - credenciales validadas', [
            'usuario_id' => $usuario->id,
            'correo'     => $usuario->correo,
            'ip'         => $request->ip(),
        ]);

        // Eliminar codigos anteriores del usuario
        CodigoVerificacion::where('usuario_id', $usuario->id)->delete();

        // Generar codigo de 6 digitos
        $codigo = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        CodigoVerificacion::create([
            'usuario_id' => $usuario->id,
            'codigo'     => $codigo,
            'expiracion' => now()->addMinutes(5),
        ]);

        Log::channel('autenticacion')->info('Codigo 2FA generado', [
            'usuario_id' => $usuario->id,
            'ip'         => $request->ip(),
        ]);

        try {
            Mail::to($usuario->correo)->send(new CodigoVerificacionMail($codigo, $usuario->nombre));
        } catch (\Exception $e) {
            Log::error('Error enviando correo 2FA: ' . $e->getMessage());
        }

        // Guardar solo el ID en sesion — NO iniciar sesion aun
        $request->session()->put('2fa_usuario_id', $usuario->id);

        return redirect()->route('2fa.show');
    }

    // ── Fase 2: mostrar formulario OTP ───────────────────────────────────────

    public function show2fa(Request $request)
    {
        if (!$request->session()->has('2fa_usuario_id')) {
            return redirect()->route('login');
        }

        return view('auth.verificar-codigo');
    }

    // ── Fase 2: validar OTP e iniciar sesion ─────────────────────────────────

    public function verify2fa(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|size:6',
        ]);

        $usuarioId = $request->session()->get('2fa_usuario_id');

        if (!$usuarioId) {
            return redirect()->route('login')->withErrors([
                'correo' => 'Sesion expirada. Inicia sesion nuevamente.',
            ]);
        }

        $registro = CodigoVerificacion::where('usuario_id', $usuarioId)
            ->latest()
            ->first();

        if (!$registro) {
            return redirect()->route('login')->withErrors([
                'correo' => 'No se encontro un codigo activo. Inicia sesion nuevamente.',
            ]);
        }

        if ($registro->estaExpirado()) {
            Log::channel('autenticacion')->warning('Codigo 2FA expirado', [
                'usuario_id' => $usuarioId,
                'ip'         => $request->ip(),
            ]);

            $registro->delete();
            $request->session()->forget('2fa_usuario_id');

            return redirect()->route('login')->withErrors([
                'correo' => 'El codigo ha expirado. Inicia sesion nuevamente.',
            ]);
        }

        if ($registro->codigo !== $request->codigo) {
            Log::channel('autenticacion')->warning('Codigo 2FA invalido', [
                'usuario_id' => $usuarioId,
                'ip'         => $request->ip(),
            ]);

            return back()->withErrors([
                'codigo' => 'El codigo ingresado es incorrecto.',
            ]);
        }

        // Codigo valido — iniciar sesion
        Log::channel('autenticacion')->info('Codigo 2FA validado correctamente', [
            'usuario_id' => $usuarioId,
            'ip'         => $request->ip(),
        ]);

        $registro->delete();
        $request->session()->forget('2fa_usuario_id');

        $usuario = Usuario::findOrFail($usuarioId);
        Auth::login($usuario);
        $request->session()->regenerate();

        $rol = $usuario->rol;

        if ($rol === 'administrador') {
            return redirect('/dashboard/administrador');
        } elseif ($rol === 'gerente') {
            return redirect('/dashboard/gerente');
        } elseif ($rol === 'empleado') {
            return redirect('/dashboard/empleado');
        } else {
            return redirect('/dashboard/cliente');
        }
    }

    // ── Logout ────────────────────────────────────────────────────────────────

    public function logout(Request $request)
    {
        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => auth()->id(),
            'correo'     => auth()->user()->correo,
            'ip'         => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
