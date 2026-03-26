<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>
<body>
    <h1>Crear Cuenta</h1>

    {{-- Errores --}}
    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/register" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Confirmar Password:</label>
        <input type="password" name="password_confirmation" required><br><br>

        <label>Rol:</label>
        <select name="rol">
            <option value="cliente">Cliente</option>
            <option value="empleado">Empleado</option>
            <option value="gerente">Gerente</option>
        </select><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="/login">Inicia sesión</a></p>
</body>
</html>