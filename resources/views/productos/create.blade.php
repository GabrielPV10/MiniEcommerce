<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
</head>
<body>
    <h1>Nuevo Producto</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <label>Nombre:</label>
        <input type="text" name="nombre"
               value="{{ old('nombre') }}" required>
        <br><br>

        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ old('descripcion') }}</textarea>
        <br><br>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01"
               value="{{ old('precio') }}" required>
        <br><br>

        <label>Existencia:</label>
        <input type="number" name="existencia"
               value="{{ old('existencia') }}" required>
        <br><br>

        <label>Categorías:</label><br>
        @foreach($categorias as $categoria)
            <input type="checkbox"
                   name="categorias[]"
                   value="{{ $categoria->id }}"
                   {{ in_array($categoria->id, old('categorias', [])) ? 'checked' : '' }}>
            {{ $categoria->nombre }}<br>
        @endforeach
        <br>

        <button type="submit">Guardar</button>
        <a href="{{ route('productos.index') }}">Cancelar</a>
    </form>
</body>
</html>