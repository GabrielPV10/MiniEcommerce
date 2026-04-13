<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <nav class="bg-gray-800 text-white px-6 py-4 flex justify-between items-center">
        <span class="font-bold text-lg">🛒 MiniEcommerce</span>
        <div class="flex gap-4">
            <a href="{{ route('productos.index') }}" class="hover:text-yellow-400">Productos</a>
            <a href="/categorias" class="hover:text-yellow-400">Categorías</a>
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-8 px-4">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">📦 Productos</h1>
            @can('create', App\Models\Producto::class)
                <a href="{{ route('productos.create') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Nuevo Producto
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Nombre</th>
                        <th class="px-4 py-3 text-left">Precio</th>
                        <th class="px-4 py-3 text-left">Existencia</th>
                        <th class="px-4 py-3 text-left">Vendedor</th>
                        <th class="px-4 py-3 text-left">Categorías</th>
                        <th class="px-4 py-3 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($productos as $producto)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $producto->id }}</td>
                        <td class="px-4 py-3 font-medium">{{ $producto->nombre }}</td>
                        <td class="px-4 py-3 text-green-600 font-semibold">
                            ${{ number_format($producto->precio, 2) }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="{{ $producto->existencia > 0 ? 'text-green-600' : 'text-red-500' }}">
                                {{ $producto->existencia }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-600">
                            {{ $producto->usuario->nombre ?? 'N/A' }}
                            {{ $producto->usuario->apellidos ?? '' }}
                        </td>
                        <td class="px-4 py-3">
                            @foreach($producto->categorias as $categoria)
                                <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mr-1">
                                    {{ $categoria->nombre }}
                                </span>
                            @endforeach
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('productos.show', $producto) }}"
                                   class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                    Ver
                                </a>
                                @can('update', $producto)
                                    <a href="{{ route('productos.edit', $producto) }}"
                                       class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">
                                        Editar
                                    </a>
                                @endcan
                                @can('delete', $producto)
                                    <form action="{{ route('productos.destroy', $producto) }}"
                                          method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600"
                                                onclick="return confirm('¿Eliminar este producto?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>