<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Usuario</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .campo { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .btn-back { background: #ccc; color: black; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Detalle de Usuario</h1>

    <div class="campo">
        <span class="label">ID:</span> {{ $usuario->id }}
    </div>
    <div class="campo">
        <span class="label">Nombre:</span> {{ $usuario->nombre }}
    </div>
    <div class="campo">
        <span class="label">Email:</span> {{ $usuario->email }}
    </div>
    <div class="campo">
        <span class="label">Rol:</span> {{ $usuario->rol }}
    </div>
    <div class="campo">
        <span class="label">Creado:</span> {{ $usuario->created_at }}
    </div>

    <a href="{{ route('usuarios.index') }}" class="btn-back">Volver a la lista</a>
</body>
</html>