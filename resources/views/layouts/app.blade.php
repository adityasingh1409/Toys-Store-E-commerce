<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toy Store - Cyberpunk Edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Sci-Fi / Cyberpunk Portfolio Theme Colors */
            --primary: #00d2ff;
            --secondary: #00a8ff;
            --bg: #030712;
            --card: rgba(15, 23, 42, 0.65);
            --text: #ffffff;
            --text-secondary: #e5e7eb;
            --muted: #9ca3af;
            --border: rgba(255, 255, 255, 0.08);
            --btn-bg: transparent;
            --btn-text: #00d2ff;
            
            /* Override Bootstrap defaults for true Dark Mode */
            --bs-primary: var(--primary);
            --bs-primary-rgb: 0, 210, 255;
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
        }

        /* Subtle neon vignette frame effect */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            box-shadow: inset 0 0 120px rgba(0, 210, 255, 0.08);
            pointer-events: none;
            z-index: -1;
        }
        
        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text);
        }

        .navbar {
            background-color: rgba(3, 7, 18, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }

        .navbar-brand {
            color: var(--text) !important;
            font-weight: 700;
        }

        .nav-link {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            color: var(--text-secondary) !important;
            transition: color 0.3s, text-shadow 0.3s;
        }

        .nav-link:hover {
            color: var(--primary) !important;
            text-shadow: 0 0 8px rgba(0, 210, 255, 0.6);
        }
        
        /* Modern sci-fi buttons */
        .btn-primary {
            background-color: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            border-radius: 4px;
            text-transform: uppercase;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px rgba(0, 210, 255, 0.1);
        }
        
        .btn-primary:hover {
            background-color: var(--primary);
            color: var(--bg);
            box-shadow: 0 0 20px rgba(0, 210, 255, 0.4);
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
            box-shadow: 0 0 15px rgba(0, 210, 255, 0.5);
        }

        .btn-success {
            background-color: transparent;
            border: 1px solid #10b981;
            color: #10b981;
            font-family: 'Orbitron', sans-serif;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.1);
            text-transform: uppercase;
        }
        .btn-success:hover {
            background-color: #10b981;
            color: #000;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.4);
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
            border-color: rgba(0, 210, 255, 0.3);
            box-shadow: 0 10px 30px rgba(0, 210, 255, 0.08);
        }

        .card-img-top {
            border-bottom: 1px solid var(--border);
            filter: grayscale(20%) contrast(110%);
        }

        .card:hover .card-img-top {
            filter: grayscale(0%) contrast(120%);
        }
        
        .text-muted {
            color: var(--muted) !important;
        }
        
        .text-primary {
            color: var(--primary) !important;
            text-shadow: 0 0 10px rgba(0, 210, 255, 0.3);
        }

        /* Form elements */
        .form-control, .form-select {
            background-color: rgba(15, 23, 42, 0.8) !important;
            border: 1px solid var(--border);
            color: var(--text) !important;
            border-radius: 6px;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: rgba(15, 23, 42, 1) !important;
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 210, 255, 0.15);
        }

        .input-group-text {
            background-color: rgba(255,255,255,0.05);
            border-color: var(--border);
            color: var(--text-secondary);
        }

        table {
            color: var(--text-secondary) !important;
            border-color: var(--border) !important;
        }
        
        th {
            background-color: rgba(255,255,255,0.02) !important;
            color: var(--text) !important;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            border-bottom: 2px solid rgba(0, 210, 255, 0.2) !important;
        }
        
        td {
            background-color: transparent !important;
            border-color: var(--border) !important;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <span style="display:inline-block; width:12px; height:12px; border-radius:50%; background:var(--primary); box-shadow: 0 0 10px var(--primary);"></span>
                TOY_STORE_OS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
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
            <div class="alert shadow-sm border-0" style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border-left: 4px solid #10b981 !important;">
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