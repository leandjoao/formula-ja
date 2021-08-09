@extends('layouts.guest')
@section('content')
<section class="pages-header contact">
    <div class="pages-header-title">
        <h2>Contato</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-info">
        <ul class="block">
            <li class="block-item"><a href="mailto:{{config('app.contact')}}"><i class="far fa-envelope"></i> {{config('app.contact')}}</a></li>
            <li class="block-item"><a target="_blank" href="https://wa.me/5515000000000"><i class="fab fa-whatsapp"></i> +55 (15) 0 0000-0000</a></li>
            <li class="block-item"><a href=""><i class="fa fa-map-marker-alt"></i> Endereço</a></li>
        </ul>
    </div>
    <div class="pages-content-form">
        <h2>Como podemos ajudar você?</h2>
        <p>Preencha o formulário abaixo e em breve entraremos em contato</p>
        <form action="{{ route('send.contact') }}" method="POST" class="form">
            @csrf
            <div class="form-input">
                <input class="@error('name') invalid @endif" type="text" name="name" id="name" placeholder="Nome" required />
                @error('name') <label for="name">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <input class="@error('email') invalid @endif" type="email" name="email" id="email" placeholder="E-mail" required />
                @error('email') <label for="email">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <input class="@error('phone') invalid @endif" type="text" name="phone" id="phone" placeholder="Telefone" required />
                @error('phone') <label for="phone">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <input class="@error('subject') invalid @endif" type="text" name="subject" id="subject" placeholder="Assunto" required />
                @error('subject') <label for="subject">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <textarea class="@error('message') invalid @endif" name="message" id="message" rows="10" placeholder="Mensagem"></textarea>
                @error('message') <label for="message">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <button type="submit">Enviar!</button>
            </div>
        </form>
    </div>
</section>
@endsection
