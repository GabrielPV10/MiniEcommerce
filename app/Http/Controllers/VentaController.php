<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Usuario;
use App\Http\Requests\StoreVentaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VentaController extends Controller
{
   use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Venta::class);
        $ventas = Venta::with(['cliente', 'vendedor'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $this->authorize('create', Venta::class);
        $usuarios = Usuario::all();
        return view('ventas.create', compact('usuarios'));
    }

    public function store(StoreVentaRequest $request)
    {
        $this->authorize('create', Venta::class);

        $venta = Venta::create($request->validated());

        Log::channel('ventas')->info('Venta creada', [
            'venta_id'    => $venta->id,
            'producto_id' => $venta->producto_id,
            'cliente_id'  => $venta->cliente_id,
            'vendedor_id' => $venta->vendedor_id,
            'total'       => $venta->total,
            'usuario'     => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    }

    public function show(Venta $venta)
    {
        $this->authorize('view', $venta);
        return view('ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        $this->authorize('update', $venta);
        $usuarios = Usuario::all();
        return view('ventas.edit', compact('venta', 'usuarios'));
    }

    public function update(StoreVentaRequest $request, Venta $venta)
    {
        $this->authorize('update', $venta);

        $venta->update($request->validated());

        Log::channel('ventas')->info('Venta actualizada', [
            'venta_id' => $venta->id,
            'usuario'  => Auth::user()->correo,
            'ip'       => request()->ip(),
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy(Venta $venta)
    {
        $this->authorize('delete', $venta);

        $venta->delete();

        Log::channel('ventas')->info('Venta eliminada', [
            'venta_id' => $venta->id,
            'usuario'  => Auth::user()->correo,
            'ip'       => request()->ip(),
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}