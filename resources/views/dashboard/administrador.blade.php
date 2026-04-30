@extends('layouts.app')
@section('title', 'Panel Administrador')

@section('content')

<div class="page-bar">
    <div>
        <h1>Panel de Administrador</h1>
        <p class="sub">Bienvenido, {{ auth()->user()->nombre }} &mdash; Vista global del sistema</p>
    </div>
</div>

<div class="wrap">

    {{-- Estadísticas generales --}}
    <div class="stats">
        <div class="stat blue">
            <p class="stat-label">Total usuarios</p>
            <p class="stat-num">{{ $stats['total_usuarios'] }}</p>
            <p class="stat-sub">Registrados en el sistema</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Vendedores</p>
            <p class="stat-num">{{ $stats['vendedores'] }}</p>
            <p class="stat-sub">Gerentes y empleados</p>
        </div>
        <div class="stat orange">
            <p class="stat-label">Compradores</p>
            <p class="stat-num">{{ $stats['compradores'] }}</p>
            <p class="stat-sub">Clientes activos</p>
        </div>
        <div class="stat blue">
            <p class="stat-label">Productos</p>
            <p class="stat-num">{{ $stats['total_productos'] }}</p>
            <p class="stat-sub">En catálogo</p>
        </div>
        <div class="stat green">
            <p class="stat-label">Ingresos totales</p>
            <p class="stat-num">${{ number_format($stats['ingresos'], 0) }}</p>
            <p class="stat-sub">Acumulado histórico</p>
        </div>
        <div class="stat">
            <p class="stat-label">Ventas</p>
            <p class="stat-num">{{ $stats['total_ventas'] }}</p>
            <p class="stat-sub">{{ $stats['ventas_validadas'] }} validadas</p>
        </div>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:1.5rem">

        {{-- Productos por categoría --}}
        <div class="card">
            <div class="card-head"><h2>Productos por categoría</h2></div>
            <div class="table-wrap">
                <table class="tbl">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th style="text-align:right">Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productosPorCategoria as $cat)
                        <tr>
                            <td>{{ $cat->nombre }}</td>
                            <td style="text-align:right">
                                <span class="badge badge-blue">{{ $cat->productos_count }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" style="text-align:center; color:#718096; padding:1.5rem">
                                Sin datos
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Producto más vendido --}}
        <div class="card">
            <div class="card-head"><h2>Producto más vendido</h2></div>
            <div class="card-body">
                @if($productoMasVendido && $productoMasVendido->ventas_count > 0)
                    <p class="stat-label">Nombre</p>
                    <p style="font-size:1.1rem; font-weight:700; margin-bottom:1rem">
                        {{ $productoMasVendido->nombre }}
                    </p>

                    <p class="stat-label">Ventas registradas</p>
                    <p class="stat-num" style="font-size:2rem; color:var(--green)">
                        {{ $productoMasVendido->ventas_count }}
                    </p>

                    <p class="stat-label" style="margin-top:.75rem">Categorías</p>
                    <div style="display:flex; gap:.35rem; flex-wrap:wrap; margin-top:.25rem">
                        @forelse($productoMasVendido->categorias as $cat)
                            <span class="badge badge-blue">{{ $cat->nombre }}</span>
                        @empty
                            <span class="text-muted text-sm">Sin categorías</span>
                        @endforelse
                    </div>

                    <div style="margin-top:1rem">
                        <a href="{{ route('productos.show', $productoMasVendido) }}" class="btn btn-primary btn-sm">
                            Ver producto
                        </a>
                    </div>
                @else
                    <p class="text-muted text-sm">No hay ventas registradas aún.</p>
                @endif
            </div>
        </div>

    </div>

    {{-- Comprador más frecuente por categoría --}}
    <div class="card" style="margin-bottom:1.5rem">
        <div class="card-head"><h2>Comprador más frecuente por categoría</h2></div>
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Comprador</th>
                        <th>Correo</th>
                        <th style="text-align:right">Compras</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($compradorPorCategoria as $item)
                    <tr>
                        <td><span class="badge badge-blue">{{ $item['categoria'] }}</span></td>
                        <td>
                            {{ $item['cliente']->nombre ?? '—' }}
                            {{ $item['cliente']->apellidos ?? '' }}
                        </td>
                        <td class="text-muted text-sm">{{ $item['cliente']->correo ?? '—' }}</td>
                        <td style="text-align:right">
                            <span class="badge badge-green">{{ $item['compras'] }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#718096; padding:1.5rem">
                            No hay ventas registradas para calcular este dato.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Acciones rápidas --}}
    <div class="card">
        <div class="card-head"><h2>Administración del sistema</h2></div>
        <div class="card-body">
            <p class="section-label mb-1">Gestión de contenido</p>
            <div class="qa-grid">
                <a href="{{ route('usuarios.index') }}" class="qa-item">
                    <p class="qa-title">Usuarios</p>
                    <p class="qa-desc">Ver, crear y administrar cuentas</p>
                </a>
                <a href="{{ route('productos.index') }}" class="qa-item">
                    <p class="qa-title">Productos</p>
                    <p class="qa-desc">Catálogo completo de productos</p>
                </a>
                <a href="{{ route('categorias.index') }}" class="qa-item">
                    <p class="qa-title">Categorías</p>
                    <p class="qa-desc">Organizar productos por categoría</p>
                </a>
                <a href="{{ route('ventas.index') }}" class="qa-item">
                    <p class="qa-title">Ventas</p>
                    <p class="qa-desc">Historial y validación de ventas</p>
                </a>
            </div>

            <p class="section-label mb-1" style="margin-top:1.25rem">Acciones rápidas</p>
            <div class="actions">
                <a href="{{ route('usuarios.create') }}"  class="btn btn-ghost btn-sm">+ Nuevo usuario</a>
                <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm">+ Nuevo producto</a>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-sm">+ Nueva categoría</a>
                <a href="{{ route('ventas.create') }}"    class="btn btn-warning btn-sm">+ Nueva venta</a>
            </div>
        </div>
    </div>

</div>
@endsection
