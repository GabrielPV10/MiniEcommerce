<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_categorias_requiere_autenticacion(): void
    {
        $response = $this->get('/categorias');

        $response->assertRedirect('/login');
    }

    public function test_administrador_puede_crear_categoria(): void
    {
        $admin = Usuario::factory()->administrador()->create();

        $response = $this->actingAs($admin)->post('/categorias', [
            'nombre'      => 'Electronica',
            'descripcion' => 'Productos electronicos y tecnologia',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Electronica',
        ]);
    }

    public function test_cliente_no_puede_crear_categoria(): void
    {
        $cliente = Usuario::factory()->cliente()->create();

        $response = $this->actingAs($cliente)->post('/categorias', [
            'nombre'      => 'Ropa',
            'descripcion' => 'Categoria de ropa y moda',
        ]);

        $response->assertStatus(403);
    }
}
