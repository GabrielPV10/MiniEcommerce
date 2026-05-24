@extends('layouts.app')
@section('title', $producto->nombre)
@use('Illuminate\Support\Facades\Storage')

@section('content')

<div class="page-bar">
    <div>
        <h1>{{ $producto->nombre }}</h1>
        <p class="sub">Detalle del producto</p>
    </div>
    <div style="display:flex; gap:.5rem">
        @can('update', $producto)
            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
        @endcan
        <a href="{{ route('productos.index') }}" class="btn btn-ghost btn-sm">Volver</a>
    </div>
</div>

<div class="wrap">

    @if(session('success'))
        <div class="alert alert-s">{{ session('success') }}</div>
    @endif

    @if($producto->fotos && count($producto->fotos) > 0)
        <div class="card" style="margin-bottom:1.5rem">
            <div class="card-head"><h2>Fotos</h2></div>
            <div class="card-body">
                <div style="display:flex; gap:1rem; flex-wrap:wrap;">
                    @foreach($producto->fotos as $foto)
                        <img src="{{ $foto }}"
                             alt="Foto de {{ $producto->nombre }}"
                             style="width:160px; height:160px; object-fit:cover; border-radius:4px; border:1px solid #e2e8f0;">
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="card" style="max-width:560px">
        <div class="card-body">

            <div class="form-group">
                <span class="form-label">Nombre</span>
                <p>{{ $producto->nombre }}</p>
            </div>

            <div class="form-group">
                <span class="form-label">Descripcion</span>
                <p>{{ $producto->descripcion }}</p>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <span class="form-label">Precio</span>
                    <p style="color:#38a169; font-weight:700; font-size:1.1rem">${{ number_format($producto->precio, 2) }}</p>
                </div>
                <div class="form-group">
                    <span class="form-label">Existencia</span>
                    @if($producto->existencia > 0)
                        <span class="badge badge-green">{{ $producto->existencia }} unidades</span>
                    @else
                        <span class="badge badge-red">Sin stock</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <span class="form-label">Vendedor</span>
                <p>{{ $producto->usuario->nombre ?? '—' }} {{ $producto->usuario->apellidos ?? '' }}</p>
            </div>

            <div class="form-group">
                <span class="form-label">Categorias</span>
                <div style="display:flex; gap:.35rem; flex-wrap:wrap; margin-top:.25rem">
                    @forelse($producto->categorias as $categoria)
                        <span class="badge badge-blue">{{ $categoria->nombre }}</span>
                    @empty
                        <span class="text-muted text-sm">Sin categorias</span>
                    @endforelse
                </div>
            </div>

            <div class="form-group" style="margin-bottom:0">
                <span class="form-label">Registrado</span>
                <p class="text-muted text-sm">{{ $producto->created_at->format('d/m/Y H:i') }}</p>
            </div>

        </div>
    </div>

    @if(auth()->user()->rol === 'cliente')
        <div style="margin-top:1.5rem">
            @if($producto->existencia > 0)
                <form action="{{ route('productos.comprar', $producto) }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-success"
                            onclick="return confirm('¿Confirmar compra de {{ $producto->nombre }} por ${{ number_format($producto->precio, 2) }}?')">
                        Comprar — ${{ number_format($producto->precio, 2) }}
                    </button>
                </form>
            @else
                <span class="badge badge-red">Producto agotado</span>
            @endif
        </div>
    @endif

    @can('delete', $producto)
        <div style="margin-top:1rem">
            <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Eliminar este producto y sus fotos?')">
                    Eliminar producto
                </button>
            </form>
        </div>
    @endcan

</div>
@endsection
