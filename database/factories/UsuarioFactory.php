<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    public function definition(): array
    {
        return [
            'nombre'    => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'correo'    => $this->faker->unique()->numerify('usuario###') . '@tuxtla.tecnm.mx',
            'clave'     => '123456',   // el cast 'hashed' del modelo lo hashea automáticamente
            'rol'       => 'cliente',
        ];
    }

    public function cliente(): static
    {
        return $this->state(['rol' => 'cliente']);
    }

    public function empleado(): static
    {
        return $this->state(['rol' => 'empleado']);
    }

    public function gerente(): static
    {
        return $this->state(['rol' => 'gerente']);
    }

    public function administrador(): static
    {
        return $this->state(['rol' => 'administrador']);
    }
}
