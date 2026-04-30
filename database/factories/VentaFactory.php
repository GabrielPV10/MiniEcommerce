<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;

class VentaFactory extends Factory
{
    protected $model = Venta::class;

    public function definition(): array
    {
        return [
            'producto_id' => null, // se pasa al crear
            'vendedor_id' => null,
            'cliente_id'  => null,
            'fecha'       => $this->faker->dateTimeBetween('-8 months', 'now')->format('Y-m-d'),
            'total'       => $this->faker->randomFloat(2, 100, 6000),
            'ticket'      => null,
            'validada'    => $this->faker->boolean(35), // 35% validadas
        ];
    }
}
