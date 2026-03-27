<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Misión y Visión</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; }
        nav {
            background-color: #2d3748;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .logo { color: white; font-size: 22px; font-weight: bold; text-decoration: none; }
        nav ul { list-style: none; display: flex; gap: 20px; }
        nav ul li a { color: #cbd5e0; text-decoration: none; font-size: 15px; }
        nav ul li a:hover { color: white; }
        .btn-login { background-color: #4299e1; color: white !important; padding: 8px 16px; border-radius: 5px; }

        .hero-small {
            background: linear-gradient(135deg, #2d3748, #4299e1);
            color: white;
            text-align: center;
            padding: 60px 20px;
        }
        .hero-small h1 { font-size: 36px; }

        .contenido {
            max-width: 900px;
            margin: 60px auto;
            padding: 0 30px;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }
        .caja {
            flex: 1;
            min-width: 250px;
            background: #f7fafc;
            border-radius: 10px;
            padding: 35px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
        }
        .caja .icon { font-size: 50px; margin-bottom: 15px; }
        .caja h2 { color: #2d3748; margin-bottom: 15px; font-size: 24px; }
        .caja p { color: #718096; line-height: 1.8; font-size: 15px; }

        .valores {
            max-width: 900px;
            margin: 0 auto 60px;
            padding: 0 30px;
        }
        .valores h2 { color: #2d3748; font-size: 26px; margin-bottom: 20px; text-align: center; }
        .valores ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }
        .valores ul li {
            background: #4299e1;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        footer { background-color: #2d3748; color: #cbd5e0; text-align: center; padding: 20px; font-size: 14px; }
    </style>
</head>
<body>

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

    <div class="hero-small">
        <h1>Misión y Visión</h1>
    </div>

    <div class="contenido">
        <div class="caja">
            <div class="icon">🎯</div>
            <h2>Misión</h2>
            <p>Proveer una plataforma de comercio electrónico accesible, segura y eficiente que conecte a compradores y vendedores, ofreciendo una experiencia de compra excepcional con tecnología de vanguardia.</p>
        </div>
        <div class="caja">
            <div class="icon">🔭</div>
            <h2>Visión</h2>
            <p>Ser la plataforma de ecommerce líder en nuestra región, reconocida por su innovación, confiabilidad y compromiso con la satisfacción del cliente, impulsando el comercio digital.</p>
        </div>
    </div>

    <div class="valores">
        <h2>Nuestros Valores</h2>
        <ul>
            <li>✅ Innovación</li>
            <li>✅ Confianza</li>
            <li>✅ Calidad</li>
            <li>✅ Compromiso</li>
            <li>✅ Trabajo en Equipo</li>
            <li>✅ Transparencia</li>
        </ul>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>