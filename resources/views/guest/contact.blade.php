@extends('layouts.guest')
@section('content')
<section class="pages-header contact" style="background-image: linear-gradient(-18deg, rgba(251, 208, 66, 0.4), rgba(252, 213, 86, 0.4) 80%), url({{asset('storage/paginas/contato/'.$dataPage['img_banner'])}});">
    <div class="pages-header-title">
        <h2>{{$dataPage['title_banner']}}</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-info">
        <h3>{{$dataPage['title_info']}}</h3>
        <p>
            {{$dataPage['subtitle_info']}}
        </p>
        <ul>
            {{-- @foreach ($contacts as $c) --}}
            
            @if ($getInfo->celular != NULL)
                <li>
                    <i class="fa fa-mobile-alt"></i>
                    <div class="text">
                        <p>Celular</p>
                        <p>{{$getInfo->celular}}</p>
                    </div>
                </li>
            @endif
            @if ($getInfo->telefone != NULL)
                <li>
                    <i class="fa fa-phone"></i>
                    <div class="text">
                        <p>Telefone</p>
                        <p>{{$getInfo->telefone}}</p>
                    </div>
                </li>
            @endif
            @if ($getInfo->email != NULL)
                <li>
                    <i class="far fa-envelope"></i>
                    <div class="text">
                        <p>E-mail</p>
                        <p>{{$getInfo->email}}</p>
                    </div>
                </li>
            @endif
            
            {{-- @endforeach --}}
        </ul>
    </div>
    <div class="pages-content-form">
        <h4>{{$dataPage['title_form']}}</h4>
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
