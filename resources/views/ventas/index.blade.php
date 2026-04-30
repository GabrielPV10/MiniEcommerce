@extends('layouts.app')
@section('title', 'Ventas')

@section('content')

<div class="page-bar">
    <div>
        <h1>Ventas</h1>
        <p class="sub">Registro de transacciones del sistema</p>
    </div>
    @can('create', App\Models\Venta::class)
        <a href="{{ route('ventas.create') }}" class="btn btn-success btn-sm">+ Nueva venta</a>
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
                        <th>Producto</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ventas as $venta)
                    <tr>
                        <td class="text-muted text-sm">{{ $venta->id }}</td>
                        <td class="text-sm">
                            {{ $venta->producto->nombre ?? '—' }}
                        </td>
                        <td class="text-sm">
                            {{ $venta->cliente->nombre ?? '—' }}
                            {{ $venta->cliente->apellidos ?? '' }}
                        </td>
                        <td class="text-sm text-muted">
                            {{ $venta->vendedor->nombre ?? '—' }}
                            {{ $venta->vendedor->apellidos ?? '' }}
                        </td>
                        <td class="text-sm">{{ $venta->fecha }}</td>
                        <td style="color:#38a169; font-weight:600">
                            ${{ number_format($venta->total, 2) }}
                        </td>
                        <td>
                            @if($venta->validada)
                                <span class="badge badge-green">Validada</span>
                            @else
                                <span class="badge badge-yellow">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('ventas.show', $venta) }}"
                                   class="btn btn-primary btn-sm">Ver</a>
                                @can('update', $venta)
                                    <a href="{{ route('ventas.edit', $venta) }}"
                                       class="btn btn-warning btn-sm">Editar</a>
                                @endcan
                                @can('validar', $venta)
                                    <form action="{{ route('ventas.validar', $venta) }}" method="POST" style="margin:0">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('¿Validar esta venta y notificar por correo?')">
                                            Validar
                                        </button>
                                    </form>
                                @endcan
                                @can('delete', $venta)
                                    <form action="{{ route('ventas.destroy', $venta) }}"
                                          method="POST" style="margin:0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Eliminar esta venta?')">
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
                            No hay ventas registradas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
