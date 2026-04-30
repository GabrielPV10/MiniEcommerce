@extends('layouts.app')
@section('title', 'MiniEcommerce - Tienda en linea')

@section('content')

<style>
    .hero {
        background: #1a202c;
        color: #fff;
        padding: 5rem 2rem;
        text-align: center;
    }
    .hero h1 { font-size: 2.5rem; font-weight: 700; margin-bottom: .75rem; line-height: 1.2; }
    .hero p  { font-size: 1.1rem; color: #a0aec0; margin-bottom: 2rem; max-width: 500px; margin-left: auto; margin-right: auto; }
    .hero-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-hero-primary {
        background: #3182ce;
        color: #fff;
        padding: .7rem 1.75rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: background .15s;
    }
    .btn-hero-primary:hover { background: #2b6cb0; }
    .btn-hero-ghost {
        background: transparent;
        color: #e2e8f0;
        padding: .7rem 1.75rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        border: 1px solid #4a5568;
        transition: border-color .15s, color .15s;
    }
    .btn-hero-ghost:hover { border-color: #e2e8f0; color: #fff; }

    .features {
        background: #f7fafc;
        padding: 4rem 2rem;
    }
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        max-width: 1100px;
        margin: 0 auto;
    }
    .feature-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 4px;
        padding: 1.75rem;
    }
    .feature-icon {
        width: 42px;
        height: 42px;
        background: #ebf8ff;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }
    .feature-icon svg { width: 22px; height: 22px; stroke: #3182ce; fill: none; stroke-width: 2; }
    .feature-card h3 { font-size: 1rem; font-weight: 600; margin-bottom: .5rem; color: #1a202c; }
    .feature-card p  { font-size: .875rem; color: #718096; line-height: 1.6; }

    .cta-strip {
        background: #2b6cb0;
        color: #fff;
        text-align: center;
        padding: 3.5rem 2rem;
    }
    .cta-strip h2 { font-size: 1.75rem; font-weight: 700; margin-bottom: .5rem; }
    .cta-strip p  { color: #bee3f8; margin-bottom: 1.5rem; }
    .btn-cta {
        background: #fff;
        color: #2b6cb0;
        padding: .65rem 1.75rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: 700;
        font-size: .9375rem;
        transition: background .15s;
    }
    .btn-cta:hover { background: #ebf8ff; }
</style>

{{-- Hero --}}
<section class="hero">
    <h1>Tu tienda en linea de confianza</h1>
    <p>Encuentra los mejores productos con la mejor atencion al cliente.</p>
    <div class="hero-btns">
        @auth
            @php $rol = auth()->user()->rol; @endphp
            @if($rol === 'administrador')
                <a href="{{ route('dashboard.gerente') }}" class="btn-hero-primary">Ir al panel</a>
            @elseif($rol === 'gerente')
                <a href="{{ route('dashboard.empleado') }}" class="btn-hero-primary">Ir al panel</a>
            @else
                <a href="{{ route('dashboard.cliente') }}" class="btn-hero-primary">Mi panel</a>
            @endif
            <a href="{{ route('productos.index') }}" class="btn-hero-ghost">Ver productos</a>
        @else
            <a href="{{ route('register') }}" class="btn-hero-primary">Crear cuenta gratis</a>
            <a href="{{ route('login') }}"    class="btn-hero-ghost">Iniciar sesion</a>
        @endauth
    </div>
</section>

{{-- Features --}}
<section class="features">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M5 8h14M5 8a2 2 0 010-4h14a2 2 0 010 4M5 8l1 13h12L19 8"/></svg>
            </div>
            <h3>Catalogo amplio</h3>
            <p>Accede a una variedad de productos organizados por categoria.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h3>Compra segura</h3>
            <p>Tus datos siempre protegidos con los mas altos estandares.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2M3 10a2 2 0 012-2h2M3 10a2 2 0 000 4M3 14a2 2 0 002 2h2m6-8v8M9 8h6"/></svg>
            </div>
            <h3>Gestion de ventas</h3>
            <p>Registra y controla todas las transacciones desde un solo lugar.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <svg viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <h3>Control por roles</h3>
            <p>Administradores, gerentes y clientes con accesos diferenciados.</p>
        </div>
    </div>
</section>

{{-- CTA --}}
@guest
<section class="cta-strip">
    <h2>Empieza hoy sin costo</h2>
    <p>Registrate en segundos y accede al catalogo completo de productos.</p>
    <a href="{{ route('register') }}" class="btn-cta">Crear mi cuenta</a>
</section>
@endguest

@endsection
