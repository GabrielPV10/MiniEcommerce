<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:-apple-system, BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; background:#f0f2f5; color:#1a202c; font-size:15px; }

        /* ── Topbar ── */
        .topbar {
            background:#1a202c;
            position:sticky; top:0; z-index:200;
            box-shadow:0 2px 8px rgba(0,0,0,.35);
        }
        .topbar-inner {
            max-width:1280px; margin:0 auto;
            padding:0 1.5rem;
            height:64px;
            display:flex; align-items:center; gap:1.25rem;
        }
        .store-brand {
            color:#fff; font-size:1.5rem; font-weight:800;
            text-decoration:none; letter-spacing:-1px; flex-shrink:0;
        }
        .store-brand span { color:#63b3ed; }

        /* Search */
        .search-form { flex:1; display:flex; max-width:520px; }
        .search-input {
            flex:1; padding:.55rem 1rem;
            border:none; border-radius:6px 0 0 6px;
            font-size:.9rem; outline:none;
            background:#fff;
        }
        .search-btn {
            background:#3182ce; border:none; padding:.55rem 1rem;
            border-radius:0 6px 6px 0; color:#fff;
            cursor:pointer; font-size:1rem; transition:background .15s;
        }
        .search-btn:hover { background:#2b6cb0; }

        /* Right actions */
        .topbar-actions { display:flex; align-items:center; gap:.75rem; margin-left:auto; }

        .icon-btn {
            position:relative; background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.12);
            color:#fff; border-radius:8px;
            width:42px; height:42px;
            display:flex; align-items:center; justify-content:center;
            text-decoration:none; font-size:1.2rem; cursor:pointer;
            transition:background .15s;
        }
        .icon-btn:hover { background:rgba(255,255,255,.18); }
        .icon-badge {
            position:absolute; top:-5px; right:-5px;
            background:#e53e3e; color:#fff;
            font-size:.6rem; font-weight:700;
            border-radius:999px; padding:2px 5px;
            border:2px solid #1a202c;
        }

        /* Account dropdown */
        .account-wrap { position:relative; }
        .account-btn {
            display:flex; align-items:center; gap:.5rem;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.12);
            color:#fff; border-radius:8px;
            padding:.45rem .85rem; cursor:pointer;
            font-size:.85rem; transition:background .15s;
        }
        .account-btn:hover { background:rgba(255,255,255,.18); }
        .account-avatar {
            width:28px; height:28px; border-radius:50%;
            background:#3182ce; display:flex; align-items:center;
            justify-content:center; font-size:.8rem; font-weight:700;
        }
        .account-name { max-width:100px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
        .account-caret { font-size:.65rem; opacity:.7; }

        .dropdown-menu {
            display:none; position:absolute; right:0; top:calc(100% + 8px);
            background:#fff; border:1px solid #e2e8f0;
            border-radius:8px; min-width:200px;
            box-shadow:0 8px 24px rgba(0,0,0,.12); z-index:300;
            overflow:hidden;
        }
        .account-wrap:hover .dropdown-menu { display:block; }
        .dropdown-header {
            padding:.75rem 1rem;
            border-bottom:1px solid #e2e8f0;
            background:#f7fafc;
        }
        .dropdown-header .d-name { font-weight:600; font-size:.875rem; }
        .dropdown-header .d-role { font-size:.75rem; color:#718096; }
        .dropdown-menu a, .dropdown-menu button {
            display:flex; align-items:center; gap:.6rem;
            width:100%; text-align:left;
            padding:.65rem 1rem; font-size:.85rem;
            color:#1a202c; text-decoration:none;
            background:none; border:none; cursor:pointer;
            transition:background .12s;
        }
        .dropdown-menu a:hover, .dropdown-menu button:hover { background:#f7fafc; }
        .dropdown-divider { height:1px; background:#e2e8f0; }
        .dropdown-menu .logout-btn { color:#e53e3e; }

        /* ── Category strip ── */
        .cat-strip {
            background:#fff;
            border-bottom:1px solid #e2e8f0;
        }
        .cat-strip-inner {
            max-width:1280px; margin:0 auto;
            padding:.6rem 1.5rem;
            display:flex; align-items:center; gap:.5rem;
            overflow-x:auto;
        }
        .cat-strip-inner::-webkit-scrollbar { display:none; }
        .cat-pill {
            padding:.3rem .9rem; border-radius:999px;
            font-size:.8rem; font-weight:500;
            text-decoration:none; white-space:nowrap;
            border:1px solid #e2e8f0; color:#4a5568; background:#fff;
            transition:all .15s;
        }
        .cat-pill:hover { background:#1a202c; color:#fff; border-color:#1a202c; }
        .cat-pill.active { background:#1a202c; color:#fff; border-color:#1a202c; }

        /* ── Results info bar ── */
        .results-bar {
            max-width:1280px; margin:1rem auto .25rem;
            padding:0 1.5rem;
            display:flex; align-items:center; justify-content:space-between;
        }
        .results-bar .results-text { font-size:.85rem; color:#718096; }
        .results-bar .clear-link { font-size:.8rem; color:#3182ce; text-decoration:none; }
        .results-bar .clear-link:hover { text-decoration:underline; }

        /* ── Product grid ── */
        .product-grid {
            max-width:1280px; margin:0 auto;
            padding:0 1.5rem 2.5rem;
            display:grid;
            grid-template-columns:repeat(auto-fill, minmax(230px,1fr));
            gap:1.25rem;
            margin-top:.75rem;
        }

        /* ── Product card ── */
        .p-card {
            background:#fff; border-radius:10px;
            border:1px solid #e2e8f0; overflow:hidden;
            transition:box-shadow .2s, transform .2s;
            display:flex; flex-direction:column;
        }
        .p-card:hover { box-shadow:0 8px 28px rgba(0,0,0,.1); transform:translateY(-3px); }

        .p-img {
            width:100%; height:180px;
            background:#f7fafc;
            display:flex; align-items:center; justify-content:center;
            overflow:hidden;
        }
        .p-img img { width:100%; height:100%; object-fit:cover; }
        .p-img-placeholder {
            display:flex; flex-direction:column;
            align-items:center; gap:.3rem;
            color:#cbd5e0;
        }
        .p-img-placeholder svg { width:48px; height:48px; }
        .p-img-placeholder span { font-size:.72rem; }

        .p-body { padding:1rem; flex:1; display:flex; flex-direction:column; }
        .p-cats { display:flex; flex-wrap:wrap; gap:.3rem; margin-bottom:.5rem; }
        .p-cat {
            background:#ebf8ff; color:#2b6cb0;
            font-size:.68rem; font-weight:500;
            padding:.15rem .55rem; border-radius:999px;
        }
        .p-name {
            font-weight:600; font-size:.95rem;
            color:#1a202c; margin-bottom:.35rem;
            line-height:1.3;
        }
        .p-vendor { font-size:.75rem; color:#a0aec0; margin-bottom:.6rem; }
        .p-price {
            font-size:1.25rem; font-weight:800;
            color:#276749; margin-bottom:.75rem; margin-top:auto;
        }
        .p-footer {
            display:flex; align-items:center;
            justify-content:space-between; gap:.5rem;
        }
        .p-stock-ok { font-size:.75rem; color:#38a169; display:flex; align-items:center; gap:.3rem; }
        .p-stock-no { font-size:.75rem; color:#e53e3e; }
        .p-ver-btn {
            background:#1a202c; color:#fff;
            border:none; border-radius:6px;
            padding:.4rem .9rem; font-size:.82rem;
            font-weight:600; text-decoration:none;
            cursor:pointer; transition:background .15s;
            white-space:nowrap;
        }
        .p-ver-btn:hover { background:#2d3748; }

        /* ── Empty state ── */
        .empty-state {
            max-width:1280px; margin:3rem auto;
            padding:0 1.5rem; text-align:center;
        }
        .empty-state svg { width:80px; height:80px; color:#cbd5e0; margin-bottom:1rem; }
        .empty-state h3 { font-size:1.1rem; color:#4a5568; margin-bottom:.5rem; }
        .empty-state p { font-size:.875rem; color:#a0aec0; }

        /* ── Footer ── */
        footer {
            background:#1a202c; color:#718096;
            text-align:center; padding:1.25rem;
            font-size:.8rem; margin-top:2rem;
        }
        footer a { color:#a0aec0; text-decoration:none; }
        footer a:hover { color:#e2e8f0; }

        /* ── Responsive ── */
        @media(max-width:640px) {
            .account-name { display:none; }
            .search-form { max-width:none; }
        }
    </style>
    @stack('styles')
</head>
<body>

<header class="topbar">
    <div class="topbar-inner">

        <a href="{{ route('dashboard.cliente') }}" class="store-brand">
            Ven<span>die</span>
        </a>

        <form action="{{ route('dashboard.cliente') }}" method="GET" class="search-form">
            @if(request('categoria'))
                <input type="hidden" name="categoria" value="{{ request('categoria') }}">
            @endif
            <input type="text" name="buscar" class="search-input"
                   placeholder="Buscar productos, marcas y más..."
                   value="{{ request('buscar') }}" autocomplete="off">
            <button type="submit" class="search-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </form>

        <div class="topbar-actions">

            {{-- Mis pedidos --}}
            <a href="{{ route('ventas.index') }}" class="icon-btn" title="Mis pedidos">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                @php $misCompras = \App\Models\Venta::where('cliente_id', auth()->id())->count(); @endphp
                @if($misCompras > 0)
                    <span class="icon-badge">{{ $misCompras }}</span>
                @endif
            </a>

            {{-- Account --}}
            <div class="account-wrap">
                <button class="account-btn">
                    <div class="account-avatar">{{ strtoupper(substr(auth()->user()->nombre, 0, 1)) }}</div>
                    <span class="account-name">{{ auth()->user()->nombre }}</span>
                    <span class="account-caret">▼</span>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-header">
                        <p class="d-name">{{ auth()->user()->nombre }} {{ auth()->user()->apellidos }}</p>
                        <p class="d-role">{{ auth()->user()->correo }}</p>
                    </div>
                    <a href="{{ route('dashboard.cliente') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/></svg>
                        Mi panel
                    </a>
                    <a href="{{ route('ventas.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
                        Mis pedidos
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/><path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

@yield('content')

<footer>
    <p>&copy; {{ date('Y') }} {{ config('app.name') }} &mdash; Tu tienda en línea</p>
</footer>

@stack('scripts')
</body>
</html>
