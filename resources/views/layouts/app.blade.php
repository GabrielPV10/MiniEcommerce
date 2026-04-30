<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <style>
        :root {
            --nav-bg:  #1a202c;
            --accent:  #3182ce;
            --accent2: #2b6cb0;
            --green:   #38a169;
            --green2:  #2f855a;
            --red:     #e53e3e;
            --red2:    #c53030;
            --orange:  #dd6b20;
            --bg:      #f7fafc;
            --surface: #ffffff;
            --border:  #e2e8f0;
            --text:    #1a202c;
            --muted:   #718096;
            --r:       4px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 15px;
            line-height: 1.5;
        }

        /* ── Nav ── */
        .nav {
            background: var(--nav-bg);
            padding: 0 1.5rem;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,.3);
        }
        .nav-brand {
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            letter-spacing: -.2px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            list-style: none;
        }
        .nav-links a {
            color: #a0aec0;
            text-decoration: none;
            padding: .4rem .8rem;
            border-radius: var(--r);
            font-size: .875rem;
            transition: color .15s, background .15s;
        }
        .nav-links a:hover { color: #fff; background: rgba(255,255,255,.08); }
        .nav-right { display: flex; align-items: center; gap: .75rem; }
        .nav-user  { color: #a0aec0; font-size: .8rem; }
        .nav-user strong { color: #e2e8f0; }
        .btn-nav-out {
            background: var(--red);
            color: #fff;
            border: none;
            padding: .35rem .8rem;
            border-radius: var(--r);
            font-size: .8rem;
            cursor: pointer;
            transition: background .15s;
        }
        .btn-nav-out:hover { background: var(--red2); }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .45rem 1rem;
            border-radius: var(--r);
            font-size: .875rem;
            font-weight: 500;
            text-decoration: none;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all .15s;
            white-space: nowrap;
        }
        .btn-sm   { padding: .3rem .65rem; font-size: .8rem; }
        .btn-primary { background: var(--accent);  color: #fff; }
        .btn-primary:hover { background: var(--accent2); color: #fff; }
        .btn-success { background: var(--green);  color: #fff; }
        .btn-success:hover { background: var(--green2); color: #fff; }
        .btn-danger  { background: var(--red);    color: #fff; }
        .btn-danger:hover  { background: var(--red2);  color: #fff; }
        .btn-warning { background: var(--orange); color: #fff; }
        .btn-warning:hover { background: #c05621; color: #fff; }
        .btn-ghost   { background: transparent; color: var(--text); border-color: var(--border); }
        .btn-ghost:hover { background: var(--bg); }

        /* ── Page bar ── */
        .page-bar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 1.1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-bar h1 { font-size: 1.3rem; font-weight: 600; }
        .page-bar .sub { font-size: .8rem; color: var(--muted); margin-top: 2px; }

        /* ── Wrap ── */
        .wrap { max-width: 1200px; margin: 1.5rem auto; padding: 0 1.5rem; }

        /* ── Card ── */
        .card { background: #fff; border: 1px solid var(--border); border-radius: var(--r); }
        .card-body { padding: 1.25rem; }
        .card-head {
            padding: .875rem 1.25rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card-head h2 { font-size: .9375rem; font-weight: 600; }

        /* ── Stats ── */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 1.25rem;
        }
        .stat-label { font-size: .72rem; text-transform: uppercase; letter-spacing: .07em; color: var(--muted); }
        .stat-num   { font-size: 2rem; font-weight: 700; line-height: 1.1; margin: .4rem 0; }
        .stat-sub   { font-size: .78rem; color: var(--muted); }
        .stat.blue   .stat-num { color: var(--accent); }
        .stat.green  .stat-num { color: var(--green); }
        .stat.orange .stat-num { color: var(--orange); }
        .stat.red    .stat-num { color: var(--red); }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table.tbl { width: 100%; border-collapse: collapse; font-size: .875rem; }
        table.tbl thead th {
            background: var(--nav-bg);
            color: #e2e8f0;
            padding: .7rem 1rem;
            text-align: left;
            font-weight: 500;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        table.tbl tbody td {
            padding: .75rem 1rem;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        table.tbl tbody tr:hover { background: #f7fafc; }
        table.tbl tbody tr:last-child td { border-bottom: none; }

        /* ── Alerts ── */
        .alert   { padding: .75rem 1rem; border-radius: var(--r); margin-bottom: 1rem; font-size: .875rem; }
        .alert-s { background: #f0fff4; color: #276749; border: 1px solid #9ae6b4; }
        .alert-e { background: #fff5f5; color: #c53030; border: 1px solid #feb2b2; }

        /* ── Forms ── */
        .form-group { margin-bottom: 1.1rem; }
        .form-label { display: block; font-size: .875rem; font-weight: 500; margin-bottom: .35rem; }
        .form-control {
            width: 100%;
            padding: .5rem .75rem;
            border: 1px solid var(--border);
            border-radius: var(--r);
            font-size: .875rem;
            color: var(--text);
            background: #fff;
            transition: border-color .15s, box-shadow .15s;
        }
        .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(49,130,206,.12); }
        textarea.form-control { resize: vertical; min-height: 90px; }
        .form-hint  { font-size: .78rem; color: var(--muted); margin-top: .25rem; }
        .form-error { font-size: .78rem; color: var(--red); margin-top: .25rem; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        /* ── Badge ── */
        .badge {
            display: inline-block;
            padding: .15rem .55rem;
            border-radius: 9999px;
            font-size: .72rem;
            font-weight: 500;
        }
        .badge-blue   { background: #ebf8ff; color: #2b6cb0; }
        .badge-green  { background: #f0fff4; color: #276749; }
        .badge-red    { background: #fff5f5; color: #c53030; }
        .badge-yellow { background: #fffff0; color: #975a16; }
        .badge-gray   { background: #f7fafc; color: #4a5568; }

        /* ── Actions ── */
        .actions { display: flex; gap: .35rem; align-items: center; }

        /* ── Quick actions ── */
        .qa-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: .75rem;
        }
        .qa-item {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--r);
            padding: 1.1rem 1.25rem;
            text-decoration: none;
            color: var(--text);
            transition: border-color .15s, box-shadow .15s;
            display: block;
        }
        .qa-item:hover {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(49,130,206,.1);
            color: var(--text);
        }
        .qa-item .qa-title { font-weight: 600; font-size: .9rem; margin-bottom: .2rem; }
        .qa-item .qa-desc  { font-size: .8rem; color: var(--muted); }

        /* ── Util ── */
        .mb-1 { margin-bottom: .5rem; }
        .mb-2 { margin-bottom: 1rem; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: .5rem; }
        .text-muted { color: var(--muted); }
        .text-sm  { font-size: .875rem; }
        .font-bold { font-weight: 700; }
        .section-label {
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .07em;
            color: var(--muted);
            margin-bottom: .75rem;
        }

        /* ── Footer ── */
        footer {
            background: var(--nav-bg);
            color: #718096;
            text-align: center;
            padding: 1.1rem;
            font-size: .8rem;
            margin-top: 3rem;
        }
        footer a { color: #a0aec0; text-decoration: none; }
        footer a:hover { color: #e2e8f0; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="nav">
    <a href="{{ route('home') }}" class="nav-brand">{{ config('app.name') }}</a>

    <ul class="nav-links">
        @auth
            @php $rol = auth()->user()->rol; @endphp

            @if($rol === 'administrador')
                <li><a href="{{ route('dashboard.administrador') }}">Panel</a></li>
                <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
            @elseif($rol === 'gerente')
                <li><a href="{{ route('dashboard.gerente') }}">Panel</a></li>
            @elseif($rol === 'empleado')
                <li><a href="{{ route('dashboard.empleado') }}">Mi panel</a></li>
            @else
                <li><a href="{{ route('dashboard.cliente') }}">Mi panel</a></li>
            @endif

            <li><a href="{{ route('productos.index') }}">Productos</a></li>
            <li><a href="{{ route('categorias.index') }}">Categorias</a></li>

            @if(in_array($rol, ['administrador', 'gerente', 'empleado']))
                <li><a href="{{ route('ventas.index') }}">Ventas</a></li>
            @endif
        @else
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('quienes.somos') }}">Nosotros</a></li>
            <li><a href="{{ route('contacto') }}">Contacto</a></li>
        @endauth
    </ul>

    <div class="nav-right">
        @auth
            <span class="nav-user">
                <strong>{{ auth()->user()->nombre }}</strong>
                &middot; {{ ucfirst(auth()->user()->rol) }}
            </span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-nav-out">Cerrar sesion</button>
            </form>
        @else
            <a href="{{ route('login') }}"    class="btn btn-primary btn-sm">Iniciar sesion</a>
            <a href="{{ route('register') }}" class="btn btn-ghost   btn-sm">Registrarse</a>
        @endauth
    </div>
</nav>

@yield('content')

<footer>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }} &mdash; <a href="{{ route('home') }}">Inicio</a></p>
</footer>

@stack('scripts')
</body>
</html>
