<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    private static array $nombres = [
        'Laptop HP 15',      'Monitor Samsung 24"', 'Teclado Mecánico RGB', 'Mouse Inalámbrico',
        'Audífonos Bluetooth','Cámara Web HD',        'Bocina Portátil',     'Cargador USB-C',
        'Playera Deportiva', 'Pantalón Cargo',        'Sudadera Hoodie',     'Tenis Running',
        'Silla Ergonómica',  'Escritorio Plegable',   'Lámpara LED',         'Cojín Viscoelástico',
        'Balón Fútbol',      'Pesas Ajustables',      'Colchoneta Yoga',     'Botella Térmica',
        'Café Molido 500g',  'Proteína Whey 1kg',     'Granola Integral',    'Jugo Verde 1L',
        'Mochila 30L',       'Cartera de Cuero',      'Reloj Deportivo',     'Gafas de Sol',
        'Sartén Antiadherente','Licuadora 600W',       'Cafetera Express',   'Juego de Cuchillos',
    ];

    private static int $indice = 0;

    public function definition(): array
    {
        $nombre = self::$nombres[self::$indice % count(self::$nombres)];
        self::$indice++;

        return [
            'nombre'      => $nombre,
            'descripcion' => $this->faker->sentence(12),
            'precio'      => $this->faker->randomFloat(2, 50, 8000),
            'existencia'  => $this->faker->numberBetween(0, 150),
            'usuario_id'  => null, // se pasa al crear
            'fotos'       => [],
        ];
    }
}
