<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Usuario;

class ProductoPolicy
{
    public function viewAny(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado', 'cliente']);
    }

    public function view(Usuario $usuario, Producto $producto): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado', 'cliente']);
    }

    // Administrador, gerente y empleado pueden crear productos
    public function create(Usuario $usuario): bool
    {
        return in_array($usuario->rol, ['administrador', 'gerente', 'empleado']);
    }

    // Administrador edita cualquier producto
    // Gerente y empleado solo editan sus propios productos
    public function update(Usuario $usuario, Producto $producto): bool
    {
        if ($usuario->rol === 'administrador') {
            return true;
        }

        if (in_array($usuario->rol, ['gerente', 'empleado'])) {
            return $producto->usuario_id === $usuario->id;
        }

        return false;
    }

    // Solo administrador puede eliminar
    public function delete(Usuario $usuario, Producto $producto): bool
    {
        return $usuario->rol === 'administrador';
    }
}