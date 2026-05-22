<?php

namespace Tests\Feature;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_pagina_login_carga_correctamente(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_pagina_registro_carga_correctamente(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_login_con_credenciales_incorrectas_muestra_error(): void
    {
        $response = $this->post('/login', [
            'correo' => 'noexiste@ejemplo.com',
            'clave'  => 'claveincorrecta',
        ]);

        $response->assertSessionHasErrors('correo');
    }

    public function test_login_correcto_redirige_al_formulario_2fa(): void
    {
        Mail::fake();

        $usuario = Usuario::factory()->create();

        $response = $this->post('/login', [
            'correo' => $usuario->correo,
            'clave'  => '123456',
        ]);

        $response->assertRedirect(route('2fa.show'));
        $this->assertDatabaseHas('codigos_verificacion', [
            'usuario_id' => $usuario->id,
        ]);
    }

    public function test_registro_crea_usuario_con_rol_cliente(): void
    {
        $response = $this->post('/register', [
            'nombre'             => 'Juan',
            'apellidos'          => 'Perez Lopez',
            'correo'             => 'juan@ejemplo.com',
            'clave'              => '123456',
            'clave_confirmation' => '123456',
        ]);

        $this->assertDatabaseHas('usuarios', [
            'correo' => 'juan@ejemplo.com',
            'rol'    => 'cliente',
        ]);
    }

    public function test_registro_no_puede_crear_usuario_con_correo_duplicado(): void
    {
        Usuario::factory()->create(['correo' => 'repetido@ejemplo.com']);

        $response = $this->post('/register', [
            'nombre'             => 'Otro',
            'apellidos'          => 'Usuario Test',
            'correo'             => 'repetido@ejemplo.com',
            'clave'              => '123456',
            'clave_confirmation' => '123456',
        ]);

        $response->assertSessionHasErrors('correo');
    }

    public function test_registro_inicia_sesion_automaticamente(): void
    {
        $this->post('/register', [
            'nombre'             => 'Ana',
            'apellidos'          => 'Martinez Ruiz',
            'correo'             => 'ana@ejemplo.com',
            'clave'              => '123456',
            'clave_confirmation' => '123456',
        ]);

        $this->assertAuthenticated();
    }

    public function test_logout_cierra_sesion_y_redirige_al_login(): void
    {
        $usuario = Usuario::factory()->create();

        $response = $this->actingAs($usuario)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
