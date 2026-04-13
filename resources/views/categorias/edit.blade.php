<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - MiniEcommerce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f7fafc; }
        nav { background: #2d3748; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { color: white; font-size: 22px; font-weight: bold; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 20px; align-items: center; }
        .contenido { max-width: 600px; margin: 40px auto; padding: 0 30px; }
        h1 { color: #2d3748; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 5px; font-size: 15px; font-family: Arial, sans-serif; }
        textarea { height: 100px; resize: vertical; }
        .error { color: red; font-size: 13px; margin-top: 5px; }
        .btn { display: inline-block; padding: 10px 25px; border-radius: 5px; text-decoration: none; font-size: 15px; font-weight: bold; border: none; cursor: pointer; margin-right: 10px; }
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
        <h1>✏️ Editar Categoria</h1>

        <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $categoria->nombre) }}">
                @error('nombre') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Descripcion</label>
                <textarea name="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                @error('descripcion') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-blue">Actualizar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-gray">Cancelar</a>
        </form>
    </div>
</body>
</html>