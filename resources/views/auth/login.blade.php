<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    {{-- Errores --}}
    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif

    <form action="/login" method="POST">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>¿No tienes cuenta? <a href="/register">Regístrate</a></p>
</body>
</html>