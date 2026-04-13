<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Categoria - MiniEcommerce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f7fafc; }
        nav { background: #2d3748; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: white; font-size: 22px; font-weight: bold; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 20px; align-items: center; }
        .contenido { max-width: 600px; margin: 40px auto; padding: 0 30px; }
        h1 { color: #2d3748; margin-bottom: 20px; }
        .card { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .campo { margin-bottom: 20px; }
        .campo label { font-weight: bold; color: #4a5568; display: block; margin-bottom: 5px; }
        .campo p { color: #2d3748; font-size: 16px; }
        .btn { display: inline-block; padding: 10px 25px; border-radius: 5px; text-decoration: none; font-size: 15px; font-weight: bold; margin-right: 10px; }
        .btn-blue { background: #4299e1; color: white; }
        .btn-gray { background: #a0aec0; color: white; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}" class="logo">🛒 MiniEcommerce</a>
        <ul>
            <li><span style="color:#cbd5e0;">{{ auth()->user()->nombre }} ({{ auth()->user()->rol }})</span></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#e53e3e; color:white; border:none; padding:8px 16px; border-radius:5px; cursor:pointer;">Cerrar Sesión</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="contenido">
        <h1>📋 Detalle de Categoria</h1>

        <div class="card">
            <div class="campo">
                <label>ID</label>
                <p>{{ $categoria->id }}</p>
            </div>
            <div class="campo">
                <label>Nombre</label>
                <p>{{ $categoria->nombre }}</p>
            </div>
            <div class="campo">
                <label>Descripcion</label>
                <p>{{ $categoria->descripcion }}</p>
            </div>
            <div class="campo">
                <label>Productos en esta categoria</label>
                <p>{{ $categoria->productos->count() }} productos</p>
            </div>
        </div>

        <br>
        @can('update', $categoria)
            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-blue">Editar</a>
        @endcan
        <a href="{{ route('categorias.index') }}" class="btn btn-gray">Volver</a>
    </div>
</body>
</html>