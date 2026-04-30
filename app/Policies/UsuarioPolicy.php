<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
{
    // Solo administrador puede ver la lista de usuarios
    public function viewAny(Usuario $auth): bool
    {
        return $auth->rol === 'administrador';
    }

    // Solo administrador puede ver el detalle
    public function view(Usuario $auth, Usuario $usuario): bool
    {
        return $auth->rol === 'administrador';
    }

    // Solo administrador puede crear usuarios
    public function create(Usuario $auth): bool
    {
        return $auth->rol === 'administrador';
    }

    // Administrador: edita cualquiera
    // Gerente: solo puede editar clientes
    public function update(Usuario $auth, Usuario $usuario): bool
    {
        if ($auth->rol === 'administrador') {
            return true;
        }

        if ($auth->rol === 'gerente') {
            return $usuario->rol === 'cliente';
        }

        return false;
    }

    // Solo administrador puede eliminar
    public function delete(Usuario $auth, Usuario $usuario): bool
    {
        return $auth->rol === 'administrador';
    }
}
