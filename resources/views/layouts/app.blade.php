<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'ContactPro') }}</title>
    {{-- //logo icon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --cp-blue: #005f99;
            --cp-blue-rgb: 0, 95, 153;
            --cp-gray: #686c70;
            --cp-gray-rgb: 104, 108, 112;
        }

        [data-bs-theme="light"] {
            --bs-primary: var(--cp-blue);
            --bs-primary-rgb: var(--cp-blue-rgb);
            --bs-secondary: var(--cp-gray);
            --bs-secondary-rgb: var(--cp-gray-rgb);
            --bs-body-bg: #ffffff;
            --bs-body-color: #1c1f23;
            --bs-border-color: #d7dde3;
            --bs-link-color: var(--cp-blue);
            --bs-link-hover-color: #004876;
        }

        [data-bs-theme="dark"] {
            --bs-primary: #4aa6d7;
            --bs-primary-rgb: 74, 166, 215;
            --bs-secondary: #9aa2a7;
            --bs-secondary-rgb: 154, 162, 167;
            --bs-body-bg: #0b1116;
            --bs-body-color: #e7ecf2;
            --bs-border-color: #1d252f;
            --bs-link-color: #7cc2f2;
            --bs-link-hover-color: #b1dcf7;
        }

        body { min-height: 100vh; }
        .navbar-brand .brand-logo { height: 44px; width: auto; object-fit: contain; }

        .theme-toggle-fab {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 95, 153, 0.25);
            z-index: 1040;
        }

        .theme-toggle-fab svg {
            width: 22px;
            height: 22px;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column min-vh-100 bg-body text-body">
        <header class="sticky-top bg-body border-bottom shadow-sm">
            <div class="container py-3 d-flex align-items-center justify-content-between">
                <a href="{{ route('landing') }}" class="navbar-brand d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('images/logo.png') }}" alt="ContactPro logo" class="brand-logo me-2" loading="lazy">
                    <span class="fw-semibold">ContactPro</span>
                </a>
                <nav class="d-flex align-items-center gap-2">
                    @auth
                        <a class="btn btn-link text-decoration-none" href="{{ route('dashboard') }}">Dashboard</a>
                        <a class="btn btn-link text-decoration-none" href="{{ route('contacts.index') }}">Contacts</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-primary btn-sm">Logout</button>
                        </form>
                    @else
                        <a class="btn btn-link text-decoration-none" href="{{ route('login') }}">Log in</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">Create account</a>
                    @endauth
                </nav>
            </div>
        </header>

        @if (session('status'))
            <div class="alert alert-success rounded-0 mb-0">
                <div class="container">{{ session('status') }}</div>
            </div>
        @endif

        <main class="flex-grow-1">
            <div class="container py-5">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>

        <footer class="border-top bg-body py-4">
            <div class="container d-flex flex-wrap gap-2 justify-content-between text-secondary small">
                <span>Built for modern teams managing relationships.</span>
                <span>Youssef youyou · {{ now()->year }}</span>
            </div>
        </footer>
    </div>

    <button id="theme-toggle" type="button" class="btn btn-primary theme-toggle-fab" aria-label="Toggle theme">
        <span id="icon-sun" class="d-none" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 4a1 1 0 0 1 1-1h0.01a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H13a1 1 0 0 1-1-1V4Z"/>
                <path d="M12 18a1 1 0 0 1 1-1h0.01a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H13a1 1 0 0 1-1-1v-1Z"/>
                <path d="M6.343 6.343a1 1 0 0 1 1.414 0l.707.707A1 1 0 0 1 7.757 8.17l-.707-.707a1 1 0 0 1 0-1.414Z"/>
                <path d="M15.828 15.828a1 1 0 0 1 1.414 0l.707.707a1 1 0 0 1-1.414 1.414l-.707-.707a1 1 0 0 1 0-1.414Z"/>
                <path d="M4 11a1 1 0 0 1 1-1h1a1 1 0 1 1 0 2H5a1 1 0 0 1-1-1Z"/>
                <path d="M18 11a1 1 0 0 1 1-1h1a1 1 0 1 1 0 2h-1a1 1 0 0 1-1-1Z"/>
                <path d="M7.757 15.828a1 1 0 0 1 0 1.414l-.707.707a1 1 0 0 1-1.414-1.414l.707-.707a1 1 0 0 1 1.414 0Z"/>
                <path d="M17.243 6.343a1 1 0 0 1 0 1.414l-.707.707A1 1 0 0 1 15.122 7.05l.707-.707a1 1 0 0 1 1.414 0Z"/>
                <circle cx="12" cy="12" r="4"/>
            </svg>
        </span>
        <span id="icon-moon" class="d-none" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M21 12.79A9 9 0 0 1 11.21 3 7 7 0 1 0 21 12.79Z"/>
            </svg>
        </span>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const root = document.documentElement;
            const btn = () => document.getElementById('theme-toggle');
            const sun = () => document.getElementById('icon-sun');
            const moon = () => document.getElementById('icon-moon');
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const apply = (mode) => {
                root.setAttribute('data-bs-theme', mode);
                if (sun()) sun().classList.toggle('d-none', mode !== 'light');
                if (moon()) moon().classList.toggle('d-none', mode !== 'dark');
                if (btn()) btn().setAttribute('aria-label', mode === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
            };

            const initial = stored ?? (prefersDark ? 'dark' : 'light');
            apply(initial);

            const attach = () => {
                const button = btn();
                if (!button) return;
                button.onclick = () => {
                    const next = root.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                    apply(next);
                    localStorage.setItem('theme', next);
                };
            };

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', attach, { once: true });
            } else {
                attach();
            }
        })();
    </script>
</body>
</html>
