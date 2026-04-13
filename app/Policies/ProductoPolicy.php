<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\Usuario;

class ProductoPolicy
{
    // Todos los roles pueden ver la lista
    public function viewAny(Usuario $usuario): bool
    {
        return in_array($usuario->rol, [
            'administrador', 'gerente', 'cliente'
        ]);
    }

    // Todos pueden ver el detalle
    public function view(Usuario $usuario, Producto $producto): bool
    {
        return in_array($usuario->rol, [
            'administrador', 'gerente', 'cliente'
        ]);
    }

    // Solo administrador y gerente pueden crear
    public function create(Usuario $usuario): bool
    {
        return in_array($usuario->rol, [
            'administrador', 'gerente'
        ]);
    }

    // Administrador edita todo
    // Gerente solo edita sus propios productos
    public function update(Usuario $usuario, Producto $producto): bool
    {
        if ($usuario->rol === 'administrador') {
            return true;
        }

        if ($usuario->rol === 'gerente') {
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