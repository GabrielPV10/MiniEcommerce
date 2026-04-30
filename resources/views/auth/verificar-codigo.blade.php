<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion de dos factores - MiniEcommerce</title>
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
        header a { color: #fff; text-decoration: none; font-weight: 700; font-size: 1.1rem; }
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
            max-width: 400px;
        }
        .box-icon {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .box-title { font-size: 1.4rem; font-weight: 700; color: #1a202c; margin-bottom: .35rem; text-align: center; }
        .box-sub { font-size: .875rem; color: #718096; margin-bottom: 1.75rem; text-align: center; line-height: 1.5; }
        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; font-size: .875rem; font-weight: 500; margin-bottom: .35rem; color: #1a202c; }
        .form-control {
            width: 100%;
            padding: .6rem .75rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: .4rem;
            text-align: center;
            color: #1a202c;
            transition: border-color .15s, box-shadow .15s;
        }
        .form-control:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49,130,206,.12);
        }
        .form-error { font-size: .78rem; color: #e53e3e; margin-top: .25rem; text-align: center; }
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
            background: #3182ce;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: .9375rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: .5rem;
            transition: background .15s;
        }
        .btn-submit:hover { background: #2b6cb0; }
        .divider { border: none; border-top: 1px solid #e2e8f0; margin: 1.5rem 0; }
        .link-row { text-align: center; font-size: .875rem; color: #718096; }
        .link-row a { color: #3182ce; text-decoration: none; font-weight: 500; }
        .link-row a:hover { text-decoration: underline; }
        .info-box {
            background: #ebf8ff;
            border: 1px solid #bee3f8;
            border-radius: 4px;
            padding: .75rem 1rem;
            font-size: .825rem;
            color: #2b6cb0;
            margin-bottom: 1.25rem;
            text-align: center;
        }
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
            <div class="box-icon">🔐</div>
            <p class="box-title">Verificacion de identidad</p>
            <p class="box-sub">Enviamos un codigo de 6 digitos a tu correo electronico. Ingresalo para continuar.</p>

            @if($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif

            <div class="info-box">
                El codigo expira en <strong>5 minutos</strong>
            </div>

            <form method="POST" action="{{ route('2fa.verificar') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="codigo">Codigo de verificacion</label>
                    <input
                        class="form-control"
                        type="text"
                        id="codigo"
                        name="codigo"
                        maxlength="6"
                        placeholder="000000"
                        autofocus
                        autocomplete="one-time-code"
                    >
                    @error('codigo')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">Verificar y entrar</button>
            </form>

            <hr class="divider">

            <p class="link-row">
                <a href="{{ route('login') }}">Volver al inicio de sesion</a>
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} MiniEcommerce</p>
    </footer>
</body>
</html>
