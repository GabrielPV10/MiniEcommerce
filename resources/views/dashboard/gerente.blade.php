<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Dashboard Gerente</title></head>
<body>
    <h1>Bienvenido, {{ Auth::user()->nombre }} 👋</h1>
    <p>Rol: <strong>Gerente</strong></p>

    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>
</body>
</html>