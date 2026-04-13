<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Venta;
use App\Policies\VentaPolicy;
use App\Models\Producto;
use App\Policies\ProductoPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Venta::class, VentaPolicy::class);
        Gate::policy(Producto::class, ProductoPolicy::class);
    }
}