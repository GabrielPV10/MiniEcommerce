<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Dashboard Empleado</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f7fafc; }
        nav {
            background-color: #2d3748;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .logo { color: white; font-size: 22px; font-weight: bold; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 20px; align-items: center; }
        nav ul li a { color: #cbd5e0; text-decoration: none; font-size: 15px; }

        .bienvenida {
            background: linear-gradient(135deg, #276749, #38a169);
            color: white;
            padding: 40px 30px;
        }
        .bienvenida h1 { font-size: 28px; margin-bottom: 5px; }
        .bienvenida p { font-size: 16px; opacity: 0.85; }

        .contenido {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 30px;
        }
        .cards {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
        }
        .card .icon { font-size: 40px; margin-bottom: 10px; }
        .card h3 { color: #2d3748; margin-bottom: 8px; }
        .card p { color: #718096; font-size: 14px; }
        .card .numero { font-size: 32px; font-weight: bold; color: #38a169; margin: 10px 0; }

        .seccion { background: white; border-radius: 10px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); margin-bottom: 25px; }
        .seccion h2 { color: #2d3748; margin-bottom: 20px; font-size: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            margin: 5px;
        }
        .btn-green { background-color: #38a169; color: white; }
        .btn-green:hover { background-color: #276749; }

        footer { background-color: #2d3748; color: #cbd5e0; text-align: center; padding: 20px; font-size: 14px; margin-top: 40px; }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('home') }}" class="logo">🛒 MiniEcommerce</a>
        <ul>
            <li><span style="color:#cbd5e0;">Hola, {{ auth()->user()->nombre ?? 'Empleado' }} 👋</span></li>
            <li>
                <form action="/logout" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#e53e3e; color:white; border:none; padding:8px 16px; border-radius:5px; cursor:pointer;">
                        Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="bienvenida">
        <h1>¡Bienvenido, {{ auth()->user()->nombre ?? 'Empleado' }}! 💼</h1>
        <p>Panel de gestión para empleados.</p>
    </div>

    <div class="contenido">
        <div class="cards">
            <div class="card">
                <div class="icon">📋</div>
                <h3>Pedidos Pendientes</h3>
                <div class="numero">0</div>
                <p>Por procesar</p>
            </div>
            <div class="card">
                <div class="icon">✅</div>
                <h3>Pedidos Completados</h3>
                <div class="numero">0</div>
                <p>Este mes</p>
            </div>
            <div class="card">
                <div class="icon">👥</div>
                <h3>Clientes Atendidos</h3>
                <div class="numero">0</div>
                <p>Este mes</p>
            </div>
        </div>

        <div class="seccion">
            <h2>⚡ Acciones Rápidas</h2>
            <a href="#" class="btn btn-green">📋 Ver Pedidos</a>
            <a href="#" class="btn btn-green">📦 Gestionar Inventario</a>
            <a href="#" class="btn btn-green">👥 Ver Clientes</a>
            <a href="#" class="btn btn-green">👤 Mi Perfil</a>
        </div>

        <div class="seccion">
            <h2>📋 Pedidos Pendientes</h2>
            <p style="color:#718096;">No hay pedidos pendientes por procesar.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>