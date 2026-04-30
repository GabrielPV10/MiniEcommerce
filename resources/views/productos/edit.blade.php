@extends('layouts.app')
@section('title', 'Editar producto')

@section('content')

<div class="page-bar">
    <div>
        <h1>Editar producto</h1>
        <p class="sub">{{ $producto->nombre }}</p>
    </div>
    <a href="{{ route('productos.index') }}" class="btn btn-ghost btn-sm">Volver</a>
</div>

<div class="wrap">

    @if($errors->any())
        <div class="alert alert-e">
            <ul style="padding-left:1rem; margin:0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre del producto</label>
                        <input class="form-control" type="text" id="nombre" name="nombre"
                               value="{{ old('nombre', $producto->nombre) }}">
                        @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="precio">Precio ($)</label>
                        <input class="form-control" type="number" id="precio" name="precio"
                               step="0.01" min="0" value="{{ old('precio', $producto->precio) }}">
                        @error('precio') <p class="form-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descripcion">Descripcion</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="existencia">Existencia (unidades)</label>
                        <input class="form-control" type="number" id="existencia" name="existencia"
                               min="0" value="{{ old('existencia', $producto->existencia) }}">
                        @error('existencia') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Categorias</label>
                        <div style="border:1px solid #e2e8f0; border-radius:4px; padding:.6rem .75rem; background:#fff; max-height:130px; overflow-y:auto;">
                            @foreach($categorias as $categoria)
                                <label style="display:flex; align-items:center; gap:.5rem; font-size:.875rem; padding:.2rem 0; cursor:pointer;">
                                    <input type="checkbox" name="categorias[]" value="{{ $categoria->id }}"
                                        {{ in_array($categoria->id, old('categorias', $producto->categorias->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    {{ $categoria->nombre }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Fotos actuales --}}
                @if($producto->fotos && count($producto->fotos) > 0)
                    <div class="form-group">
                        <label class="form-label">Fotos actuales</label>
                        <div style="display:flex; gap:.75rem; flex-wrap:wrap; margin-top:.4rem;">
                            @foreach($producto->fotos as $foto)
                                <img src="{{ Storage::disk('public')->url($foto) }}"
                                     alt="Foto producto"
                                     style="width:100px; height:100px; object-fit:cover; border-radius:4px; border:1px solid #e2e8f0;">
                            @endforeach
                        </div>
                        <p class="form-hint">Si subes nuevas fotos, las actuales serán reemplazadas.</p>
                    </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Nuevas fotos <span class="text-muted" style="font-weight:400">(máx. 5, 2 MB c/u)</span></label>
                    <input class="form-control" type="file" name="fotos[]" multiple accept="image/*">
                    @error('fotos') <p class="form-error">{{ $message }}</p> @enderror
                    @error('fotos.*') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:flex; gap:.75rem; margin-top:.5rem;">
                    <button type="submit" class="btn btn-warning">Actualizar producto</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
