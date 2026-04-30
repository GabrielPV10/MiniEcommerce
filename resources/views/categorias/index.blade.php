@extends('layouts.app')
@section('title', 'Categorias')

@section('content')

<div class="page-bar">
    <div>
        <h1>Categorias</h1>
        <p class="sub">Clasificacion de productos del catalogo</p>
    </div>
    @can('create', App\Models\Categoria::class)
        <a href="{{ route('categorias.create') }}" class="btn btn-success btn-sm">+ Nueva categoria</a>
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
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categorias as $categoria)
                    <tr>
                        <td class="text-muted text-sm">{{ $categoria->id }}</td>
                        <td><strong>{{ $categoria->nombre }}</strong></td>
                        <td class="text-sm text-muted">{{ $categoria->descripcion }}</td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('categorias.show', $categoria) }}"
                                   class="btn btn-primary btn-sm">Ver</a>
                                @can('update', $categoria)
                                    <a href="{{ route('categorias.edit', $categoria) }}"
                                       class="btn btn-warning btn-sm">Editar</a>
                                @endcan
                                @can('delete', $categoria)
                                    <form action="{{ route('categorias.destroy', $categoria) }}"
                                          method="POST" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Eliminar esta categoria?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#718096; padding:2rem">
                            No hay categorias registradas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
