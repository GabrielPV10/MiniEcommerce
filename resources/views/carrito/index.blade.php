@extends('layouts.store')
@section('title', 'Mi Carrito')

@push('styles')
<style>
.cart-wrap { max-width:900px; margin:2rem auto; padding:0 1.5rem; }
.cart-title { font-size:1.4rem; font-weight:700; margin-bottom:1.5rem; color:#1a202c; }
.cart-empty { text-align:center; padding:4rem 0; color:#a0aec0; }
.cart-empty svg { width:64px; height:64px; margin-bottom:1rem; }
.cart-empty h3 { font-size:1.1rem; color:#4a5568; margin-bottom:.5rem; }
.cart-table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,.08); }
.cart-table th { background:#f7fafc; padding:.75rem 1rem; text-align:left; font-size:.75rem; font-weight:600; color:#718096; text-transform:uppercase; letter-spacing:.04em; border-bottom:1px solid #e2e8f0; }
.cart-table td { padding:.9rem 1rem; border-bottom:1px solid #f0f4f8; font-size:.9rem; vertical-align:middle; }
.cart-table tr:last-child td { border-bottom:none; }
.item-name { font-weight:600; color:#1a202c; }
.item-vendor { font-size:.75rem; color:#a0aec0; margin-top:.15rem; }
.price-cell { font-weight:700; color:#276749; }
.qty-cell { color:#4a5568; }
.remove-btn { background:none; border:none; color:#e53e3e; cursor:pointer; font-size:.8rem; text-decoration:underline; }
.remove-btn:hover { color:#c53030; }
.cart-summary { background:#fff; border-radius:10px; padding:1.5rem; margin-top:1.5rem; box-shadow:0 1px 4px rgba(0,0,0,.08); display:flex; justify-content:space-between; align-items:center; }
.summary-total { font-size:1.3rem; font-weight:800; color:#1a202c; }
.summary-label { font-size:.85rem; color:#718096; margin-bottom:.25rem; }
.btn-checkout { background:#38a169; color:#fff; border:none; border-radius:8px; padding:.75rem 2rem; font-size:1rem; font-weight:700; cursor:pointer; transition:background .15s; }
.btn-checkout:hover { background:#276749; }
.btn-seguir { color:#3182ce; text-decoration:none; font-size:.85rem; }
.btn-seguir:hover { text-decoration:underline; }
.alert-ok  { background:#f0fff4; border:1px solid #9ae6b4; color:#276749; padding:.75rem 1rem; border-radius:6px; margin-bottom:1rem; }
.alert-err { background:#fff5f5; border:1px solid #feb2b2; color:#c53030; padding:.75rem 1rem; border-radius:6px; margin-bottom:1rem; }
</style>
@endpush

@section('content')
<div class="cart-wrap">

    <h1 class="cart-title">Mi carrito</h1>

    @if(session('cart_ok'))
        <div class="alert-ok">{{ session('cart_ok') }}</div>
    @endif
    @if(session('cart_error'))
        <div class="alert-err">{{ session('cart_error') }}</div>
    @endif

    @if($productos->isEmpty())
        <div class="cart-empty">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <h3>Tu carrito está vacío</h3>
            <p>Agrega productos desde la tienda.</p>
            <a href="{{ route('dashboard.cliente') }}" style="margin-top:1rem; display:inline-block; color:#3182ce;">
                ← Ir a la tienda
            </a>
        </div>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $item)
                <tr>
                    <td>
                        <div class="item-name">{{ $item->nombre }}</div>
                        <div class="item-vendor">Vendido por {{ $item->usuario->nombre ?? '—' }}</div>
                    </td>
                    <td class="price-cell">${{ number_format($item->precio, 2) }}</td>
                    <td class="qty-cell">{{ $item->cantidad }}</td>
                    <td class="price-cell">${{ number_format($item->precio * $item->cantidad, 2) }}</td>
                    <td>
                        <form action="{{ route('carrito.remover', $item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="remove-btn">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-summary">
            <a href="{{ route('dashboard.cliente') }}" class="btn-seguir">← Seguir comprando</a>
            <div style="text-align:right">
                <div class="summary-label">Total a pagar</div>
                <div class="summary-total">${{ number_format($total, 2) }}</div>
            </div>
            <form action="{{ route('carrito.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-checkout"
                        onclick="return confirm('¿Confirmar compra de ${{ number_format($total, 2) }}?')">
                    Confirmar compra
                </button>
            </form>
        </div>
    @endif

</div>
@endsection
