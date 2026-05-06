@extends('layouts.store')
@section('title', $producto->nombre . ' — ' . config('app.name'))

@push('styles')
<style>
    .store-detail { max-width:1100px; margin:2rem auto; padding:0 1.5rem; }
    .breadcrumb { font-size:.8rem; color:#a0aec0; margin-bottom:1.5rem; }
    .breadcrumb a { color:#3182ce; text-decoration:none; }
    .breadcrumb a:hover { text-decoration:underline; }

    .detail-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:2.5rem;
        align-items:start;
    }
    @media(max-width:700px) { .detail-grid { grid-template-columns:1fr; } }

    .gallery-main {
        width:100%; aspect-ratio:1;
        border-radius:12px; overflow:hidden;
        border:1px solid #e2e8f0;
        background:#f7fafc;
        display:flex; align-items:center; justify-content:center;
    }
    .gallery-main img { width:100%; height:100%; object-fit:cover; }
    .gallery-placeholder { display:flex; flex-direction:column; align-items:center; gap:.75rem; color:#cbd5e0; }
    .gallery-placeholder svg { width:80px; height:80px; }

    .gallery-thumbs { display:flex; gap:.5rem; margin-top:.75rem; flex-wrap:wrap; }
    .gallery-thumb {
        width:72px; height:72px; border-radius:8px;
        overflow:hidden; border:2px solid #e2e8f0;
        cursor:pointer; transition:border-color .15s;
    }
    .gallery-thumb.active { border-color:#3182ce; }
    .gallery-thumb img { width:100%; height:100%; object-fit:cover; }

    .info-panel { display:flex; flex-direction:column; gap:1.25rem; }
    .info-cats { display:flex; flex-wrap:wrap; gap:.4rem; }
    .info-cat {
        background:#ebf8ff; color:#2b6cb0;
        font-size:.75rem; font-weight:500;
        padding:.2rem .65rem; border-radius:999px;
        text-decoration:none;
    }
    .info-cat:hover { background:#bee3f8; }
    .info-name { font-size:1.6rem; font-weight:700; color:#1a202c; line-height:1.2; }
    .info-vendor { font-size:.85rem; color:#718096; }
    .info-price { font-size:2rem; font-weight:800; color:#276749; }
    .info-desc { font-size:.9rem; color:#4a5568; line-height:1.65; }

    .stock-ok {
        display:inline-flex; align-items:center; gap:.4rem;
        background:#f0fff4; color:#276749;
        border:1px solid #9ae6b4;
        padding:.35rem .85rem; border-radius:999px;
        font-size:.82rem; font-weight:600;
    }
    .stock-no {
        display:inline-flex; align-items:center; gap:.4rem;
        background:#fff5f5; color:#c53030;
        border:1px solid #feb2b2;
        padding:.35rem .85rem; border-radius:999px;
        font-size:.82rem; font-weight:600;
    }

    .info-divider { height:1px; background:#e2e8f0; }

    .vendor-card {
        background:#f7fafc; border:1px solid #e2e8f0;
        border-radius:8px; padding:1rem; font-size:.85rem;
    }
    .vendor-card .vc-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.06em; color:#a0aec0; margin-bottom:.4rem; }
    .vendor-card .vc-name { font-weight:600; color:#1a202c; }
    .vendor-card .vc-email { color:#718096; font-size:.8rem; margin-top:.15rem; }

    .btn-back {
        display:inline-flex; align-items:center; gap:.4rem;
        color:#3182ce; text-decoration:none; font-size:.875rem;
    }
    .btn-back:hover { text-decoration:underline; }
</style>
@endpush

@section('content')
<div class="store-detail">

    {{-- Breadcrumb --}}
    <p class="breadcrumb">
        <a href="{{ route('dashboard.cliente') }}">Inicio</a>
        @foreach($producto->categorias->take(1) as $cat)
            &rsaquo;
            <a href="{{ route('dashboard.cliente', ['categoria' => $cat->id]) }}">{{ $cat->nombre }}</a>
        @endforeach
        &rsaquo; {{ $producto->nombre }}
    </p>

    <div class="detail-grid">

        {{-- Galería --}}
        <div>
            <div class="gallery-main">
                @if($producto->fotos && count($producto->fotos) > 0)
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($producto->fotos[0]) }}"
                         alt="{{ $producto->nombre }}" id="mainImgEl">
                @else
                    <div class="gallery-placeholder">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                        </svg>
                        <span style="font-size:.85rem">Sin imágenes</span>
                    </div>
                @endif
            </div>

            @if($producto->fotos && count($producto->fotos) > 1)
            <div class="gallery-thumbs">
                @foreach($producto->fotos as $i => $foto)
                <div class="gallery-thumb {{ $i === 0 ? 'active' : '' }}"
                     onclick="setImg('{{ \Illuminate\Support\Facades\Storage::disk('public')->url($foto) }}', this)">
                    <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($foto) }}" alt="">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="info-panel">

            <div class="info-cats">
                @foreach($producto->categorias as $cat)
                    <a href="{{ route('dashboard.cliente', ['categoria' => $cat->id]) }}" class="info-cat">
                        {{ $cat->nombre }}
                    </a>
                @endforeach
            </div>

            <h1 class="info-name">{{ $producto->nombre }}</h1>
            <p class="info-vendor">Vendido por <strong>{{ $producto->usuario->nombre ?? '—' }} {{ $producto->usuario->apellidos ?? '' }}</strong></p>

            <p class="info-price">${{ number_format($producto->precio, 2) }}</p>

            @if($producto->existencia > 0)
                <span class="stock-ok">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    Disponible · {{ $producto->existencia }} en stock
                </span>
            @else
                <span class="stock-no">Agotado por el momento</span>
            @endif

            <div class="info-divider"></div>

            <div>
                <p style="font-size:.8rem; text-transform:uppercase; letter-spacing:.06em; color:#a0aec0; margin-bottom:.5rem">Descripción</p>
                <p class="info-desc">{{ $producto->descripcion }}</p>
            </div>

            <div class="info-divider"></div>

            <div class="vendor-card">
                <p class="vc-label">Vendedor</p>
                <p class="vc-name">{{ $producto->usuario->nombre ?? '—' }} {{ $producto->usuario->apellidos ?? '' }}</p>
                <p class="vc-email">{{ $producto->usuario->correo ?? '' }}</p>
            </div>

            <a href="{{ route('dashboard.cliente') }}" class="btn-back">← Seguir comprando</a>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setImg(src, thumb) {
    document.getElementById('mainImgEl').src = src;
    document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
    thumb.classList.add('active');
}
</script>
@endpush
