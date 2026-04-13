<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Venta;

class VentaPolicy
{
    public function viewAny(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'cliente']);
    }

    public function view(Usuario $usuario, Venta $venta): bool
    {
        return $usuario->rol === 'administrador' ||
               $venta->cliente_id === $usuario->id ||
               $venta->vendedor_id === $usuario->id;
    }

    public function create(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente']);
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