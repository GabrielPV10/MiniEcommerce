<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        label { font-weight: bold; }
        .btn-save { background: #f0ad4e; color: white; padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-back { background: #ccc; color: black; text-decoration: none; padding: 8px 15px; border-radius: 4px; }
        .error { color: red; font-size: 13px; margin-top: -10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Editar Venta</h1>

    <form method="POST" action="{{ route('ventas.update', $venta->id) }}">
        @csrf
        @method('PUT')

        <label>Producto ID</label>
        <input type="number" name="producto_id" value="{{ old('producto_id', $venta->producto_id) }}">
        @error('producto_id') <p class="error">{{ $message }}</p> @enderror

        <label>Vendedor</label>
        <select name="vendedor_id">
            <option value="">-- Selecciona un vendedor --</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('vendedor_id', $venta->vendedor_id) == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }} {{ $usuario->apellidos }} ({{ $usuario->rol }})
                </option>
            @endforeach
        </select>
        @error('vendedor_id') <p class="error">{{ $message }}</p> @enderror

        <label>Cliente</label>
        <select name="cliente_id">
            <option value="">-- Selecciona un cliente --</option>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ old('cliente_id', $venta->cliente_id) == $usuario->id ? 'selected' : '' }}>
                    {{ $usuario->nombre }} {{ $usuario->apellidos }} ({{ $usuario->rol }})
                </option>
            @endforeach
        </select>
        @error('cliente_id') <p class="error">{{ $message }}</p> @enderror

        <label>Fecha</label>
        <input type="date" name="fecha" value="{{ old('fecha', $venta->fecha) }}">
        @error('fecha') <p class="error">{{ $message }}</p> @enderror

        <label>Total</label>
        <input type="number" step="0.01" name="total" value="{{ old('total', $venta->total) }}">
        @error('total') <p class="error">{{ $message }}</p> @enderror

        <button type="submit" class="btn-save">Actualizar</button>
        <a href="{{ route('ventas.index') }}" class="btn-back">Cancelar</a>
    </form>
</body>
</html>