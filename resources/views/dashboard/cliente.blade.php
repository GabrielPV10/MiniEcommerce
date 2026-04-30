@extends('layouts.app')
@section('title', 'Mi panel')

@section('content')

<div class="page-bar">
    <div>
        <h1>Mi panel</h1>
        <p class="sub">Bienvenido, {{ auth()->user()->nombre }}</p>
    </div>
</div>

<div class="wrap">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat blue">
            <p class="stat-label">Mis compras</p>
            <p class="stat-num">{{ $stats['mis_compras'] }}</p>
            <p class="stat-sub">Pedidos realizados</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Total gastado</p>
            <p class="stat-num">${{ number_format($stats['total_gastado'], 0) }}</p>
            <p class="stat-sub">Acumulado</p>
        </div>
        <div class="stat">
            <p class="stat-label">Productos disponibles</p>
            <p class="stat-num">{{ $stats['productos'] }}</p>
            <p class="stat-sub">En catalogo</p>
        </div>
    </div>

    {{-- Acceso rapido --}}
    <div class="card mb-2">
        <div class="card-head">
            <h2>Navegacion rapida</h2>
        </div>
        <div class="card-body">
            <div class="qa-grid">
                <a href="{{ route('productos.index') }}" class="qa-item">
                    <p class="qa-title">Ver productos</p>
                    <p class="qa-desc">Explora el catalogo completo de productos</p>
                </a>
                <a href="{{ route('ventas.index') }}" class="qa-item">
                    <p class="qa-title">Mis compras</p>
                    <p class="qa-desc">Revisa el historial de tus pedidos</p>
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
