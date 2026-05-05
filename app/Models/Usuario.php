<?php

namespace App\Models;

use App\Models\Categoria;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'clave',
        'rol',
    ];

    protected $hidden = [
        'clave',
    ];

    protected function casts(): array
    {
        return [
            'clave' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Relaciones
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    public function ventasComoCliente()
    {
        return $this->hasMany(Venta::class, 'cliente_id');
    }

    public function ventasComoVendedor()
    {
        return $this->hasMany(Venta::class, 'vendedor_id');
    }

    public function categorias()
    {
    return $this->hasManyThrough(
        Categoria::class,
        Producto::class,
        'usuario_id',   // FK en productos que apunta a usuarios
        'id',           // PK de categorias
        'id',           // PK de usuarios
        'categoria_id'  // FK en la tabla pivot categoria_producto
    );
}
}