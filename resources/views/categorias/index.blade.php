<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - MiniEcommerce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f7fafc; }
        nav { background: #2d3748; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: white; font-size: 22px; font-weight: bold; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 20px; align-items: center; }
        nav ul li a { color: #cbd5e0; text-decoration: none; }
        .contenido { max-width: 1000px; margin: 40px auto; padding: 0 30px; }
        h1 { color: #2d3748; margin-bottom: 20px; }
        .btn { display: inline-block; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold; margin: 5px; }
        .btn-blue { background: #4299e1; color: white; }
        .btn-green { background: #38a169; color: white; }
        .btn-red { background: #e53e3e; color: white; }
        .alert { background: #c6f6d5; color: #276749; padding: 12px; border-radius: 5px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        th { background: #2d3748; color: white; padding: 12px 15px; text-align: left; }
        td { padding: 12px 15px; border-bottom: 1px solid #e2e8f0; }
        tr:hover { background: #f7fafc; }
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
        <h1>📦 Categorias</h1>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @can('create', App\Models\Categoria::class)
            <a href="{{ route('categorias.create') }}" class="btn btn-green">+ Nueva Categoria</a>
        @endcan

        <br><br>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>
                        @can('update', $categoria)
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-blue">Editar</a>
                        @endcan
                        @can('delete', $categoria)
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-red" onclick="return confirm('¿Eliminar categoria?')">Eliminar</button>
                            </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>