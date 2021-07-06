@extends('layouts.guest')
@section('content')
    <section class="banner">
        <div class="banner-container">
            <div class="banner-container-text">
                <h4>Lorem Ipsum</h4>
                <h2>Lorem Ipsum dolor sit amet consectetur adipiscing elit</h2>
                <p>
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla
                    pariatur.
                </p>
                <a href="">Envie sua receita!</a>
            </div>
        </div>

        <div class="how-it-works">
            <div class="how-it-works-container">
                <div class="how-it-works-container-item">
                    <img src="{{ asset('icons/upload.png') }}" alt="">
                    <span>Envio da receita</span>
                </div>
                <div class="how-it-works-container-item">
                    <img src="{{ asset('icons/budget.png') }}" alt="">
                    <span>Orçamento</span>
                </div>
                <div class="how-it-works-container-item">
                    <img src="{{ asset('icons/payment.png') }}" alt="">
                    <span>Pagamento</span>
                </div>
                <div class="how-it-works-container-item">
                    <img src="{{ asset('icons/manipulate.png') }}" alt="">
                    <span>Manipulação</span>
                </div>
                <div class="how-it-works-container-item">
                    <img src="{{ asset('icons/deliver.png') }}" alt="">
                    <span>Envio do produto</span>
                </div>
            </div>
    </section>
@endsection
