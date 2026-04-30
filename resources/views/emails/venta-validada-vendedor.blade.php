<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f7fafc; margin: 0; padding: 0; }
        .container { max-width: 520px; margin: 40px auto; background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; overflow: hidden; }
        .header { background: #276749; padding: 24px 32px; }
        .header h1 { color: #fff; margin: 0; font-size: 1.2rem; }
        .header p { color: #9ae6b4; margin: 4px 0 0; font-size: .875rem; }
        .body { padding: 32px; }
        .body p { color: #4a5568; font-size: .95rem; line-height: 1.6; margin: 0 0 16px; }
        .section-title { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: #718096; margin: 24px 0 8px; }
        .info-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #e2e8f0; font-size: .875rem; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #718096; }
        .info-value { color: #1a202c; font-weight: 500; }
        .total { font-size: 1.2rem; font-weight: 700; color: #276749; }
        .badge { display: inline-block; background: #f0fff4; color: #276749; border: 1px solid #9ae6b4; padding: 4px 12px; border-radius: 9999px; font-size: .8rem; font-weight: 600; }
        .footer { background: #f7fafc; padding: 16px 32px; border-top: 1px solid #e2e8f0; font-size: .8rem; color: #a0aec0; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>MiniEcommerce</h1>
            <p>Notificacion de venta validada</p>
        </div>
        <div class="body">
            <p>Hola <strong>{{ $venta->vendedor->nombre }} {{ $venta->vendedor->apellidos }}</strong>,</p>
            <p>Tu venta ha sido <span class="badge">VALIDADA</span> por el equipo. A continuacion los detalles:</p>

            <p class="section-title">Producto vendido</p>
            <div class="info-row">
                <span class="info-label">Producto</span>
                <span class="info-value">{{ $venta->producto->nombre ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Fecha de venta</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Total</span>
                <span class="info-value total">${{ number_format($venta->total, 2) }}</span>
            </div>

            <p class="section-title">Datos del comprador</p>
            <div class="info-row">
                <span class="info-label">Nombre</span>
                <span class="info-value">{{ $venta->cliente->nombre ?? '—' }} {{ $venta->cliente->apellidos ?? '' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Correo</span>
                <span class="info-value">{{ $venta->cliente->correo ?? '—' }}</span>
            </div>

            <p style="margin-top:24px">El comprador podra contactarte para coordinar la entrega.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} MiniEcommerce &mdash; Este es un correo automatico.
        </div>
    </div>
</body>
</html>
