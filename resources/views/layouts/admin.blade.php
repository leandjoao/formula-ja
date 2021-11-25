<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/icon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('storage/icon.png')}}">
    <link rel="image_src" href="{{asset('storage/icon.png')}}">
    @if(config('app.env') === "production")
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif

    <title>Dashboard :: {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <nav class="nav">
        <div class="nav-navbar">
            <div class="nav-navbar-logo">
                <a href="{{route('guest.index')}}">
                    <img src="{{asset('storage/formula-ja-white.png')}}" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="nav-navbar-list">
                <div class="nav-navbar-list-item">
                    <p>Administrativo</p>
                    <ul>
                        @if(Auth::user()->access_level == 1 || Auth::user()->access_level == 3)
                            <li @if(request()->routeIs('dashboard'))class="active"@endif><a href="{{route('dashboard')}}"><i class="fa fa-tools"></i> Dashboard</a></li>
                        @endif
                        @if(Auth::user()->access_level == 1)
                            <li @if(request()->routeIs('users'))class="active"@endif><a href="{{route('users')}}"><i class="far fa-user"></i> Usuários</a></li>
                            <li @if(request()->routeIs('partners'))class="active"@endif><a href="{{route('partners')}}"><i class="far fa-handshake"></i> Parceiros</a></li>
                            <li @if(request()->routeIs('contact'))class="active"@endif><a href="{{route('contact')}}"><i class="fa fa-mail-bulk"></i> Contatos</a></li>
                            {{-- <li><a href=""><i class="fa fa-spell-check"></i> Textos</a></li> --}}
                            {{-- <li><a href=""><i class="far fa-comments"></i> Depoimentos</a></li> --}}
                            {{-- <li><a href=""><i class="fa fa-cogs"></i> Configurações</a></li> --}}
                        @endif
                        <li @if(request()->routeIs('budgets'))class="active"@endif><a href="{{route('budgets')}}"><i class="fa fa-dollar-sign"></i> Orçamentos</a></li>
                    </ul>
                </div>

                @if(Auth::user()->access_level == 1)
                <div class="nav-navbar-list-item">
                    <p>Blog</p>
                    <ul>
                        <li @if(request()->routeIs('blog'))class="active"@endif><a href="{{route('blog')}}"><i class="fa fa-blog"></i> Posts</a></li>
                        <li @if(request()->routeIs('blog.category'))class="active"@endif><a href="{{ route('blog.category')}}"><i class="fa fa-th-large"></i> Categorias</a></li>
                    </ul>
                </div>
                @endif

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
                        <img src="@if(empty(Auth::user()->avatar)) {{asset('storage/icons/user.png')}} @else {{asset('storage/avatar/' . Auth::user()->avatar)}} @endif" alt="Foto de {{Auth::user()->name}}">
                        <p>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></p>

                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('profile') }}"><i class="fa fa-user"></i> Perfil</a>
                        <a onclick="document.querySelector('#logout').submit();"><i class="fa fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
    </section>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    @yield('extraJS')
    @if(session()->get('status'))
    <script type="text/javascript">
        Swal.fire({
            text: "{{ session()->get('status.text')}}",
            icon: "{{ session()->get('status.icon')}}",
            toast: true,
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            position: 'bottom-end'
        })
    </script>
    @endif
    @if(session()->get('errors'))
    <script type="text/javascript">
        Swal.fire({
            html: "<ul>"+
                    @foreach (session()->get('errors') as $key => $value)
                    @foreach ($value as $erro)
                        "<li>{{ ucfirst($erro) }}</li>"+
                    @endforeach
                    @endforeach
                   "</ul>",
            icon: "{{ session()->get('icon')}}",
            position: 'top-center'
        })
    </script>
    @endif
    <form id="logout" action="{{route('logout')}}" method="POST">
        @csrf
    </form>
</body>
</html>
