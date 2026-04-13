<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Venta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .campo { margin-bottom: 15px; }
        .label { font-weight: bold; }
        .btn-back { background: #ccc; color: black; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
        .btn-edit { background: #f0ad4e; color: white; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Detalle de Venta</h1>

    <div class="campo">
        <span class="label">ID:</span> {{ $venta->id }}
    </div>
    <div class="campo">
        <span class="label">Producto ID:</span> {{ $venta->producto_id }}
    </div>
    <div class="campo">
        <span class="label">Cliente:</span>
        {{ $venta->cliente->nombre ?? 'N/A' }} {{ $venta->cliente->apellidos ?? '' }}
    </div>
    <div class="campo">
        <span class="label">Vendedor:</span>
        {{ $venta->vendedor->nombre ?? 'N/A' }} {{ $venta->vendedor->apellidos ?? '' }}
    </div>
    <div class="campo">
        <span class="label">Fecha:</span> {{ $venta->fecha }}
    </div>
    <div class="campo">
        <span class="label">Total:</span> ${{ number_format($venta->total, 2) }}
    </div>
    <div class="campo">
        <span class="label">Creado:</span> {{ $venta->created_at }}
    </div>

    <a href="{{ route('ventas.index') }}" class="btn-back">Volver a la lista</a>
    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn-edit">Editar</a>
</body>
</html>