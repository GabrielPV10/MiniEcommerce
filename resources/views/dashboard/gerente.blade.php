<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Dashboard Gerente</title>
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

        .bienvenida {
            background: linear-gradient(135deg, #744210, #d69e2e);
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
        .card .numero { font-size: 32px; font-weight: bold; color: #d69e2e; margin: 10px 0; }

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
        .btn-yellow { background-color: #d69e2e; color: white; }
        .btn-yellow:hover { background-color: #744210; }
        .btn-red { background-color: #e53e3e; color: white; }
        .btn-red:hover { background-color: #9b2c2c; }

        footer { background-color: #2d3748; color: #cbd5e0; text-align: center; padding: 20px; font-size: 14px; margin-top: 40px; }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('home') }}" class="logo">🛒 MiniEcommerce</a>
        <ul>
            <li><span style="color:#cbd5e0;">Hola, {{ auth()->user()->nombre ?? 'Gerente' }} 👋</span></li>
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
        <h1>¡Bienvenido, {{ auth()->user()->nombre ?? 'Gerente' }}! 👔</h1>
        <p>Panel de administración general del sistema.</p>
    </div>

    <div class="contenido">
        <div class="cards">
            <div class="card">
                <div class="icon">👥</div>
                <h3>Total Usuarios</h3>
                <div class="numero">0</div>
                <p>Registrados en el sistema</p>
            </div>
            <div class="card">
                <div class="icon">📦</div>
                <h3>Total Pedidos</h3>
                <div class="numero">0</div>
                <p>En el sistema</p>
            </div>
            <div class="card">
                <div class="icon">💰</div>
                <h3>Ventas Totales</h3>
                <div class="numero">$0</div>
                <p>Este mes</p>
            </div>
            <div class="card">
                <div class="icon">💼</div>
                <h3>Empleados</h3>
                <div class="numero">0</div>
                <p>Activos</p>
            </div>
        </div>

        <div class="seccion">
            <h2>⚡ Herramientas de Administración</h2>
            <a href="#" class="btn btn-yellow">👥 Gestionar Usuarios</a>
            <a href="#" class="btn btn-yellow">📦 Gestionar Pedidos</a>
            <a href="#" class="btn btn-yellow">📊 Ver Reportes</a>
            <a href="#" class="btn btn-yellow">💼 Gestionar Empleados</a>
            <a href="#" class="btn btn-red">⚙️ Configuración</a>
        </div>

        <div class="seccion">
            <h2>📊 Resumen del Sistema</h2>
            <p style="color:#718096;">No hay datos disponibles aún.</p>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>