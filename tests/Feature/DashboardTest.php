<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_no_autenticado_es_redirigido_al_login(): void
    {
        $response = $this->get('/dashboard/cliente');

        $response->assertRedirect('/login');
    }

    public function test_cliente_puede_acceder_a_su_propio_dashboard(): void
    {
        $cliente = Usuario::factory()->cliente()->create();

        $response = $this->actingAs($cliente)->get('/dashboard/cliente');

        $response->assertStatus(200);
    }

    public function test_cliente_no_puede_acceder_al_dashboard_de_gerente(): void
    {
        $cliente = Usuario::factory()->cliente()->create();

        $response = $this->actingAs($cliente)->get('/dashboard/gerente');

        $response->assertStatus(403);
    }

    public function test_gerente_puede_acceder_a_su_dashboard(): void
    {
        $gerente = Usuario::factory()->gerente()->create();

        $response = $this->actingAs($gerente)->get('/dashboard/gerente');

        $response->assertStatus(200);
    }

    public function test_administrador_puede_acceder_al_dashboard_de_gerente(): void
    {
        $admin = Usuario::factory()->administrador()->create();

        $response = $this->actingAs($admin)->get('/dashboard/gerente');

        $response->assertStatus(200);
    }
}
