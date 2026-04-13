<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    private static array $combinaciones = [
        ['Juan', 'Lopez'],
        ['Juan', 'Sanchez'],
        ['Juan', 'Hernandez'],
        ['Juan', 'Martinez'],
        ['Mario', 'Lopez'],
        ['Mario', 'Sanchez'],
        ['Mario', 'Hernandez'],
        ['Mario', 'Martinez'],
        ['Maria', 'Lopez'],
        ['Maria', 'Sanchez'],
        ['Maria', 'Hernandez'],
        ['Maria', 'Martinez'],
        ['Pedro', 'Lopez'],
        ['Pedro', 'Sanchez'],
        ['Pedro', 'Hernandez'],
        ['Pedro', 'Martinez'],
    ];

    private static int $indice = 0;

    public function definition(): array
    {
        $combo = self::$combinaciones[self::$indice % count(self::$combinaciones)];
        self::$indice++;

        $nombre = $combo[0];
        $apellido = $combo[1];

        return [
            'nombre'    => $nombre,
            'apellidos' => $apellido,
            'correo'    => strtolower(substr($nombre, 0, 1) . $apellido) . '@tuxtla.tecnm.mx',
            'clave'     => Hash::make('123'),
            'rol'       => $this->faker->randomElement(['cliente', 'gerente']),
        ];
    }
}