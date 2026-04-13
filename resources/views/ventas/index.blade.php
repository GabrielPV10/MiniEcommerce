<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #1a1a2e; color: white; }
        tr:nth-child(even) { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 4px; }
        .btn-edit { background: #f0ad4e; color: white; }
        .btn-delete { background: #d9534f; color: white; border: none; cursor: pointer; padding: 5px 10px; border-radius: 4px; }
        .btn-new { background: #5cb85c; color: white; margin-bottom: 15px; display: inline-block; padding: 8px 15px; border-radius: 4px; text-decoration: none; }
        .alert { background: #dff0d8; padding: 10px; margin-bottom: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Lista de Ventas</h1>

    @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn-new">+ Nueva Venta</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto ID</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->producto_id }}</td>
                <td>{{ $venta->cliente->nombre ?? 'N/A' }} {{ $venta->cliente->apellidos ?? '' }}</td>
                <td>{{ $venta->vendedor->nombre ?? 'N/A' }} {{ $venta->vendedor->apellidos ?? '' }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>
                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn" style="background:#5bc0de;color:white;">Ver</a>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-edit">Editar</a>
                    <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('¿Eliminar venta?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>