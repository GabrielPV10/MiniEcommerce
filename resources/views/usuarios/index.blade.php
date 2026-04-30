@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')

<div class="page-bar">
    <div>
        <h1>Usuarios</h1>
        <p class="sub">Cuentas registradas en el sistema</p>
    </div>
    @can('create', App\Models\Usuario::class)
        <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-sm">+ Nuevo usuario</a>
    @endcan
</div>

<div class="wrap">

    @if(session('success'))
        <div class="alert alert-s">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td class="text-muted text-sm">{{ $usuario->id }}</td>
                        <td>
                            <strong>{{ $usuario->nombre }}</strong>
                            <span class="text-muted"> {{ $usuario->apellidos }}</span>
                        </td>
                        <td class="text-sm">{{ $usuario->correo }}</td>
                        <td>
                            @php
                                $badgeMap = [
                                    'administrador' => 'badge-red',
                                    'gerente'       => 'badge-yellow',
                                    'cliente'       => 'badge-blue',
                                ];
                                $cls = $badgeMap[$usuario->rol] ?? 'badge-gray';
                            @endphp
                            <span class="badge {{ $cls }}">{{ ucfirst($usuario->rol) }}</span>
                        </td>
                        <td>
                            <div class="actions">
                                @can('view', $usuario)
                                    <a href="{{ route('usuarios.show', $usuario) }}"
                                       class="btn btn-primary btn-sm">Ver</a>
                                @endcan
                                @can('update', $usuario)
                                    <a href="{{ route('usuarios.edit', $usuario) }}"
                                       class="btn btn-warning btn-sm">Editar</a>
                                @endcan
                                @can('delete', $usuario)
                                    <form action="{{ route('usuarios.destroy', $usuario) }}"
                                          method="POST" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Eliminar este usuario?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center; color:#718096; padding:2rem">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
