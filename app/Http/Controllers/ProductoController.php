<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductoController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Producto::class);
        $productos = Producto::with(['usuario', 'categorias'])->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $this->authorize('create', Producto::class);
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $this->authorize('create', Producto::class);

        $fotos = [];
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $fotos[] = $foto->store('productos', 'public');
            }
        }

        $producto = Producto::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'existencia'  => $request->existencia,
            'usuario_id'  => Auth::id(),
            'fotos'       => $fotos,
        ]);

        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }

        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'fotos'       => count($fotos),
            'usuario'     => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        $this->authorize('view', $producto);
        $producto->load(['usuario', 'categorias']);
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $this->authorize('update', $producto);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('update', $producto);

        $fotos = $producto->fotos ?? [];

        if ($request->hasFile('fotos')) {
            foreach ($fotos as $fotoAnterior) {
                Storage::disk('public')->delete($fotoAnterior);
            }
            $fotos = [];
            foreach ($request->file('fotos') as $foto) {
                $fotos[] = $foto->store('productos', 'public');
            }
        }

        $producto->update([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'existencia'  => $request->existencia,
            'fotos'       => $fotos,
        ]);

        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        } else {
            $producto->categorias()->detach();
        }

        Log::channel('productos')->info('Producto actualizado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario'     => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        $this->authorize('delete', $producto);

        foreach ($producto->fotos ?? [] as $foto) {
            Storage::disk('public')->delete($foto);
        }

        Log::channel('productos')->info('Producto eliminado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario'     => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        $producto->categorias()->detach();
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
