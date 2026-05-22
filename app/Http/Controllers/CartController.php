<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function show()
    {
        $carrito   = session('carrito', []);
        $productos = collect();

        if (!empty($carrito)) {
            $productos = Producto::with('categorias', 'usuario')
                ->whereIn('id', array_keys($carrito))
                ->get()
                ->map(function (Producto $p) use ($carrito) {
                    $p->cantidad = $carrito[$p->id];
                    return $p;
                });
        }

        $total = $productos->sum(fn ($p) => $p->precio * $p->cantidad);

        return view('carrito.index', compact('productos', 'total'));
    }

    public function agregar(Producto $producto)
    {
        if (auth()->user()->rol !== 'cliente') {
            abort(403);
        }

        if ($producto->existencia <= 0) {
            return back()->with('cart_error', 'Este producto está agotado.');
        }

        $carrito      = session('carrito', []);
        $cantidadActual = $carrito[$producto->id] ?? 0;

        if ($cantidadActual >= $producto->existencia) {
            return back()->with('cart_error', 'No hay más stock disponible.');
        }

        $carrito[$producto->id] = $cantidadActual + 1;
        session(['carrito' => $carrito]);

        return back()->with('cart_ok', "\"{$producto->nombre}\" agregado al carrito.");
    }

    public function remover(Producto $producto)
    {
        $carrito = session('carrito', []);
        unset($carrito[$producto->id]);
        session(['carrito' => $carrito]);

        return back()->with('cart_ok', 'Producto eliminado del carrito.');
    }

    public function checkout()
    {
        $usuario = auth()->user();

        if ($usuario->rol !== 'cliente') {
            abort(403);
        }

        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return back()->with('cart_error', 'Tu carrito está vacío.');
        }

        foreach ($carrito as $productoId => $cantidad) {
            $producto = Producto::find($productoId);

            if (!$producto || $producto->existencia < $cantidad) {
                continue;
            }

            $venta = Venta::create([
                'producto_id' => $producto->id,
                'vendedor_id' => $producto->usuario_id,
                'cliente_id'  => $usuario->id,
                'fecha'       => now()->format('Y-m-d'),
                'total'       => round($producto->precio * $cantidad, 2),
                'validada'    => false,
            ]);

            $producto->decrement('existencia', $cantidad);

            Log::channel('ventas')->info('Compra desde carrito', [
                'venta_id'    => $venta->id,
                'producto_id' => $producto->id,
                'cantidad'    => $cantidad,
                'cliente_id'  => $usuario->id,
                'total'       => $venta->total,
            ]);
        }

        session()->forget('carrito');

        return redirect()->route('ventas.index')
            ->with('success', '¡Compra realizada! Tus pedidos están pendientes de validación.');
    }
}
