<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// ─── Rutas públicas ───────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// Registro
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

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
});