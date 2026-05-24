<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Cloudinary\Cloudinary;

class ProductoController extends Controller
{
    use AuthorizesRequests;

    private function cloudinary()
    {
        return new Cloudinary([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
        ]);
    }

    public function index()
    {
        if (auth()->user()->rol === 'cliente') {
            return redirect()->route('dashboard.cliente');
        }
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
            $cloudinary = $this->cloudinary();
            foreach ($request->file('fotos') as $foto) {
                $resultado = $cloudinary->uploadApi()->upload($foto->getRealPath(), [
                    'folder' => 'productos',
                ]);
                $fotos[] = $resultado['secure_url'];
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
        $vista = auth()->user()->rol === 'cliente' ? 'productos.show-store' : 'productos.show';
        return view($vista, compact('producto'));
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
            $fotos = [];
            $cloudinary = $this->cloudinary();
            foreach ($request->file('fotos') as $foto) {
                $resultado = $cloudinary->uploadApi()->upload($foto->getRealPath(), [
                    'folder' => 'productos',
                ]);
                $fotos[] = $resultado['secure_url'];
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