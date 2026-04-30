@extends('layouts.app')
@section('title', 'Panel de administracion')

@section('content')

<div class="page-bar">
    <div>
        <h1>Panel de administracion</h1>
        <p class="sub">Bienvenido, {{ auth()->user()->nombre }} &mdash; {{ ucfirst(auth()->user()->rol) }}</p>
    </div>
</div>

<div class="wrap">

    {{-- Stats --}}
    <div class="stats">
        <div class="stat blue">
            <p class="stat-label">Usuarios registrados</p>
            <p class="stat-num">{{ $stats['usuarios'] }}</p>
            <p class="stat-sub">En el sistema</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Productos activos</p>
            <p class="stat-num">{{ $stats['productos'] }}</p>
            <p class="stat-sub">En catalogo</p>
        </div>
        <div class="stat orange">
            <p class="stat-label">Ventas registradas</p>
            <p class="stat-num">{{ $stats['ventas'] }}</p>
            <p class="stat-sub">Total historico</p>
        </div>
        <div class="stat">
            <p class="stat-label">Categorias</p>
            <p class="stat-num">{{ $stats['categorias'] }}</p>
            <p class="stat-sub">Definidas</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Ingresos totales</p>
            <p class="stat-num">${{ number_format($stats['ingresos'], 0) }}</p>
            <p class="stat-sub">Acumulado</p>
        </div>
    </div>

    {{-- Acceso rapido --}}
    <div class="card mb-2">
        <div class="card-head">
            <h2>Administracion del sistema</h2>
        </div>
        <div class="card-body">
            <p class="section-label mb-1">Gestion de contenido</p>
            <div class="qa-grid">
                <a href="{{ route('usuarios.index') }}" class="qa-item">
                    <p class="qa-title">Usuarios</p>
                    <p class="qa-desc">Ver, crear y administrar cuentas de usuario</p>
                </a>
                <a href="{{ route('productos.index') }}" class="qa-item">
                    <p class="qa-title">Productos</p>
                    <p class="qa-desc">Catalogo completo de productos disponibles</p>
                </a>
                <a href="{{ route('categorias.index') }}" class="qa-item">
                    <p class="qa-title">Categorias</p>
                    <p class="qa-desc">Organiza los productos por categoria</p>
                </a>
                <a href="{{ route('ventas.index') }}" class="qa-item">
                    <p class="qa-title">Ventas</p>
                    <p class="qa-desc">Historial y registro de transacciones</p>
                </a>
            </div>

            <p class="section-label mb-1" style="margin-top:1.25rem">Acciones rapidas</p>
            <div class="actions">
                <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm">+ Nuevo producto</a>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm">+ Nueva categoria</a>
                <a href="{{ route('ventas.create') }}" class="btn btn-warning btn-sm">+ Nueva venta</a>
                <a href="{{ route('usuarios.create') }}" class="btn btn-ghost btn-sm">+ Nuevo usuario</a>
            </div>
        </div>
    </div>

</div>
@endsection
