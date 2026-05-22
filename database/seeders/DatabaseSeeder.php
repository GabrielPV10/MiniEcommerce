<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\Venta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Si ya hay productos, la BD está poblada — no re-seedear
        if (Producto::count() > 0) {
            $this->command->info('Base de datos ya poblada, omitiendo seeder.');
            return;
        }

        // ── 1. Administrador fijo ─────────────────────────────────────────────
        Usuario::firstOrCreate(
            ['correo' => 'admin@tuxtla.tecnm.mx'],
            [
                'nombre'    => 'Admin',
                'apellidos' => 'Sistema',
                'clave'     => '123456',
                'rol'       => 'administrador',
            ]
        );

        // ── 2. 100 usuarios: 70 clientes + 25 empleados + 5 gerentes ─────────
        $clientes   = Usuario::factory(70)->cliente()->create();
        $empleados  = Usuario::factory(25)->empleado()->create();
        $gerentes   = Usuario::factory(5)->gerente()->create();
        $vendedores = $empleados->merge($gerentes); // 30 vendedores en total

        $this->command->info("✅ Usuarios: 1 admin + 70 clientes + 25 empleados + 5 gerentes");

        // ── 3. Categorías ─────────────────────────────────────────────────────
        $this->call(CategoriaSeeder::class);
        $categorias = Categoria::all();

        // ── 4. Productos: mínimo 3 por vendedor + asignar categorías ─────────
        $vendedores->each(function (Usuario $vendedor) use ($categorias) {
            $cantidad = rand(3, 6);

            Producto::factory($cantidad)
                ->create(['usuario_id' => $vendedor->id])
                ->each(function (Producto $producto) use ($categorias) {
                    $numCats = rand(1, min(3, $categorias->count()));
                    $producto->categorias()->sync(
                        $categorias->random($numCats)->pluck('id')->toArray()
                    );
                });
        });

        $totalProductos = Producto::count();
        $this->command->info("✅ Productos: {$totalProductos} creados (mín. 3 por vendedor, c/u con categoría)");

        // ── 5. Ventas: ~150 ventas entre clientes y vendedores ───────────────
        $productos   = Producto::all();
        $vendedoresIds = $vendedores->pluck('id');
        $clientesIds   = $clientes->pluck('id');

        for ($i = 0; $i < 150; $i++) {
            $producto = $productos->random();
            Venta::create([
                'producto_id' => $producto->id,
                'vendedor_id' => $vendedoresIds->random(),
                'cliente_id'  => $clientesIds->random(),
                'fecha'       => fake()->dateTimeBetween('-8 months', 'now')->format('Y-m-d'),
                'total'       => round($producto->precio * rand(1, 3), 2),
                'validada'    => fake()->boolean(35),
            ]);
        }

        $this->command->info("✅ Ventas: 150 generadas");
        $this->command->info("✅ Base de datos poblada correctamente.");
    }
}
