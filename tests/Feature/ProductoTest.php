<?php

namespace Tests\Feature;

use App\Models\Producto;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_productos_requiere_autenticacion(): void
    {
        $response = $this->get('/productos');

        $response->assertRedirect('/login');
    }

    public function test_gerente_no_puede_eliminar_un_producto(): void
    {
        Storage::fake('public');

        $gerente  = Usuario::factory()->gerente()->create();
        $producto = Producto::create([
            'nombre'      => 'Laptop HP',
            'descripcion' => 'Laptop de alto rendimiento para trabajo',
            'precio'      => 15000,
            'existencia'  => 10,
            'usuario_id'  => $gerente->id,
            'fotos'       => [],
        ]);

        $response = $this->actingAs($gerente)->delete("/productos/{$producto->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('productos', ['id' => $producto->id]);
    }

    public function test_administrador_puede_eliminar_un_producto(): void
    {
        Storage::fake('public');

        $gerente  = Usuario::factory()->gerente()->create();
        $admin    = Usuario::factory()->administrador()->create();
        $producto = Producto::create([
            'nombre'      => 'Mouse Logitech',
            'descripcion' => 'Mouse inalambrico ergonomico de precision',
            'precio'      => 800,
            'existencia'  => 25,
            'usuario_id'  => $gerente->id,
            'fotos'       => [],
        ]);

        $response = $this->actingAs($admin)->delete("/productos/{$producto->id}");

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }

    public function test_gerente_puede_editar_su_propio_producto(): void
    {
        Storage::fake('public');

        $gerente  = Usuario::factory()->gerente()->create();
        $producto = Producto::create([
            'nombre'      => 'Teclado Mecanico',
            'descripcion' => 'Teclado mecanico RGB para gaming',
            'precio'      => 1200,
            'existencia'  => 15,
            'usuario_id'  => $gerente->id,
            'fotos'       => [],
        ]);

        $response = $this->actingAs($gerente)->put("/productos/{$producto->id}", [
            'nombre'      => 'Teclado Mecanico RGB Pro',
            'descripcion' => 'Teclado mecanico RGB para gaming profesional',
            'precio'      => 1500,
            'existencia'  => 12,
        ]);

        $response->assertRedirect(route('productos.index'));
        $this->assertDatabaseHas('productos', [
            'id'     => $producto->id,
            'nombre' => 'Teclado Mecanico RGB Pro',
            'precio' => 1500,
        ]);
    }

    public function test_gerente_no_puede_editar_producto_de_otro_gerente(): void
    {
        Storage::fake('public');

        $gerente1 = Usuario::factory()->gerente()->create();
        $gerente2 = Usuario::factory()->gerente()->create();
        $producto = Producto::create([
            'nombre'      => 'Silla Ergonomica',
            'descripcion' => 'Silla de oficina con soporte lumbar',
            'precio'      => 4500,
            'existencia'  => 5,
            'usuario_id'  => $gerente1->id,
            'fotos'       => [],
        ]);

        $response = $this->actingAs($gerente2)->put("/productos/{$producto->id}", [
            'nombre'      => 'Silla Gamer',
            'descripcion' => 'Silla gamer con soporte lumbar y reposabrazos',
            'precio'      => 5000,
            'existencia'  => 3,
        ]);

        $response->assertStatus(403);
    }
}
