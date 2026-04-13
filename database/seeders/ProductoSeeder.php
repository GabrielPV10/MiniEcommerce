<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener usuarios vendedores (gerentes)
        $vendedores = Usuario::where('rol', 'gerente')->get();
        $categorias = Categoria::all();

        if ($vendedores->isEmpty() || $categorias->isEmpty()) {
            $this->command->info('No hay vendedores o categorías. Corre primero los otros seeders.');
            return;
        }

        $productos = [
            [
                'nombre'      => 'Laptop HP',
                'descripcion' => 'Laptop HP 15 pulgadas, 8GB RAM, 256GB SSD',
                'precio'      => 12999.99,
                'existencia'  => 10,
            ],
            [
                'nombre'      => 'Mouse Logitech',
                'descripcion' => 'Mouse inalámbrico Logitech M185',
                'precio'      => 299.99,
                'existencia'  => 50,
            ],
            [
                'nombre'      => 'Teclado Mecánico',
                'descripcion' => 'Teclado mecánico RGB retroiluminado',
                'precio'      => 899.99,
                'existencia'  => 25,
            ],
            [
                'nombre'      => 'Playera Deportiva',
                'descripcion' => 'Playera deportiva de secado rápido talla M',
                'precio'      => 199.99,
                'existencia'  => 100,
            ],
            [
                'nombre'      => 'Silla Ergonómica',
                'descripcion' => 'Silla de oficina ergonómica con soporte lumbar',
                'precio'      => 3499.99,
                'existencia'  => 15,
            ],
        ];

        foreach ($productos as $datos) {
            // Asignar vendedor aleatorio
            $vendedor = $vendedores->random();

            $producto = Producto::create([
                'nombre'      => $datos['nombre'],
                'descripcion' => $datos['descripcion'],
                'precio'      => $datos['precio'],
                'existencia'  => $datos['existencia'],
                'usuario_id'  => $vendedor->id,
            ]);

            // Asignar 1 o 2 categorías aleatorias
            $categoriasAleatorias = $categorias->random(min(2, $categorias->count()));
            $producto->categorias()->sync($categoriasAleatorias->pluck('id')->toArray());
        }

        $this->command->info('✅ 5 productos creados correctamente.');
    }
}