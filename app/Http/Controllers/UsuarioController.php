<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UsuarioController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Usuario::class);
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $this->authorize('create', Usuario::class);
        return view('usuarios.create');
    }

    public function store(StoreUsuarioRequest $request)
    {
        $this->authorize('create', Usuario::class);

        Usuario::create([
            'nombre'    => $request->nombre,
            'apellidos' => $request->apellidos,
            'correo'    => $request->correo,
            'clave'     => $request->clave,
            'rol'       => $request->rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show(Usuario $usuario)
    {
        $this->authorize('view', $usuario);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $this->authorize('update', $usuario);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        $this->authorize('update', $usuario);

        $usuario->nombre    = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo    = $request->correo;
        $usuario->rol       = $request->rol;

        if ($request->filled('clave')) {
            $usuario->clave = $request->clave;
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $this->authorize('delete', $usuario);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}