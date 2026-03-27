<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;

// ─── Rutas públicas ───────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Registro
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Páginas estáticas - Emanuel (Integrante 2)
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('quienes.somos');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/mision', [HomeController::class, 'mision'])->name('mision');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');

// ─── Rutas protegidas (requieren login) ───────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard/cliente',  function () {
        return view('dashboard.cliente');
    });
    Route::get('/dashboard/empleado', function () {
        return view('dashboard.empleado');
    });
    Route::get('/dashboard/gerente',  function () {
        return view('dashboard.gerente');
    });

    Route::resource('usuarios', UsuarioController::class);
});