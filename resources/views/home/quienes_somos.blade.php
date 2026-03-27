<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Quiénes Somos</title>
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
        }
        .contenido h2 { color: #2d3748; margin-bottom: 15px; font-size: 26px; }
        .contenido p { color: #718096; line-height: 1.8; margin-bottom: 30px; font-size: 16px; }

        .equipo {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .miembro {
            background: #f7fafc;
            border-radius: 10px;
            padding: 25px;
            width: 220px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .miembro .avatar { font-size: 50px; margin-bottom: 10px; }
        .miembro h4 { color: #2d3748; margin-bottom: 5px; }
        .miembro p { color: #718096; font-size: 13px; }

        footer { background-color: #2d3748; color: #cbd5e0; text-align: center; padding: 20px; font-size: 14px; margin-top: 60px; }
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
        <h1>Quiénes Somos</h1>
    </div>

    <div class="contenido">
        <h2>Nuestra Historia</h2>
        <p>MiniEcommerce nació como un proyecto académico desarrollado por estudiantes de la materia Desarrollo Web Avanzado. Nuestro objetivo es construir una plataforma de comercio electrónico funcional, segura y fácil de usar.</p>

        <h2>Nuestro Equipo</h2>
        <p>Somos un equipo de tres integrantes comprometidos con el desarrollo de software de calidad.</p>

        <div class="equipo">
            <div class="miembro">
                <div class="avatar">👨‍💻</div>
                <h4>Gabriel</h4>
                <p>Autenticación y Base de datos</p>
            </div>
            <div class="miembro">
                <div class="avatar">👨‍💻</div>
                <h4>Emanuel</h4>
                <p>Páginas estáticas y Dashboards</p>
            </div>
            <div class="miembro">
                <div class="avatar">👨‍💻</div>
                <h4>Angel Mauricio</h4>
                <p>CRUD de Usuarios</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>