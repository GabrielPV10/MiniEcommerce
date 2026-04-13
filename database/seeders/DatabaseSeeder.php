<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuarios con factory
        Usuario::factory(5)->create();

        // Crear un administrador fijo
        Usuario::create([
            'nombre' => 'Admin',
            'apellidos' => 'Sistema',
            'correo' => 'admin@tuxtla.tecnm.mx',
            'clave' => bcrypt('123'),
            'rol' => 'administrador',
        ]);

        // Llamar seeders
        $this->call([
            CategoriaSeeder::class,
        ]);
    }
}