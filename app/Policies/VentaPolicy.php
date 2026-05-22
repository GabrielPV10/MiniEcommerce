<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;

class VentaPolicy
{
    public function viewAny(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado', 'cliente']);
    }

    public function view(Usuario $usuario, Venta $venta): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado']) ||
               $venta->cliente_id === $usuario->id ||
               $venta->vendedor_id === $usuario->id;
    }

    public function validar(Usuario $usuario, Venta $venta): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado']) && !$venta->validada;
    }

    public function create(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado']);
    }

    public function update(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->rol === 'administrador';
    }

    public function delete(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->rol === 'administrador';
    }
}