<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toy Store - Matrix Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            /* 🟢 Green Matrix Theme */
            --primary: #00ff88;
            --secondary: #00cc6a;
            --bg: #010d06;
            --card: rgba(0, 20, 10, 0.75);
            --text: #e8fff2;
            --text-secondary: #c8f5dc;
            --muted: #6bab86;
            --border: rgba(0, 255, 136, 0.1);
            --btn-bg: transparent;
            --btn-text: #00ff88;

            /* Override Bootstrap defaults */
            --bs-primary: var(--primary);
            --bs-primary-rgb: 0, 255, 136;
            --bs-body-bg: var(--bg);
            --bs-body-color: var(--text);
            --bs-card-bg: var(--card);
            --bs-border-color: var(--border);
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            position: relative;
            min-height: 100vh;
            /* Subtle scanline effect */
            background-image: repeating-linear-gradient(
                0deg,
                transparent,
                transparent 2px,
                rgba(0,255,136,0.012) 2px,
                rgba(0,255,136,0.012) 4px
            );
        }

        /* Green neon vignette frame */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            box-shadow: inset 0 0 150px rgba(0, 255, 136, 0.06);
            pointer-events: none;
            z-index: 9999;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text);
        }

        .navbar {
            background-color: rgba(1, 13, 6, 0.88) !important;
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(0, 255, 136, 0.15);
        }

        .navbar-brand {
            color: var(--primary) !important;
            font-weight: 700;
            text-shadow: 0 0 12px rgba(0,255,136,0.5);
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            color: var(--text-secondary) !important;
            transition: color 0.3s, text-shadow 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            text-shadow: 0 0 10px rgba(0, 255, 136, 0.7);
        }

        /* Buttons */
        .btn-primary {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 4px;
            text-transform: uppercase;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.15);
        }
        .btn-primary:hover {
            background-color: var(--primary);
            color: var(--bg);
            box-shadow: 0 0 25px rgba(0, 255, 136, 0.5);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            font-family: 'Orbitron', sans-serif;
            border-radius: 4px;
        }
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: var(--bg);
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.5);
        }

        .btn-success {
            background-color: transparent;
            border: 1px solid #00ff88;
            color: #00ff88;
            font-family: 'Orbitron', sans-serif;
            box-shadow: 0 0 10px rgba(0, 255, 136, 0.15);
            text-transform: uppercase;
        }
        .btn-success:hover {
            background-color: #00ff88;
            color: #010d06;
            box-shadow: 0 0 25px rgba(0, 255, 136, 0.5);
        }

        /* Glassmorphism Cards */
        .card {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(0, 255, 136, 0.35);
            box-shadow: 0 10px 35px rgba(0, 255, 136, 0.1);
        }
        .card-img-top {
            border-bottom: 1px solid var(--border);
            filter: grayscale(20%) contrast(110%);
        }
        .card:hover .card-img-top {
            filter: grayscale(0%) contrast(115%);
        }

        .text-muted { color: var(--muted) !important; }

        .text-primary {
            color: var(--primary) !important;
            text-shadow: 0 0 10px rgba(0, 255, 136, 0.4);
        }

        /* Form elements */
        .form-control, .form-select {
            background-color: rgba(0, 20, 10, 0.85) !important;
            border: 1px solid rgba(0,255,136,0.15);
            color: var(--text) !important;
            border-radius: 6px;
        }
        .form-control:focus, .form-select:focus {
            background-color: rgba(0, 20, 10, 1) !important;
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 255, 136, 0.18);
        }

        .input-group-text {
            background-color: rgba(0,255,136,0.05);
            border-color: rgba(0,255,136,0.15);
            color: var(--text-secondary);
        }

        table {
            color: var(--text-secondary) !important;
            border-color: var(--border) !important;
        }
        th {
            background-color: rgba(0,255,136,0.03) !important;
            color: var(--primary) !important;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(0, 255, 136, 0.25) !important;
        }
        td {
            background-color: transparent !important;
            border-color: var(--border) !important;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: rgba(0,255,136,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(0,255,136,0.6); }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing') }}">
                <span style="display:inline-block; width:10px; height:10px; border-radius:50%; background:var(--primary); box-shadow: 0 0 12px var(--primary), 0 0 24px rgba(0,255,136,0.4);"></span>
                TOY_STORE_OS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1) sepia(1) saturate(5) hue-rotate(100deg);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">SHOP</a></li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-1" href="{{ route('games.index') }}">
                            <span style="color:#00ff88; text-shadow: 0 0 8px rgba(0,255,136,0.8);">&#9679;</span>
                            GAMES_HUB
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">ADMIN_DASHBOARD</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}">CART_TERMINAL</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">MY_ORDERS</a></li>
                        @endif
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-primary px-3">LOGOUT</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">LOGIN</a></li>
                        <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-sm btn-outline-primary px-3" href="{{ route('register') }}">REGISTER</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main class="container mb-5" style="margin-top: 100px;">
        @if(session('success'))
            <div class="alert shadow-sm border-0" style="background-color: rgba(0,255,136,0.08); color: #00ff88; border-left: 4px solid #00ff88 !important;">
                <strong style="font-family:'Orbitron', sans-serif; letter-spacing:1px;">SUCCESS_SYS_MSG:</strong> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert shadow-sm border-0" style="background-color: rgba(239, 68, 68, 0.1); color: #ef4444; border-left: 4px solid #ef4444 !important;">
                <strong style="font-family:'Orbitron', sans-serif; letter-spacing:1px;">ERROR_SYS_MSG:</strong> {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>