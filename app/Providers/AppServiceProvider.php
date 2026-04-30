<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Categoria;
use App\Policies\CategoriaPolicy;
use App\Models\Venta;
use App\Policies\VentaPolicy;
use App\Models\Producto;
use App\Policies\ProductoPolicy;
use App\Models\Usuario;
use App\Policies\UsuarioPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Categoria::class, CategoriaPolicy::class);
        Gate::policy(Venta::class, VentaPolicy::class);
        Gate::policy(Producto::class, ProductoPolicy::class);
        Gate::policy(Usuario::class, UsuarioPolicy::class);
    }
}