<?php

namespace App\Http\Controllers;

use App\Mail\VentaValidadaCompradorMail;
use App\Mail\VentaValidadaVendedorMail;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Usuario;
use App\Http\Requests\StoreVentaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class VentaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Venta::class);
        $ventas = Venta::with(['cliente', 'vendedor', 'producto'])->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        $this->authorize('create', Venta::class);
        $vendedores = Usuario::whereIn('rol', ['empleado', 'gerente', 'administrador'])->orderBy('nombre')->get();
        $clientes   = Usuario::where('rol', 'cliente')->orderBy('nombre')->get();
        $productos  = Producto::orderBy('nombre')->get();
        return view('ventas.create', compact('vendedores', 'clientes', 'productos'));
    }

    public function store(StoreVentaRequest $request)
    {
        $this->authorize('create', Venta::class);

        $datos = $request->safe()->except('ticket');

        $ticketPath = null;
        if ($request->hasFile('ticket')) {
            $ticketPath = $request->file('ticket')->store('tickets', 'private');
        }

        $venta = Venta::create(array_merge($datos, ['ticket' => $ticketPath]));

        Log::channel('ventas')->info('Venta creada', [
            'venta_id'    => $venta->id,
            'producto_id' => $venta->producto_id,
            'cliente_id'  => $venta->cliente_id,
            'vendedor_id' => $venta->vendedor_id,
            'total'       => $venta->total,
            'ticket'      => $ticketPath ? 'si' : 'no',
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
        $usuarios  = Usuario::all();
        $productos = Producto::all();
        return view('ventas.edit', compact('venta', 'usuarios', 'productos'));
    }

    public function update(StoreVentaRequest $request, Venta $venta)
    {
        $this->authorize('update', $venta);

        $datos = $request->safe()->except('ticket');

        if ($request->hasFile('ticket')) {
            if ($venta->ticket) {
                Storage::disk('private')->delete($venta->ticket);
            }
            $datos['ticket'] = $request->file('ticket')->store('tickets', 'private');
        }

        $venta->update($datos);

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

        if ($venta->ticket) {
            Storage::disk('private')->delete($venta->ticket);
        }

        $venta->delete();

        Log::channel('ventas')->info('Venta eliminada', [
            'venta_id' => $venta->id,
            'usuario'  => Auth::user()->correo,
            'ip'       => request()->ip(),
        ]);

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }

    // Valida la venta y notifica por correo a vendedor y comprador
    public function validar(Venta $venta)
    {
        $this->authorize('validar', $venta);

        $venta->load(['vendedor', 'cliente', 'producto']);

        $venta->update(['validada' => true]);

        Log::channel('ventas')->info('Venta validada', [
            'venta_id'    => $venta->id,
            'validada_por' => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        Mail::to($venta->vendedor->correo)->send(new VentaValidadaVendedorMail($venta));
        Mail::to($venta->cliente->correo)->send(new VentaValidadaCompradorMail($venta));

        return redirect()->route('ventas.show', $venta)
            ->with('success', 'Venta validada. Se notificó al vendedor y al comprador por correo.');
    }

    // Sirve el ticket desde disco privado con verificacion de autorización
    public function ticket(Venta $venta)
    {
        $this->authorize('view', $venta);

        if (!$venta->ticket || !Storage::disk('private')->exists($venta->ticket)) {
            abort(404, 'Ticket no encontrado.');
        }

        return Storage::disk('private')->response($venta->ticket);
    }
}
