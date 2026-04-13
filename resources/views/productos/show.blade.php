<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Producto</title>
</head>
<body>
    <h1>Detalle del Producto</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1">
        <tr>
            <th>ID</th>
            <td>{{ $producto->id }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $producto->nombre }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $producto->descripcion }}</td>
        </tr>
        <tr>
            <th>Precio</th>
            <td>${{ number_format($producto->precio, 2) }}</td>
        </tr>
        <tr>
            <th>Existencia</th>
            <td>{{ $producto->existencia }}</td>
        </tr>
        <tr>
            <th>Vendedor</th>
            <td>
                {{ $producto->usuario->nombre ?? 'N/A' }}
                {{ $producto->usuario->apellidos ?? '' }}
            </td>
        </tr>
        <tr>
            <th>Categorías</th>
            <td>
                @forelse($producto->categorias as $categoria)
                    <span>{{ $categoria->nombre }}</span>
                    @if(!$loop->last) | @endif
                @empty
                    <span>Sin categorías</span>
                @endforelse
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <br>
    <a href="{{ route('productos.index') }}">← Volver a lista</a>

    @can('update', $producto)
        <a href="{{ route('productos.edit', $producto) }}">Editar</a>
    @endcan

    @can('delete', $producto)
        <form action="{{ route('productos.destroy', $producto) }}"
              method="POST"
              style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    @endcan
</body>
</html>