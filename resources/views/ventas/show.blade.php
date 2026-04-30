@extends('layouts.app')
@section('title', 'Detalle de Venta')

@section('content')

<div class="page-bar">
    <div>
        <h1>Detalle de Venta</h1>
        <p class="sub">Venta #{{ $venta->id }}</p>
    </div>
    <div style="display:flex; gap:.5rem; align-items:center">
        @if($venta->validada)
            <span class="badge badge-green" style="font-size:.8rem; padding:.3rem .75rem">Validada</span>
        @else
            <span class="badge badge-yellow" style="font-size:.8rem; padding:.3rem .75rem">Pendiente</span>
        @endif
        @can('validar', $venta)
            <form action="{{ route('ventas.validar', $venta) }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn btn-success btn-sm"
                        onclick="return confirm('¿Validar esta venta y enviar correos?')">
                    Validar venta
                </button>
            </form>
        @endcan
        @can('update', $venta)
            <a href="{{ route('ventas.edit', $venta) }}" class="btn btn-warning btn-sm">Editar</a>
        @endcan
        <a href="{{ route('ventas.index') }}" class="btn btn-ghost btn-sm">Volver</a>
    </div>
</div>

<div class="wrap">
    <div class="card" style="max-width:520px">
        <div class="card-body">

            <div class="form-group">
                <span class="form-label">Producto</span>
                <p>{{ $venta->producto->nombre ?? '—' }}</p>
            </div>

            <div class="form-group">
                <span class="form-label">Cliente</span>
                <p>{{ $venta->cliente->nombre ?? '—' }} {{ $venta->cliente->apellidos ?? '' }}</p>
            </div>

            <div class="form-group">
                <span class="form-label">Vendedor</span>
                <p>{{ $venta->vendedor->nombre ?? '—' }} {{ $venta->vendedor->apellidos ?? '' }}</p>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <span class="form-label">Fecha</span>
                    <p>{{ $venta->fecha }}</p>
                </div>
                <div class="form-group">
                    <span class="form-label">Total</span>
                    <p style="color:#38a169; font-weight:700; font-size:1.1rem">${{ number_format($venta->total, 2) }}</p>
                </div>
            </div>

            <div class="form-group">
                <span class="form-label">Registrado</span>
                <p class="text-muted text-sm">{{ $venta->created_at }}</p>
            </div>

            <div class="form-group" style="margin-bottom:0">
                <span class="form-label">Ticket de compra</span>
                @if($venta->ticket)
                    <div style="margin-top:.5rem">
                        <a href="{{ route('ventas.ticket', $venta) }}" target="_blank" class="btn btn-primary btn-sm">
                            Ver ticket (disco privado)
                        </a>
                    </div>
                @else
                    <p class="text-muted text-sm">Sin ticket registrado.</p>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
