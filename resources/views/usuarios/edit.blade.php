@extends('layouts.app')
@section('title', 'Editar usuario')

@section('content')

<div class="page-bar">
    <div>
        <h1>Editar usuario</h1>
        <p class="sub">{{ $usuario->nombre }} {{ $usuario->apellidos }}</p>
    </div>
    <a href="{{ route('usuarios.index') }}" class="btn btn-ghost btn-sm">Volver</a>
</div>

<div class="wrap">

    @if($errors->any())
        <div class="alert alert-e">
            <ul style="padding-left:1rem; margin:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('usuarios.update', $usuario) }}">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre"
                               value="{{ old('nombre', $usuario->nombre) }}">
                        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input class="form-control" type="text" id="apellidos" name="apellidos"
                               value="{{ old('apellidos', $usuario->apellidos) }}">
                        @error('apellidos') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="correo">Correo electronico</label>
                    <input class="form-control" type="email" id="correo" name="correo"
                           value="{{ old('correo', $usuario->correo) }}">
                    @error('correo') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="clave">Contrasena <span class="text-muted" style="font-weight:400">(dejar vacío para no cambiar)</span></label>
                        <input class="form-control" type="password" id="clave" name="clave">
                        @error('clave') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rol">Rol</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value="">-- Selecciona un rol --</option>
                            <option value="cliente"       {{ old('rol', $usuario->rol) === 'cliente'       ? 'selected' : '' }}>Cliente</option>
                            <option value="empleado"      {{ old('rol', $usuario->rol) === 'empleado'      ? 'selected' : '' }}>Empleado</option>
                            <option value="gerente"       {{ old('rol', $usuario->rol) === 'gerente'       ? 'selected' : '' }}>Gerente</option>
                            <option value="administrador" {{ old('rol', $usuario->rol) === 'administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('rol') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div style="display:flex; gap:.75rem; margin-top:.5rem;">
                    <button type="submit" class="btn btn-warning">Actualizar usuario</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection