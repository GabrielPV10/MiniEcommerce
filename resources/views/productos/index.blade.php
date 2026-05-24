@extends('layouts.app')
@section('title', 'Productos')
@use('Illuminate\Support\Facades\Storage')

@section('content')

<div class="page-bar">
    <div>
        <h1>Productos</h1>
        <p class="sub">Catalogo de productos del sistema</p>
    </div>
    @can('create', App\Models\Producto::class)
        <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm">+ Nuevo producto</a>
    @endcan
</div>

<div class="wrap">

    @if(session('success'))
        <div class="alert alert-s">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Existencia</th>
                        <th>Vendedor</th>
                        <th>Categorias</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                    <tr>
                        <td class="text-muted text-sm">{{ $producto->id }}</td>
                        <td>
                            @if($producto->fotos && count($producto->fotos) > 0)
                                <img src="{{ $producto->fotos[0] }}"
                                     alt="{{ $producto->nombre }}"
                                     style="width:48px; height:48px; object-fit:cover; border-radius:4px;">
                            @else
                                <span style="display:inline-block; width:48px; height:48px; background:#e2e8f0; border-radius:4px; line-height:48px; text-align:center; font-size:.7rem; color:#718096;">N/A</span>
                            @endif
                        </td>
                        <td><strong>{{ $producto->nombre }}</strong></td>
                        <td style="color:#38a169; font-weight:600">${{ number_format($producto->precio, 2) }}</td>
                        <td>
                            @if($producto->existencia > 0)
                                <span class="badge badge-green">{{ $producto->existencia }}</span>
                            @else
                                <span class="badge badge-red">Sin stock</span>
                            @endif
                        </td>
                        <td class="text-sm text-muted">
                            {{ $producto->usuario->nombre ?? '—' }}
                            {{ $producto->usuario->apellidos ?? '' }}
                        </td>
                        <td>
                            @foreach($producto->categorias as $cat)
                                <span class="badge badge-blue">{{ $cat->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('productos.show', $producto) }}"
                                   class="btn btn-primary btn-sm">Ver</a>
                                @can('update', $producto)
                                    <a href="{{ route('productos.edit', $producto) }}"
                                       class="btn btn-warning btn-sm">Editar</a>
                                @endcan
                                @can('delete', $producto)
                                    <form action="{{ route('productos.destroy', $producto) }}"
                                          method="POST" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; color:#718096; padding:2rem">
                            No hay productos registrados.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
