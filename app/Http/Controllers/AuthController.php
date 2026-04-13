<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required|min:3',
        ]);

        $credenciales = [
            'correo' => $request->correo,
            'password' => $request->clave,
        ];

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            Log::channel('autenticacion')->info('Login exitoso', [
                'usuario_id' => auth()->id(),
                'correo' => auth()->user()->correo,
                'ip' => $request->ip(),
            ]);

            $rol = auth()->user()->rol;

            if ($rol === 'administrador') {
                return redirect('/dashboard/gerente');
            } elseif ($rol === 'gerente') {
                return redirect('/dashboard/empleado');
            } else {
                return redirect('/dashboard/cliente');
            }
        }

        Log::channel('autenticacion')->warning('Login fallido', [
            'correo' => $request->correo,
            'ip' => $request->ip(),
        ]);

        return back()->withErrors([
            'correo' => 'Las credenciales no son correctas.',
        ]);
    }

    public function logout(Request $request)
    {
        Log::channel('autenticacion')->info('Logout', [
            'usuario_id' => auth()->id(),
            'correo' => auth()->user()->correo,
            'ip' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}