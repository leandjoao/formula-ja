@extends('layouts.guest')
@section('content')
<section class="pages-header contact">
    <div class="pages-header-title">
        <h2>Contato</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-info">
        <h3>Informações de Contato</h3>
        <p>
            Entre em contato conosco para tirar qualquer dúvida, será um prazer em lhe atender.
        </p>
        <ul>
            @foreach ($contacts as $c)
            <li>
                <i class="{{$c['type']}}"></i>
                <div class="text">
                    <p>{{$c['label']}}</p>
                    <p>{{$c['value']}}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="pages-content-form">
        <h4>Como podemos ajudar você?</h4>
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
                <textarea class="@error('message') invalid @endif" name="message" id="message" rows="6" placeholder="Mensagem"></textarea>
                @error('message') <label for="message">{{$message}}</label> @enderror
            </div>
            <div class="form-input">
                <button type="submit">Enviar!</button>
            </div>
        </form>
    </div>
</section>
@endsection
