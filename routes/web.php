<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;

// ─── Rutas públicas ───────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Páginas estáticas - Emanuel
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('quienes.somos');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/mision', [HomeController::class, 'mision'])->name('mision');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');

// ─── Rutas protegidas (requieren login) ───────────
Route::middleware('auth')->group(function () {
    // Dashboards
    Route::get('/dashboard/cliente', function () {
        return view('dashboard.cliente');
    });
    Route::get('/dashboard/empleado', function () {
        return view('dashboard.empleado');
    });
    Route::get('/dashboard/gerente', function () {
        return view('dashboard.gerente');
    });

    // CRUD Categorias - Gabriel
    Route::resource('categorias', CategoriaController::class);

    // CRUD Ventas - Angel Mauricio
    Route::resource('ventas', VentaController::class);

    Route::resource('productos', ProductoController::class);
});