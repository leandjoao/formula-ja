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
    @include('components.g-tag')

    <title>Dashboard :: {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @yield('extraCSS')
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
                            <li @if(request()->routeIs('faq'))class="active"@endif><a href="{{route('faq')}}"><i class="fas fa-question-circle"></i> Dúvidas</a></li>
                        @endif
                        <li @if(request()->routeIs('budgets'))class="active"@endif><a href="{{route('budgets')}}"><i class="fa fa-dollar-sign"></i> Pedidos</a></li>
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
                <div class="nav-navbar-list-item">
                    <p>Depoimentos</p>
                    <ul>
                        <li @if(request()->routeIs('testemonials'))class="active"@endif><a href="{{route('testemonials')}}"><i class="fa fa-comment-dots"></i> Depoimentos</a></li>
                    </ul>
                </div>
                <div class="nav-navbar-list-item">
                    <p>Textos e Imagens</p>
                    <ul>
                        <li @if(request()->routeIs('texts.home'))class="active"@endif><a href="{{route('texts.home')}}"><i class="fa fa-spell-check"></i> Home</a></li>
                        <li @if(request()->routeIs('texts.infos'))class="active"@endif><a href="{{route('texts.infos')}}"><i class="fa fa-spell-check"></i> Outros Textos</a></li>
                        <li @if(request()->routeIs('texts.policy'))class="active"@endif><a href="{{route('texts.policy')}}"><i class="fa fa-spell-check"></i> Politicas de Privacidade</a></li>
                        <li @if(request()->routeIs('texts.terms'))class="active"@endif><a href="{{route('texts.terms')}}"><i class="fa fa-spell-check"></i> Termos de Uso</a></li>
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
                        @if(Auth::user()->access_level == 2)
                            <a class="btn btn-formulaja" href="{{route('guest.receita')}}">Envie sua receita</a>
                        @endif
                        <img src="@if(empty(Auth::user()->avatar)) {{asset('storage/icons/user.png')}} @else {{asset('storage/avatar/' . Auth::user()->avatar)}} @endif" alt="Foto de {{Auth::user()->name}}">
                        <p>
                            <span>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i></span>
                            <small>{{Auth::user()->access->label}}</small>
                        </p>
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('profile') }}"><i class="fa fa-user"></i> Perfil</a>
                        @if(Auth::user()->access_level == 3)
                            <a href="{{ route('profile.partner') }}"><i class="fa fa-user"></i> Perfil Parceiro</a>
                        @endif
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
            showCloseButton: true,
            position: 'top'
        })
    </script>
    @endif
    @if(session()->get('payment'))
    <script type="text/javascript">
        Swal.fire({
            text: "{{ session()->get('payment.text')}}",
            icon: "{{ session()->get('payment.icon')}}",
            @if(!session()->get('payment.success'))
                text: "{{ session()->get('payment.message') }}",
            @endif
            didClose: function() {
                if("{{session()->get('payment.success')}}") {
                    window.location = "{{route('budgets')}}";
                }
            }
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
