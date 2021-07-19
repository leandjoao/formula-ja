@extends('layouts.guest')
@section('content')
<section class="pages-header">
    <div class="pages-header-title">
        <h2>Contato</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-info">
        <ul class="block">
            <li class="block-item"><a href="mailto:{{config('app.contact')}}"><i class="far fa-envelope"></i> {{config('app.contact')}}</a></li>
            <li class="block-item"><a href="https://wa.me/5515000000000"><i class="fab fa-whatsapp"></i> +55 (15) 0 0000-0000</a></li>
            <li class="block-item"><a href=""><i class="fa fa-map-marker-alt"></i> Endereço</a></li>
        </ul>
    </div>
    <div class="pages-content-form">
        <h2>Fale conosco!</h2>
        <p>Preencha o formulário abaixo e em breve entraremos em contato</p>
        <form action="" class="form">
            <div class="form-input">
                <input type="text" name="name" id="name" placeholder="Nome" />
                <label for="name"></label>
            </div>
            <div class="form-input">
                <input type="email" name="email" id="email" placeholder="E-mail" />
                <label for="email"></label>
            </div>
            <div class="form-input">
                <input type="text" name="phone" id="phone" placeholder="Telefone" />
                <label for="phone"></label>
            </div>
            <div class="form-input">
                <input type="text" name="subject" id="subject" placeholder="Assunto" />
                <label for="subject"></label>
            </div>
            <div class="form-input">
                <textarea name="message" id="message" rows="10" placeholder="Mensagem"></textarea>
                <label for="message"></label>
            </div>
            <div class="form-input">
                <button type="submit">Enviar!</button>
            </div>
        </form>
    </div>
</section>
@endsection