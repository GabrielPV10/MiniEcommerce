<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta - MiniEcommerce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f7fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background: #1a202c;
            padding: 0 2rem;
            height: 56px;
            display: flex;
            align-items: center;
        }
        header a {
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
        }
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .box {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 2.5rem;
            width: 100%;
            max-width: 460px;
        }
        .box-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: .35rem;
        }
        .box-sub {
            font-size: .875rem;
            color: #718096;
            margin-bottom: 1.75rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .875rem;
        }
        .form-group { margin-bottom: 1.1rem; }
        .form-label {
            display: block;
            font-size: .875rem;
            font-weight: 500;
            margin-bottom: .35rem;
            color: #1a202c;
        }
        .form-control {
            width: 100%;
            padding: .5rem .75rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: .875rem;
            color: #1a202c;
            transition: border-color .15s, box-shadow .15s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49,130,206,.12);
        }
        .form-error { font-size: .78rem; color: #e53e3e; margin-top: .25rem; }
        .form-hint  { font-size: .78rem; color: #718096; margin-top: .25rem; }
        .alert-error {
            background: #fff5f5;
            color: #c53030;
            border: 1px solid #feb2b2;
            padding: .75rem 1rem;
            border-radius: 4px;
            font-size: .875rem;
            margin-bottom: 1.25rem;
        }
        .btn-submit {
            width: 100%;
            padding: .6rem 1rem;
            background: #38a169;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: .9375rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: .25rem;
            transition: background .15s;
        }
        .btn-submit:hover { background: #2f855a; }
        .notice {
            background: #ebf8ff;
            color: #2b6cb0;
            border: 1px solid #bee3f8;
            padding: .65rem 1rem;
            border-radius: 4px;
            font-size: .8rem;
            margin-bottom: 1.25rem;
        }
        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
        .link-row {
            text-align: center;
            font-size: .875rem;
            color: #718096;
        }
        .link-row a { color: #3182ce; text-decoration: none; font-weight: 500; }
        .link-row a:hover { text-decoration: underline; }
        footer {
            background: #1a202c;
            color: #718096;
            text-align: center;
            padding: 1rem;
            font-size: .8rem;
        }
    </style>
</head>
<body>
    <header>
        <a href="{{ route('home') }}">MiniEcommerce</a>
    </header>

    <main>
        <div class="box">
            <p class="box-title">Crear cuenta</p>
            <p class="box-sub">Completa el formulario para registrarte como cliente</p>

            <div class="notice">
                Tu cuenta se creara con rol de <strong>cliente</strong>.
                Los administradores pueden asignarte otros roles desde el panel.
            </div>

            @if($errors->any())
                <div class="alert-error">
                    <ul style="padding-left:1rem; margin:0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input
                            class="form-control"
                            type="text"
                            id="nombre"
                            name="nombre"
                            value="{{ old('nombre') }}"
                            placeholder="Juan"
                            autofocus
                        >
                        @error('nombre')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input
                            class="form-control"
                            type="text"
                            id="apellidos"
                            name="apellidos"
                            value="{{ old('apellidos') }}"
                            placeholder="Lopez"
                        >
                        @error('apellidos')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="correo">Correo electronico</label>
                    <input
                        class="form-control"
                        type="email"
                        id="correo"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="jlopez@tuxtla.tecnm.mx"
                    >
                    @error('correo')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="clave">Contrasena</label>
                        <input
                            class="form-control"
                            type="password"
                            id="clave"
                            name="clave"
                            placeholder="Minimo 6 caracteres"
                        >
                        @error('clave')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="clave_confirmation">Confirmar</label>
                        <input
                            class="form-control"
                            type="password"
                            id="clave_confirmation"
                            name="clave_confirmation"
                            placeholder="Repite la contrasena"
                        >
                    </div>
                </div>

                <button type="submit" class="btn-submit">Crear cuenta</button>
            </form>

            <hr class="divider">

            <p class="link-row">
                Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesion</a>
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} MiniEcommerce</p>
    </footer>
</body>
</html>
