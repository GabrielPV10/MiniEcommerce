@extends('layouts.app')
@section('title', 'Nuevo usuario')

@section('content')

<div class="page-bar">
    <div>
        <h1>Nuevo usuario</h1>
        <p class="sub">Crear una cuenta de usuario en el sistema</p>
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
            <form method="POST" action="{{ route('usuarios.store') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input
                            class="form-control"
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Juan"
                        >
                        @error('nombre')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input
                            class="form-control"
                            type="text"
                            id="apellidos"
                            name="apellidos"
                            value="{{ old('apellidos') }}"
                            placeholder="Lopez Hernandez"
                        >
                        @error('apellidos')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="correo">Correo electronico</label>
                    <input
                        class="form-control"
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="jlopez@tuxtla.tecnm.mx"
                    >
                    @error('correo')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="clave">Contrasena</label>
                        <input
                            class="form-control"
                            type="password"
                            id="clave"
                            name="clave"
                            placeholder="Minimo 6 caracteres"
                        >
                        @error('clave')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rol">Rol</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value="">-- Selecciona un rol --</option>
                            <option value="cliente"       {{ old('rol') === 'cliente'       ? 'selected' : '' }}>Cliente</option>
                            <option value="gerente"       {{ old('rol') === 'gerente'       ? 'selected' : '' }}>Gerente</option>
                            <option value="administrador" {{ old('rol') === 'administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                        @error('rol')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div style="display:flex; gap:.75rem; margin-top:.5rem;">
                    <button type="submit" class="btn btn-success">Crear usuario</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
