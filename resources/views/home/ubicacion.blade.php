<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Ubicación</title>
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
        .contenido h2 { color: #2d3748; margin-bottom: 20px; font-size: 24px; text-align: center; }

        .mapa {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .datos {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .dato {
            background: #f7fafc;
            border-radius: 10px;
            padding: 25px;
            width: 220px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .dato .icon { font-size: 40px; margin-bottom: 10px; }
        .dato h4 { color: #2d3748; margin-bottom: 8px; }
        .dato p { color: #718096; font-size: 14px; }

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
        <h1>Ubicación</h1>
    </div>

    <div class="contenido">
        <h2>¿Dónde estamos?</h2>

        <!-- Mapa de Google Maps -->
        <iframe
            class="mapa"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60978.44765529038!2d-93.1720988!3d16.7520968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd8658a4b8a45%3A0x4a45bac4697f8a0!2sTuxtla%20Guti%C3%A9rrez%2C%20Chis.!5e0!3m2!1ses!2smx!4v1234567890"
            allowfullscreen=""
            loading="lazy">
        </iframe>

        <div class="datos">
            <div class="dato">
                <div class="icon">📍</div>
                <h4>Dirección</h4>
                <p>Tuxtla Gutiérrez, Chiapas, México</p>
            </div>
            <div class="dato">
                <div class="icon">🕐</div>
                <h4>Horario</h4>
                <p>Lunes a Viernes 9:00am - 6:00pm</p>
            </div>
            <div class="dato">
                <div class="icon">📞</div>
                <h4>Teléfono</h4>
                <p>+52 961 123 4567</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>