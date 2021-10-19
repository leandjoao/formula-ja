<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('storage/icon.png')}}">
    <link rel="apple-touch-icon" href="{{asset('storage/icon.png')}}">
    <link rel="image_src" href="{{asset('storage/icon.png')}}">

    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
    <div class="auth">
        <div class="auth-container">
            <div class="auth-container-box">
                <div class="auth-container-box-header">
                    <a href="{{ route('guest.index') }}">
                        <img src="{{asset('storage/formula-ja.png')}}" alt="">
                    </a>
                    @if(!empty($text))
                        <p>{{$text}}</p>
                    @endif
                </div>
                <div class="auth-container-box-form">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-copy">
            <div class="footer-copy-container">
                <p>CNPJ: {{config('app.cnpj')}}</p>
                <p>Copyright &copy; {{date('Y')}}. Todos os direitos reservados. {{config('app.name')}}</p>
            </div>
        </div>
    </footer>
    <script src="{{asset('js/app.js')}}"></script>
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
</body>
</html>
