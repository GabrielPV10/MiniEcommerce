@extends('layouts.store')
@section('title', 'Tienda — ' . config('app.name'))

@section('content')

{{-- Category strip --}}
<div class="cat-strip">
    <div class="cat-strip-inner">
        <a href="{{ route('dashboard.cliente') }}"
           class="cat-pill {{ !request('categoria') ? 'active' : '' }}">
            Todos
        </a>
        @foreach($categorias as $cat)
            <a href="{{ route('dashboard.cliente', array_filter(['categoria' => $cat->id, 'buscar' => request('buscar')])) }}"
               class="cat-pill {{ request('categoria') == $cat->id ? 'active' : '' }}">
                {{ $cat->nombre }}
            </a>
        @endforeach
    </div>
</div>

{{-- Results info --}}
@if(request('buscar') || request('categoria'))
<div class="results-bar">
    <span class="results-text">
        {{ $productos->count() }} resultado(s)
        @if(request('buscar')) para "<strong>{{ request('buscar') }}</strong>"@endif
        @if(request('categoria') && $categoriaActiva) en <strong>{{ $categoriaActiva->nombre }}</strong>@endif
    </span>
    <a href="{{ route('dashboard.cliente') }}" class="clear-link">✕ Limpiar filtros</a>
</div>
@endif

{{-- Product grid --}}
@if($productos->isNotEmpty())
<div class="product-grid">
    @foreach($productos as $producto)
    <div class="p-card">

        <div class="p-img">
            @if($producto->fotos && count($producto->fotos) > 0)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($producto->fotos[0]) }}"
                     alt="{{ $producto->nombre }}">
            @else
                <div class="p-img-placeholder">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                    </svg>
                    <span>Sin imagen</span>
                </div>
            @endif
        </div>

        <div class="p-body">
            <div class="p-cats">
                @foreach($producto->categorias->take(2) as $cat)
                    <span class="p-cat">{{ $cat->nombre }}</span>
                @endforeach
            </div>
            <p class="p-name">{{ $producto->nombre }}</p>
            <p class="p-vendor">Vendido por {{ $producto->usuario->nombre ?? '—' }}</p>
            <p class="p-price">${{ number_format($producto->precio, 2) }}</p>
            <div class="p-footer">
                @if($producto->existencia > 0)
                    <span class="p-stock-ok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        En stock
                    </span>
                @else
                    <span class="p-stock-no">Agotado</span>
                @endif
                <div style="display:flex; gap:.4rem">
                    @if($producto->existencia > 0)
                        <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                            @csrf
                            <button type="submit" class="p-ver-btn" style="background:#38a169" title="Agregar al carrito">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('productos.show', $producto) }}" class="p-ver-btn">Ver</a>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
    </svg>
    <h3>No se encontraron productos</h3>
    <p>Intenta con otro término de búsqueda o navega por las categorías.</p>
</div>
@endif

@endsection
