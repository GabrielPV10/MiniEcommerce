<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f7fafc; margin: 0; padding: 0; }
        .container { max-width: 480px; margin: 40px auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; }
        .header { background: #1a202c; padding: 24px 32px; }
        .header h1 { color: #fff; margin: 0; font-size: 1.2rem; }
        .body { padding: 32px; }
        .body p { color: #4a5568; font-size: 0.95rem; line-height: 1.6; margin: 0 0 16px; }
        .code-box { background: #ebf8ff; border: 2px dashed #3182ce; border-radius: 6px; text-align: center; padding: 20px; margin: 24px 0; }
        .code { font-size: 2.5rem; font-weight: 700; letter-spacing: 0.4rem; color: #2b6cb0; }
        .expiry { font-size: 0.8rem; color: #718096; margin-top: 8px; }
        .footer { background: #f7fafc; padding: 16px 32px; border-top: 1px solid #e2e8f0; font-size: 0.8rem; color: #a0aec0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MiniEcommerce</h1>
        </div>
        <div class="body">
            <p>Hola <strong>{{ $nombre }}</strong>,</p>
            <p>Recibimos una solicitud de acceso a tu cuenta. Usa el siguiente codigo para completar tu inicio de sesion:</p>

            <div class="code-box">
                <div class="code">{{ $codigo }}</div>
                <div class="expiry">Este codigo expira en <strong>5 minutos</strong></div>
            </div>

            <p>Si no solicitaste este codigo, ignora este correo. Tu cuenta sigue siendo segura.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} MiniEcommerce &mdash; Este es un correo automatico, no respondas.
        </div>
    </div>
</body>
</html>
