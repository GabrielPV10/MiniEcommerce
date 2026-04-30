<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;

// ─── Rutas públicas ───────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Registro público (solo crea clientes)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2FA — solo accesibles sin sesion activa
Route::get('/2fa',           [AuthController::class, 'show2fa'])->name('2fa.show');
Route::post('/2fa/verificar',[AuthController::class, 'verify2fa'])->name('2fa.verificar');

// Páginas estáticas - Emanuel
Route::get('/quienes-somos', [HomeController::class, 'quienesSomos'])->name('quienes.somos');
Route::get('/contacto', [HomeController::class, 'contacto'])->name('contacto');
Route::get('/mision', [HomeController::class, 'mision'])->name('mision');
Route::get('/ubicacion', [HomeController::class, 'ubicacion'])->name('ubicacion');

// ─── Rutas protegidas (requieren login) ───────────
Route::middleware('auth')->group(function () {
    // Dashboards (con verificación de rol y datos reales)
    Route::get('/dashboard/cliente', function () {
        abort_unless(auth()->user()->rol === 'cliente', 403);

        $query = \App\Models\Producto::with(['categorias', 'usuario']);

        if (request('buscar')) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', '%' . request('buscar') . '%')
                  ->orWhere('descripcion', 'like', '%' . request('buscar') . '%');
            });
        }

        $categoriaActiva = null;
        if (request('categoria')) {
            $categoriaActiva = \App\Models\Categoria::find(request('categoria'));
            $query->whereHas('categorias', fn($q) => $q->where('categorias.id', request('categoria')));
        }

        $productos  = $query->orderBy('nombre')->get();
        $categorias = \App\Models\Categoria::orderBy('nombre')->get();

        return view('dashboard.cliente', compact('productos', 'categorias', 'categoriaActiva'));
    })->name('dashboard.cliente');

    Route::get('/dashboard/empleado', function () {
        abort_unless(in_array(auth()->user()->rol, ['empleado', 'gerente', 'administrador']), 403);
        $stats = [
            'mis_productos' => \App\Models\Producto::where('usuario_id', auth()->id())->count(),
            'mis_ventas'    => \App\Models\Venta::where('vendedor_id', auth()->id())->count(),
            'total_ventas'  => \App\Models\Venta::where('vendedor_id', auth()->id())->sum('total'),
            'clientes'      => \App\Models\Usuario::where('rol', 'cliente')->count(),
        ];
        return view('dashboard.empleado', compact('stats'));
    })->name('dashboard.empleado');

    Route::get('/dashboard/administrador', function () {
        abort_unless(auth()->user()->rol === 'administrador', 403);

        $stats = [
            'total_usuarios'   => \App\Models\Usuario::count(),
            'vendedores'       => \App\Models\Usuario::whereIn('rol', ['gerente', 'empleado'])->count(),
            'compradores'      => \App\Models\Usuario::where('rol', 'cliente')->count(),
            'total_productos'  => \App\Models\Producto::count(),
            'total_ventas'     => \App\Models\Venta::count(),
            'ventas_validadas' => \App\Models\Venta::where('validada', true)->count(),
            'ingresos'         => \App\Models\Venta::sum('total'),
            'total_categorias' => \App\Models\Categoria::count(),
        ];

        // Productos por categoría usando Eloquent withCount
        $productosPorCategoria = \App\Models\Categoria::withCount('productos')
            ->orderByDesc('productos_count')
            ->get();

        // Producto más vendido usando hasMany + withCount
        $productoMasVendido = \App\Models\Producto::withCount('ventas')
            ->with('categorias')
            ->orderByDesc('ventas_count')
            ->first();

        // Comprador más frecuente por categoría — colecciones Eloquent
        $compradorPorCategoria = \App\Models\Categoria::with([
            'productos.ventas.cliente',
        ])->get()->map(function ($categoria) {
            $ventas = $categoria->productos->flatMap(fn($p) => $p->ventas);
            if ($ventas->isEmpty()) return null;
            $agrupado   = $ventas->groupBy('cliente_id')->sortByDesc(fn($v) => $v->count());
            $topId      = $agrupado->keys()->first();
            $topCliente = $ventas->firstWhere('cliente_id', $topId)?->cliente;
            return [
                'categoria' => $categoria->nombre,
                'cliente'   => $topCliente,
                'compras'   => $agrupado->first()->count(),
            ];
        })->filter()->values();

        return view('dashboard.administrador', compact(
            'stats',
            'productosPorCategoria',
            'productoMasVendido',
            'compradorPorCategoria'
        ));
    })->name('dashboard.administrador');

    Route::get('/dashboard/gerente', function () {
        abort_unless(in_array(auth()->user()->rol, ['gerente', 'administrador']), 403);
        $stats = [
            'usuarios'   => \App\Models\Usuario::count(),
            'productos'  => \App\Models\Producto::count(),
            'ventas'     => \App\Models\Venta::count(),
            'categorias' => \App\Models\Categoria::count(),
            'ingresos'   => \App\Models\Venta::sum('total'),
        ];
        return view('dashboard.gerente', compact('stats'));
    })->name('dashboard.gerente');

    // CRUD Categorias - Gabriel
    Route::resource('categorias', CategoriaController::class);

    // CRUD Ventas - Angel Mauricio
    Route::resource('ventas', VentaController::class);
    Route::get('/ventas/{venta}/ticket',   [VentaController::class, 'ticket'])->name('ventas.ticket');
    Route::post('/ventas/{venta}/validar', [VentaController::class, 'validar'])->name('ventas.validar');

    Route::resource('productos', ProductoController::class);

    // CRUD Usuarios
    Route::resource('usuarios', UsuarioController::class);
});