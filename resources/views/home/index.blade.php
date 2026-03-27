<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Inicio</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; }

        /* Navbar */
        nav {
            background-color: #2d3748;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .logo {
            color: white;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        nav ul li a {
            color: #cbd5e0;
            text-decoration: none;
            font-size: 15px;
        }
        nav ul li a:hover { color: white; }
        .btn-login {
            background-color: #4299e1;
            color: white !important;
            padding: 8px 16px;
            border-radius: 5px;
        }
        .btn-login:hover { background-color: #2b6cb0 !important; }

        /* Hero */
        .hero {
            background: linear-gradient(135deg, #2d3748, #4299e1);
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .hero h1 { font-size: 48px; margin-bottom: 20px; }
        .hero p { font-size: 20px; margin-bottom: 30px; }
        .hero a {
            background-color: white;
            color: #2d3748;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
        }
        .hero a:hover { background-color: #edf2f7; }

        /* Cards */
        .cards {
            display: flex;
            justify-content: center;
            gap: 30px;
            padding: 60px 30px;
            background-color: #f7fafc;
            flex-wrap: wrap;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            width: 250px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card .icon { font-size: 40px; margin-bottom: 15px; }
        .card h3 { margin-bottom: 10px; color: #2d3748; }
        .card p { color: #718096; font-size: 14px; }

        /* Footer */
        footer {
            background-color: #2d3748;
            color: #cbd5e0;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('home') }}" class="logo">🛒 MiniEcommerce</a>
        <ul>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('quienes.somos') }}">Quiénes Somos</a></li>
            <li><a href="{{ route('mision') }}">Misión y Visión</a></li>
            <li><a href="{{ route('contacto') }}">Contáctanos</a></li>
            <li><a href="{{ route('ubicacion') }}">Ubicación</a></li>
            <li><a href="/login" class="btn-login">Iniciar Sesión</a></li>
        </ul>
    </nav>

    <!-- Hero -->
    <div class="hero">
        <h1>Bienvenido a MiniEcommerce</h1>
        <p>Tu tienda en línea de confianza</p>
        <a href="/register">Regístrate Gratis</a>
    </div>

    <!-- Cards -->
    <div class="cards">
        <div class="card">
            <div class="icon">🚚</div>
            <h3>Envío Rápido</h3>
            <p>Recibe tus productos en tiempo récord.</p>
        </div>
        <div class="card">
            <div class="icon">🔒</div>
            <h3>Compra Segura</h3>
            <p>Tus datos siempre protegidos.</p>
        </div>
        <div class="card">
            <div class="icon">💳</div>
            <h3>Fácil Pago</h3>
            <p>Múltiples métodos de pago disponibles.</p>
        </div>
        <div class="card">
            <div class="icon">⭐</div>
            <h3>Calidad Garantizada</h3>
            <p>Productos seleccionados con los mejores estándares.</p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>