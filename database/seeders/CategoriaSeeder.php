<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Electronica',
            'descripcion' => 'Productos electronicos y tecnologia',
        ]);

        Categoria::create([
            'nombre' => 'Ropa',
            'descripcion' => 'Prendas de vestir y accesorios',
        ]);

        Categoria::create([
            'nombre' => 'Hogar',
            'descripcion' => 'Articulos para el hogar',
        ]);

        Categoria::create([
            'nombre' => 'Deportes',
            'descripcion' => 'Articulos deportivos y fitness',
        ]);

        Categoria::create([
            'nombre' => 'Alimentos',
            'descripcion' => 'Productos alimenticios y bebidas',
        ]);
    }
}