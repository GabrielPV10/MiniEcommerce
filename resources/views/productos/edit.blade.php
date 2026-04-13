<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('productos.update', $producto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre"
               value="{{ old('nombre', $producto->nombre) }}" required>
        <br><br>

        <label>Descripción:</label>
        <textarea name="descripcion" required>
            {{ old('descripcion', $producto->descripcion) }}
        </textarea>
        <br><br>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01"
               value="{{ old('precio', $producto->precio) }}" required>
        <br><br>

        <label>Existencia:</label>
        <input type="number" name="existencia"
               value="{{ old('existencia', $producto->existencia) }}" required>
        <br><br>

        <label>Categorías:</label><br>
        @foreach($categorias as $categoria)
            <input type="checkbox"
                   name="categorias[]"
                   value="{{ $categoria->id }}"
                   {{ in_array($categoria->id, old('categorias', $producto->categorias->pluck('id')->toArray())) ? 'checked' : '' }}>
            {{ $categoria->nombre }}<br>
        @endforeach
        <br>

        <button type="submit">Actualizar</button>
        <a href="{{ route('productos.index') }}">Cancelar</a>
    </form>
</body>
</html>