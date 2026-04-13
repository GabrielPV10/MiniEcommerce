<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProductoController extends Controller
{
    use AuthorizesRequests;
    // Listar productos
    public function index()
    {
        $this->authorize('viewAny', Producto::class);
        $productos = Producto::with(['usuario', 'categorias'])->get();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario crear
    public function create()
    {
        $this->authorize('create', Producto::class);
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    // Guardar nuevo producto
    public function store(StoreProductoRequest $request)
    {
        $this->authorize('create', Producto::class);

        $producto = Producto::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio'      => $request->precio,
            'existencia'  => $request->existencia,
            'usuario_id' => Auth::user()->id,
        ]);

        // Sincronizar categorías (tabla pivote)
        if ($request->has('categorias')) {
            $producto->categorias()->sync($request->categorias);
        }

        Log::channel('productos')->info('Producto creado', [
            'producto_id' => $producto->id,
            'nombre'      => $producto->nombre,
            'usuario'     => Auth::user()->correo,
            'ip'          => request()->ip(),
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    // Ver detalle
    public function show(Producto $producto)
    {
        $this->authorize('view', $producto);
        $producto->load(['usuario', 'categorias']);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario editar
    public function edit(Producto $producto)
    {
        $this->authorize('update', $producto);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    // Actualizar producto
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $this->authorize('update', $producto);

        $producto->update($request->validated());

        // Sincronizar categorías
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

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $this->authorize('delete', $producto);

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