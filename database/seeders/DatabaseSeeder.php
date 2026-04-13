<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear administrador fijo
        Usuario::create([
            'nombre'    => 'Admin',
            'apellidos' => 'Sistema',
            'correo'    => 'admin@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => 'administrador',
        ]);

        // 2. Crear 5 usuarios con Factory
        Usuario::factory(5)->create();

        // 3. Crear categorías
        $this->call(CategoriaSeeder::class);

        // 4. Crear productos
        $this->call(ProductoSeeder::class);

        $this->command->info('✅ Base de datos poblada correctamente.');
    }
}