<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoriaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Categoria::class);
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        $this->authorize('create', Categoria::class);
        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        $this->authorize('create', Categoria::class);

        $categoria = Categoria::create($request->validated());

        Log::channel('productos')->info('Categoria creada', [
            'usuario_id' => auth()->id(),
            'categoria_id' => $categoria->id,
            'nombre' => $categoria->nombre,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria creada correctamente.');
    }

    public function show(Categoria $categoria)
    {
        $this->authorize('view', $categoria);
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        $this->authorize('update', $categoria);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $this->authorize('update', $categoria);

        $categoria->update($request->validated());

        Log::channel('productos')->info('Categoria editada', [
            'usuario_id' => auth()->id(),
            'categoria_id' => $categoria->id,
            'nombre' => $categoria->nombre,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria actualizada correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $this->authorize('delete', $categoria);

        Log::channel('productos')->info('Categoria eliminada', [
            'usuario_id' => auth()->id(),
            'categoria_id' => $categoria->id,
            'nombre' => $categoria->nombre,
        ]);

        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria eliminada correctamente.');
    }
}