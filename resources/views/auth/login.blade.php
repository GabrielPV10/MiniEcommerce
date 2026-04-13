<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MiniEcommerce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #2d3748, #4299e1); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card { background: white; border-radius: 10px; padding: 40px; width: 100%; max-width: 400px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        h1 { color: #2d3748; text-align: center; margin-bottom: 30px; font-size: 28px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #4a5568; }
        input { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 5px; font-size: 15px; }
        input:focus { outline: none; border-color: #4299e1; }
        .error { color: red; font-size: 13px; margin-top: 5px; }
        .btn { width: 100%; padding: 12px; background: #4299e1; color: white; border: none; border-radius: 5px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn:hover { background: #2b6cb0; }
        .logo { text-align: center; font-size: 40px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">🛒</div>
        <h1>MiniEcommerce</h1>

        @if($errors->any())
            <div style="background:#fed7d7; color:#9b2c2c; padding:12px; border-radius:5px; margin-bottom:20px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label>Correo</label>
                <input type="email" name="correo" value="{{ old('correo') }}" placeholder="correo@tuxtla.tecnm.mx">
                @error('correo') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="clave" placeholder="••••••">
                @error('clave') <div class="error">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>