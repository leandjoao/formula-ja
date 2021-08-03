<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/icon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('storage/icon.png')}}">
    <link rel="image_src" href="{{asset('storage/icon.png')}}">

    <title>Dashboard :: {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <nav class="nav">
        <div class="nav-navbar">
            <div class="nav-navbar-logo">
                <img src="{{asset('storage/formula-ja-white.png')}}" alt="{{ config('app.name') }}">
            </div>
            <div class="nav-navbar-list">
                <div class="nav-navbar-list-item">
                    <p>Administrativo</p>
                    <ul>
                        <li class="active"><a href=""><i class="fa fa-tools"></i> Dashboard</a></li>
                        <li><a href=""><i class="far fa-user"></i> Usuários</a></li>
                        <li><a href=""><i class="fa fa-spell-check"></i> Textos</a></li>
                        <li><a href=""><i class="far fa-comments"></i> Depoimentos</a></li>
                        <li><a href=""><i class="far fa-handshake"></i> Parceiros</a></li>
                        <li><a href=""><i class="fa fa-mail-bulk"></i> Contatos</a></li>
                        <li><a href=""><i class="fa fa-dollar-sign"></i> Orçamentos</a></li>
                        <li><a href=""><i class="fa fa-cogs"></i> Configurações</a></li>
                    </ul>
                </div>

                <div class="nav-navbar-list-item">
                    <p>Blog</p>
                    <ul>
                        <li><a href=""><i class="fa fa-blog"></i> Posts</a></li>
                        <li><a href=""><i class="fa fa-th-large"></i> Categorias</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <section class="page">
        <div class="page-header">
            <div class="page-header-toggle">
                <i class="fa fa-bars"></i>
            </div>
            <div class="page-header-group">
                <div class="page-header-group-dropdown dropdown">
                    <div class="dropdown-button">
                        <img src="{{asset('storage/icons/user.png')}}" alt="{{ Auth::user()->name }}">
                        <p>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></p>

                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-user"></i> Perfil</a>
                        <a onclick="document.querySelector('#logout').submit();"><i class="fa fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
    </section>
    <form id="logout" action="{{route('logout')}}" method="POST">
        @csrf
    </form>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
