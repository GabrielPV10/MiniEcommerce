<?php

namespace Tests\Unit;

use App\Models\CodigoVerificacion;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_codigo_expirado_retorna_true_cuando_ya_vencio(): void
    {
        $codigo             = new CodigoVerificacion();
        $codigo->expiracion = now()->subMinutes(1);

        $this->assertTrue($codigo->estaExpirado());
    }

    public function test_codigo_vigente_retorna_false_cuando_no_ha_vencido(): void
    {
        $codigo             = new CodigoVerificacion();
        $codigo->expiracion = now()->addMinutes(4);

        $this->assertFalse($codigo->estaExpirado());
    }
}
