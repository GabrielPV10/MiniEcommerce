<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f7fafc; margin: 0; padding: 0; }
        .container { max-width: 520px; margin: 40px auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; }
        .header { background: #2b6cb0; padding: 24px 32px; }
        .header h1 { color: #fff; margin: 0; font-size: 1.2rem; }
        .header p { color: #bee3f8; margin: 4px 0 0; font-size: .875rem; }
        .body { padding: 32px; }
        .body p { color: #4a5568; font-size: .95rem; line-height: 1.6; margin: 0 0 16px; }
        .section-title { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: #718096; margin: 24px 0 8px; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e2e8f0; font-size: .875rem; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #718096; }
        .info-value { color: #1a202c; font-weight: 500; }
        .total { font-size: 1.2rem; font-weight: 700; color: #2b6cb0; }
        .badge { display: inline-block; background: #ebf8ff; color: #2b6cb0; border: 1px solid #bee3f8; padding: 4px 12px; border-radius: 9999px; font-size: .8rem; font-weight: 600; }
        .contact-box { background: #fffff0; border: 1px solid #f6e05e; border-radius: 6px; padding: 16px; margin-top: 20px; font-size: .875rem; color: #744210; }
        .footer { background: #f7fafc; padding: 16px 32px; border-top: 1px solid #e2e8f0; font-size: .8rem; color: #a0aec0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MiniEcommerce</h1>
            <p>Confirmacion de compra</p>
        </div>
        <div class="body">
            <p>Hola <strong>{{ $venta->cliente->nombre }} {{ $venta->cliente->apellidos }}</strong>,</p>
            <p>Tu compra ha sido <span class="badge">CONFIRMADA</span>. Aqui estan los detalles:</p>

            <p class="section-title">Resumen de tu compra</p>
            <div class="info-row">
                <span class="info-label">Producto</span>
                <span class="info-value">{{ $venta->producto->nombre ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total pagado</span>
                <span class="info-value total">${{ number_format($venta->total, 2) }}</span>
            </div>

            <div class="contact-box">
                <strong>Siguiente paso:</strong> Para coordinar la entrega de tu producto, contacta al vendedor directamente:<br><br>
                📧 <strong>{{ $venta->vendedor->correo ?? '—' }}</strong>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} MiniEcommerce &mdash; Este es un correo automatico.
        </div>
    </div>
</body>
</html>
