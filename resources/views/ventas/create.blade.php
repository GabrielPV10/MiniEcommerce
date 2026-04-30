@extends('layouts.app')
@section('title', 'Nueva Venta')

@section('content')

<div class="page-bar">
    <div>
        <h1>Nueva Venta</h1>
        <p class="sub">Registrar una nueva transaccion</p>
    </div>
    <a href="{{ route('ventas.index') }}" class="btn btn-ghost btn-sm">Cancelar</a>
</div>

<div class="wrap">
    <div class="card" style="max-width:560px">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-e">
                    <ul style="margin:0; padding-left:1.2rem">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('ventas.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="form-label">Producto</label>
                    <select name="producto_id" class="form-control">
                        <option value="">-- Selecciona un producto --</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('producto_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Vendedor</label>
                    <select name="vendedor_id" class="form-control">
                        <option value="">-- Selecciona un vendedor --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('vendedor_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombre }} {{ $usuario->apellidos }} ({{ $usuario->rol }})
                            </option>
                        @endforeach
                    </select>
                    @error('vendedor_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-control">
                        <option value="">-- Selecciona un cliente --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ old('cliente_id') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombre }} {{ $usuario->apellidos }} ({{ $usuario->rol }})
                            </option>
                        @endforeach
                    </select>
                    @error('cliente_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
                        @error('fecha') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total ($)</label>
                        <input type="number" step="0.01" name="total" class="form-control" value="{{ old('total') }}">
                        @error('total') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Ticket de compra <span class="text-muted" style="font-weight:400">(imagen, opcional)</span></label>
                    <input class="form-control" type="file" name="ticket" accept="image/*">
                    <p class="form-hint">Se guardara en disco privado. Solo el dueno y gerentes pueden verlo.</p>
                    @error('ticket') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:flex; gap:.5rem; margin-top:.5rem">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('ventas.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
