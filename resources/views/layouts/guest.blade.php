<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <nav class="nav">
        <div class="nav-navbar">
            <div class="nav-navbar-logo">
                <img src="{{ asset('storage/formula-ja.png') }}" alt="{{ config('app.name') }}">
                <p>{{ config('app.name') }}</p>
            </div>
            <div class="nav-navbar-links">
                <a href="{{ route('guest.index') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.index')) active @endif">Home</a>
                <a href="{{ route('guest.index') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.about')) active @endif">Sobre nós</a>
                <a href="{{ route('guest.index') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.blog')) active @endif">Blog</a>
                <a href="{{ route('guest.index') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.contact')) active @endif">Contato</a>
            </div>
            <div class="nav-navbar-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
</body>

</html>
