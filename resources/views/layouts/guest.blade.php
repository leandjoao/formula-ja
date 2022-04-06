<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/favicon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('storage/favicon.png')}}">
    <link rel="image_src" href="{{asset('storage/favicon.png')}}">
    @if(config('app.env') === "production")
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/lgpd.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @include('components.g-tag')
</head>

<body @if(request()->routeIs('guest.pet') || request()->routeIs('guest.receita.pet')) class="is-pet" @endif id="structure-html">
    <div class="super">
        <div class="super-container">
            @if(!empty($sm))
                <ul class="super-container-social">
                    @foreach($sm as $media)
                        <li><a href="{{$media['link']}}"><i class="{{$media['media']}}"></i></a></li>
                    @endforeach
                </ul>
            @endif
            <ul class="super-container-links">
                <li><a href="{{route('guest.faq')}}">FAQ</a></li>
                <li><a href="{{route('guest.privacidade')}}">Políticas de Privacidade</a></li>
            </ul>
        </div>
    </div>
    <nav class="nav">
        <div class="nav-navbar">
            <div class="nav-navbar-logo">
                <a href="{{route('guest.index')}}">
                    <img src="{{ asset('storage/formula-ja.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>
            <div class="nav-navbar-links">
                <a href="{{route('guest.faq')}}" class="nav-navbar-links-link">Dúvidas</a>
                <a href="{{ route('guest.pet') }}" class="nav-navbar-links-link @if (request()->routeIs('guest.pet')) active @endif">PET</a>
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
                        <img src="@if(empty(Auth::user()->avatar)) {{asset('storage/icons/user.png')}} @else {{asset('storage/avatar/' . Auth::user()->avatar)}} @endif" alt="Foto de {{Auth::user()->name}}">
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
    @if(!empty($cta))
    <div class="cta-send">
        <div class="cta-send-container">
            <p>{{$cta}}</p>
        <a href="{{route('guest.receita')}}">Envie sua receita</a>
        </div>
    </div>
    @endif
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
                        <li><a href="{{route('guest.about')}}">A Formulajá</a></li>
                        <li><a href="{{route('guest.blog')}}">Blog</a></li>
                        <li><a href="{{route('guest.pet')}}">PET</a></li>
                        <li><a href="{{route('guest.contact')}}">Contato</a></li>
                        <li><a href="mailto:ouvidoria@formulaja.com.br">Ouvidoria</a></li>
                    </ul>
                </div>
                <div class="block">
                    <div class="block-header">
                        <h2>Informações</h2>
                    </div>
                    <ul class="block-links">
                        <li><a href="{{route('guest.faq')}}">Dúvidas</a></li>
                        {{-- <li><a href="{{ url('seja-um-parceiro', []) }}">Seja um parceiro</a></li> --}}
                        <li><a href="{{route('guest.parceiro')}}">Seja um Parceiro</a></li>
                        <li><a href="{{route('guest.termos')}}">Termos de Uso</a></li>
                        <li><a href="{{route('guest.privacidade')}}">Política de Privacidade</a></li>
                        <li><a href="{{route('guest.receita')}}">Envie sua Receita</a></li>
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
                            Seus dados estão seguros conosco, não fazemos spam e muito menos compartilhamos ou vendemos dados pessoais.
                        </p>
                        @if (!empty($sm))
                        <ul>
                            @foreach($sm as $media)
                                <li><a href="{{$media['link']}}"><i class="{{$media['media']}}"></i></a></li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="footer-copy-container">
                <p>CNPJ: {{config('app.cnpj')}}</p>
                <p>Copyright &copy; {{date('Y')}}. Todos os direitos reservados. {{config('app.name')}}</p>
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
    <script src="{{ asset('js/lgpd.js') }}"></script>
    <script src="//code-eu1.jivosite.com/widget/kuqi5ZCYFS" async></script>
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
