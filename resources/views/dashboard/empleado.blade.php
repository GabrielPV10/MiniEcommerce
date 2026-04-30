@extends('layouts.app')
@section('title', 'Panel de empleado')

@section('content')

<div class="page-bar">
    <div>
        <h1>Panel de empleado</h1>
        <p class="sub">Bienvenido, {{ auth()->user()->nombre }} &mdash; {{ ucfirst(auth()->user()->rol) }}</p>
    </div>
</div>

<div class="wrap">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat blue">
            <p class="stat-label">Mis productos</p>
            <p class="stat-num">{{ $stats['mis_productos'] }}</p>
            <p class="stat-sub">Publicados por ti</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Mis ventas</p>
            <p class="stat-num">{{ $stats['mis_ventas'] }}</p>
            <p class="stat-sub">Como vendedor</p>
        </div>
        <div class="stat orange">
            <p class="stat-label">Total generado</p>
            <p class="stat-num">${{ number_format($stats['total_ventas'], 0) }}</p>
            <p class="stat-sub">En ventas propias</p>
        </div>
        <div class="stat">
            <p class="stat-label">Clientes</p>
            <p class="stat-num">{{ $stats['clientes'] }}</p>
            <p class="stat-sub">Registrados</p>
        </div>
    </div>

    {{-- Acceso rapido --}}
    <div class="card mb-2">
        <div class="card-head">
            <h2>Herramientas de gestion</h2>
        </div>
        <div class="card-body">
            <div class="qa-grid">
                <a href="{{ route('productos.index') }}" class="qa-item">
                    <p class="qa-title">Productos</p>
                    <p class="qa-desc">Ver y gestionar el catalogo de productos</p>
                </a>
                <a href="{{ route('categorias.index') }}" class="qa-item">
                    <p class="qa-title">Categorias</p>
                    <p class="qa-desc">Consultar las categorias del sistema</p>
                </a>
                <a href="{{ route('ventas.index') }}" class="qa-item">
                    <p class="qa-title">Ventas</p>
                    <p class="qa-desc">Registrar y consultar ventas</p>
                </a>
            </div>

            <p class="section-label mb-1" style="margin-top:1.25rem">Acciones rapidas</p>
            <div class="actions">
                <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm">+ Nuevo producto</a>
                <a href="{{ route('ventas.create') }}" class="btn btn-warning btn-sm">+ Nueva venta</a>
            </div>
        </div>
    </div>

</div>
@endsection
