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

        // ── 4. Productos: mínimo 3 por vendedor + asignar categorías coherentes ──
        $mapaCategoria = [
            'Electronica' => ['Laptop HP 15', 'Monitor Samsung 24"', 'Teclado Mecánico RGB', 'Mouse Inalámbrico', 'Audífonos Bluetooth', 'Cámara Web HD', 'Bocina Portátil', 'Cargador USB-C'],
            'Ropa'        => ['Playera Deportiva', 'Pantalón Cargo', 'Sudadera Hoodie', 'Tenis Running', 'Gafas de Sol', 'Mochila 30L', 'Cartera de Cuero', 'Reloj Deportivo'],
            'Hogar'       => ['Silla Ergonómica', 'Escritorio Plegable', 'Lámpara LED', 'Cojín Viscoelástico', 'Sartén Antiadherente', 'Licuadora 600W', 'Cafetera Express', 'Juego de Cuchillos'],
            'Deportes'    => ['Balón Fútbol', 'Pesas Ajustables', 'Colchoneta Yoga', 'Botella Térmica', 'Guantes Box', 'Bicicleta Estática', 'Cuerda para Saltar', 'Rodilleras'],
            'Alimentos'   => ['Café Molido 500g', 'Proteína Whey 1kg', 'Granola Integral', 'Jugo Verde 1L', 'Aceite de Oliva', 'Miel Orgánica 500g', 'Avena Instantánea', 'Barras de Cereal'],
        ];

        $vendedores->each(function (Usuario $vendedor) use ($categorias, $mapaCategoria) {
            $cantidad = rand(3, 6);

            for ($i = 0; $i < $cantidad; $i++) {
                // Elegir categoría aleatoria y un nombre coherente con ella
                $catNombre = $categorias->random()->nombre;
                $nombres   = $mapaCategoria[$catNombre] ?? ['Producto General'];
                $nombre    = $nombres[array_rand($nombres)];

                $producto = Producto::create([
                    'nombre'      => $nombre,
                    'descripcion' => fake()->sentence(10),
                    'precio'      => fake()->randomFloat(2, 50, 8000),
                    'existencia'  => fake()->numberBetween(5, 100),
                    'usuario_id'  => $vendedor->id,
                    'fotos'       => [],
                ]);

                // Asignar la categoría principal + opcionalmente una segunda relacionada
                $catPrincipal = $categorias->firstWhere('nombre', $catNombre);
                $catIds       = [$catPrincipal->id];
                if (rand(0, 1) && $categorias->count() > 1) {
                    $catIds[] = $categorias->where('id', '!=', $catPrincipal->id)->random()->id;
                }
                $producto->categorias()->sync(array_unique($catIds));
            }
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
