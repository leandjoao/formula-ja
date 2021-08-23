<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/icon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('storage/icon.png')}}">
    <link rel="image_src" href="{{asset('storage/icon.png')}}">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body @if(request()->routeIs('guest.pet') || request()->routeIs('guest.receita.pet')) class="is-pet" @endif>
    <nav class="nav">
        <div class="nav-navbar">
            <div class="nav-navbar-logo">
                <a href="{{route('guest.index')}}">
                    <img src="{{ asset('storage/formula-ja.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="nav-navbar-links">
                <a href="{{ route('guest.index') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.index')) active @endif">Página Inicial</a>
                <a href="{{ route('guest.about') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.about')) active @endif">A Formula Já</a>
                <a href="{{ route('guest.pet') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.pet')) active @endif">PET</a>
                <a href="{{ route('guest.blog') }}" class="nav-navbar-links-link @if (request()->is('blog*')) active @endif">Blog</a>
                <a href="{{ route('guest.contact') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.contact')) active @endif">Contato</a>
                @guest
                    <a href="{{ route('login') }}" class="nav-navbar-links-link">Fazer Login</a>
                @endguest
                @if(request()->routeIs('guest.pet') || request()->routeIs('guest.receita.pet'))
                    <a href="{{ route('guest.receita.pet') }}" class="nav-navbar-links-link"><span>Envie sua Receita <i class="fa fa-plus"></i></span></a>
                @else
                    <a href="{{ route('guest.receita') }}" class="nav-navbar-links-link"><span>Envie sua Receita <i class="fa fa-plus"></i></span></a>
                @endif
                @auth
                <div class="dropdown">
                    <div class="nav-navbar-links-link dropdown-button">
                        <img src="{{ asset('storage/icons/user.png') }}" alt="">
                        <p>{{ Str::limit(Auth::user()->name, 6, '...') }} <i class="fa fa-caret-down"></i></p>
                    </div>
                    <div class="dropdown-content">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-cogs"></i> Dashboard</a>
                        <a href="{{ route('profile') }}"><i class="fa fa-user"></i> Perfil</a>
                        <a onclick="document.querySelector('#logout').submit();"><i class="fa fa-sign-out-alt"></i> Sair</a>
                    </div>
                </div>
                @endauth
            </div>
            <a href="{{ route('guest.receita') }}" class="nav-navbar-cta">Envie sua Receita <i class="fa fa-plus"></i></a>
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
    <span class="to-top">
        <i class="fas fa-long-arrow-alt-up"></i>
    </span>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-container-block">
                <div class="block">
                    <div class="block-header">
                        <h2>Acesso Rápido</h2>
                    </div>
                    <ul class="block-links">
                        <li><a href="{{route('guest.index')}}">Página Inicial</a></li>
                        <li><a href="{{route('guest.about')}}">A Formula Já</a></li>
                        <li><a href="{{route('guest.blog')}}">Blog</a></li>
                        <li><a href="{{route('guest.contact')}}">Contato</a></li>
                    </ul>
                </div>
                <div class="block">
                    <div class="block-header">
                        <h2>Informações</h2>
                    </div>
                    <ul class="block-links">
                        <li><a href="{{route('guest.termos')}}">Termos de Uso</a></li>
                        <li><a href="{{route('guest.privacidade')}}">Política de Privacidade</a></li>
                        <li><a href="{{route('guest.receita')}}">Envie sua Receita</a></li>
                        <li><a href="{{route('guest.pet')}}">PET</a></li>
                    </ul>
                </div>

                <div class="block">
                    <div class="block-header">
                        <img src="{{asset('storage/formula-ja-white.png')}}" alt="{{config('app.name')}}">
                    </div>
                    <div class="block-newsletter">
                        <form action="{{ route('send.newsletter') }}" method="POST" class="newsletter">
                            @csrf
                            <div class="newsletter-input">
                                <input type="text" name="newsletter" id="newsletter-email" placeholder="Seu e-mail">
                                <button type="submit">Enviar <i class="far fa-paper-plane"></i></button>
                            </div>
                        </form>
                        @error('newsletter')<small>{{ $message }}</small>@enderror
                        <p>
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="footer-copy-container">
                <p>CNPJ: {{config('app.cnpj')}}</p>
                <p>Copyright &copy; {{date('Y')}}. Todos os direitos reservados. {{config('app.name')}}</p>
                <ul>
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                    <li><a href=""><i class="fab fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <div class="modal hidden">
        <div class="modal-box">
            <button class="modal-box-close" onclick="toggleModal()">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-box-container">
                @yield('modal')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
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
    @auth
        <form id="logout" action="{{route('logout')}}" method="POST">
            @csrf
        </form>
    @endauth
</body>
</html>
