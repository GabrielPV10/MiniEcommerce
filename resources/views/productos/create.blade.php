@extends('layouts.app')
@section('title', 'Nuevo producto')

@section('content')

<div class="page-bar">
    <div>
        <h1>Nuevo producto</h1>
        <p class="sub">Completa los campos para agregar un producto al catalogo</p>
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
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre del producto</label>
                        <input
                            class="form-control"
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Ej: Laptop HP 15"
                        >
                        @error('nombre')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="precio">Precio ($)</label>
                        <input
                            class="form-control"
                            type="number"
                            id="precio"
                            name="precio"
                            step="0.01"
                            min="0"
                            value="{{ old('precio') }}"
                            placeholder="0.00"
                        >
                        @error('precio')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="descripcion">Descripcion</label>
                    <textarea
                        class="form-control"
                        id="descripcion"
                        name="descripcion"
                        rows="3"
                        placeholder="Describe el producto..."
                    >{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="existencia">Existencia (unidades)</label>
                        <input
                            class="form-control"
                            type="number"
                            id="existencia"
                            name="existencia"
                            min="0"
                            value="{{ old('existencia', 0) }}"
                        >
                        @error('existencia')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Categorias</label>
                        <div style="border:1px solid #e2e8f0; border-radius:4px; padding:.6rem .75rem; background:#fff; max-height:130px; overflow-y:auto;">
                            @foreach($categorias as $categoria)
                                <label style="display:flex; align-items:center; gap:.5rem; font-size:.875rem; padding:.2rem 0; cursor:pointer;">
                                    <input
                                        type="checkbox"
                                        name="categorias[]"
                                        value="{{ $categoria->id }}"
                                        {{ in_array($categoria->id, old('categorias', [])) ? 'checked' : '' }}
                                    >
                                    {{ $categoria->nombre }}
                                </label>
                            @endforeach
                        </div>
                        @error('categorias')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Fotos del producto <span class="text-muted" style="font-weight:400">(máx. 5 imágenes, 2 MB c/u)</span></label>
                    <input class="form-control" type="file" name="fotos[]" multiple accept="image/*">
                    @error('fotos') <p class="form-error">{{ $message }}</p> @enderror
                    @error('fotos.*') <p class="form-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:flex; gap:.75rem; margin-top:.5rem;">
                    <button type="submit" class="btn btn-success">Guardar producto</button>
                    <a href="{{ route('productos.index') }}" class="btn btn-ghost">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
