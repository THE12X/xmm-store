<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XMM - X Mobile Market</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.ico') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Dark Theme (Jet Black & Acid Lime) */
        :root[data-theme="dark"] {
            --bg-body: #0a0a0a;
            --bg-card: #141414;
            --bg-input: #0a0a0a;
            --text-main: #f1f5f9;
            --text-muted: #94a3b8;
            --accent: #ccff00;
            --accent-hover: #b3e600;
            --accent-text: #0a0a0a;
            --danger: #ef4444;
            --success: #22c55e;
            --border: #262626;
        }

        /* Light Theme (Cloud Grey & Acid Lime Accent) */
        :root[data-theme="light"] {
            --bg-body: #e2e8f0;
            --bg-card: #ffffff;
            --bg-input: #f8fafc;
            --text-main: #0a0a0a;
            --text-muted: #475569;
            --accent: #a3e635;
            --accent-hover: #84cc16;
            --accent-text: #0a0a0a;
            --danger: #dc2626;
            --success: #16a34a;
            --border: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Layout */
        .navbar {
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .brand-logo {
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .brand-logo img {
            height: 56px;
            width: auto;
            object-fit: contain;
        }

        [data-theme="dark"] .logo-light { display: none; }
        [data-theme="dark"] .logo-dark { display: block; }

        [data-theme="light"] .logo-dark { display: none; }
        [data-theme="light"] .logo-light { display: block; }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-primary { background: var(--accent); color: var(--accent-text); }
        .btn-primary:hover { background: var(--accent-hover); }

        .btn-outline { background: transparent; color: var(--text-main); border: 1px solid var(--border); }
        .btn-outline:hover { background: var(--border); }

        .btn-danger { background: rgba(239, 68, 68, 0.15); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.3); }
        .btn-danger:hover { background: var(--danger); color: white; }

        .theme-toggle-btn {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-main);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
            flex: 1;
        }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-main);
            font-size: 0.95rem;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--accent);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-success { background: rgba(34, 197, 94, 0.15); color: var(--success); border: 1px solid rgba(34, 197, 94, 0.3); }
        .alert-danger { background: rgba(239, 68, 68, 0.15); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.3); }

        .badge-admin {
            background: rgba(204, 255, 0, 0.15);
            color: var(--accent);
            border: 1px solid var(--accent);
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* Mobile Breakpoint (Side-by-Side Nav) */
        @media (max-width: 640px) {
            .navbar {
                padding: 0.75rem 1rem;
                flex-wrap: nowrap;
                justify-content: space-between;
            }

            .brand-logo img {
                height: 44px;
            }

            .nav-links {
                width: auto;
                margin-top: 0;
                gap: 6px;
            }

            .btn, .theme-toggle-btn {
                padding: 6px 10px;
                font-size: 0.78rem;
            }

            .user-name-text {
                display: none;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ route('products.index') }}" class="brand-logo">
            <img src="{{ asset('logo-dark.png') }}" alt="XMM Logo" class="logo-dark">
            <img src="{{ asset('logo-light.png') }}" alt="XMM Logo" class="logo-light">
        </a>
        
        <div class="nav-links">
            <button id="theme-toggle" class="theme-toggle-btn">☀️</button>

            <a href="{{ route('products.index') }}" class="btn btn-outline">Catalog</a>

            @auth
                @if(auth()->user()->role === 1)
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add</a>
                @endif

                <span style="font-size: 0.85rem; color: var(--text-muted);">
                    <span class="user-name-text">{{ auth()->user()->name }}</span>
                    @if(auth()->user()->role === 1)
                        <span class="badge-admin">ADMIN</span>
                    @endif
                </span>

                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script>
        const toggleBtn = document.getElementById('theme-toggle');
        const savedTheme = localStorage.getItem('theme') || 'dark';

        document.documentElement.setAttribute('data-theme', savedTheme);
        updateButton(savedTheme);

        toggleBtn.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateButton(newTheme);
        });

        function updateButton(theme) {
            toggleBtn.textContent = theme === 'dark' ? '☀️' : '🌙';
        }
    </script>
</body>
</html>