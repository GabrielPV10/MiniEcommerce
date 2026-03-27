<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniEcommerce - Contáctanos</title>
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
        .info { flex: 1; min-width: 250px; }
        .info h2 { color: #2d3748; margin-bottom: 20px; font-size: 24px; }
        .info-item { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .info-item .icon { font-size: 30px; }
        .info-item p { color: #718096; font-size: 15px; }

        .formulario { flex: 1; min-width: 250px; }
        .formulario h2 { color: #2d3748; margin-bottom: 20px; font-size: 24px; }
        .formulario input,
        .formulario textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }
        .formulario textarea { height: 120px; resize: vertical; }
        .formulario button {
            background-color: #4299e1;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .formulario button:hover { background-color: #2b6cb0; }

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
        <h1>Contáctanos</h1>
    </div>

    <div class="contenido">
        <div class="info">
            <h2>Información de Contacto</h2>
            <div class="info-item">
                <div class="icon">📧</div>
                <p>contacto@miniecommerce.com</p>
            </div>
            <div class="info-item">
                <div class="icon">📞</div>
                <p>+52 961 123 4567</p>
            </div>
            <div class="info-item">
                <div class="icon">📍</div>
                <p>Tuxtla Gutiérrez, Chiapas, México</p>
            </div>
            <div class="info-item">
                <div class="icon">🕐</div>
                <p>Lunes a Viernes: 9:00am - 6:00pm</p>
            </div>
        </div>

        <div class="formulario">
            <h2>Envíanos un Mensaje</h2>
            <input type="text" placeholder="Tu nombre">
            <input type="email" placeholder="Tu correo electrónico">
            <textarea placeholder="Tu mensaje..."></textarea>
            <button type="button">Enviar Mensaje</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2026 MiniEcommerce - Desarrollo Web Avanzado</p>
    </footer>

</body>
</html>