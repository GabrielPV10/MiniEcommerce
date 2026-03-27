<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        label { font-weight: bold; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-save { background: #5cb85c; color: white; }
        .btn-back { background: #ccc; color: black; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
        .error { color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Crear Usuario</h1>

    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf

        <label>Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}">
        @error('nombre') <p class="error">{{ $message }}</p> @enderror

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="error">{{ $message }}</p> @enderror

        <label>Password</label>
        <input type="password" name="password">
        @error('password') <p class="error">{{ $message }}</p> @enderror

        <label>Rol</label>
        <select name="rol">
            <option value="">-- Selecciona un rol --</option>
            <option value="cliente" {{ old('rol') == 'cliente' ? 'selected' : '' }}>Cliente</option>
            <option value="empleado" {{ old('rol') == 'empleado' ? 'selected' : '' }}>Empleado</option>
            <option value="gerente" {{ old('rol') == 'gerente' ? 'selected' : '' }}>Gerente</option>
        </select>
        @error('rol') <p class="error">{{ $message }}</p> @enderror

        <button type="submit" class="btn btn-save">Guardar</button>
        <a href="{{ route('usuarios.index') }}" class="btn-back">Cancelar</a>
    </form>
</body>
</html>