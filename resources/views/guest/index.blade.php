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

    <div class="why-us">
        <div class="why-us-container">
            <div class="why-us-container-boxes">
                <div class="boxes">
                    <div class="boxes-item">
                        <img src="{{ asset('') }}" alt="">
                        <p>Titulo</p>
                        <span>Little Text</span>
                    </div>
                    <div class="boxes-item">
                        <img src="{{ asset('') }}" alt="">
                        <p>Titulo</p>
                        <span>Little Text</span>
                    </div>
                    <div class="boxes-item">
                        <img src="{{ asset('') }}" alt="">
                        <p>Titulo</p>
                        <span>Little Text</span>
                    </div>
                    <div class="boxes-item">
                        <img src="{{ asset('') }}" alt="">
                        <p>Titulo</p>
                        <span>Little Text</span>
                    </div>
                </div>
            </div>
            <div class="why-us-container-text">
                <div class="why-us-container-text-content">
                    <h5>Por que nós?</h5>
                    <span>O melhor para a sua saúde!</span>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate nec quam sit amet mollis.
                        Integer urna enim, semper vitae cursus sit amet, hendrerit eget turpis. Duis mauris massa, pharetra
                        a scelerisque in, imperdiet non leo. Nulla feugiat purus at felis efficitur malesuada. Vestibulum
                        vestibulum luctus lacus, nec tempor est tincidunt in. Ut velit nunc, rutrum non sem pellentesque,
                        ultricies ultricies mauris. Orci varius natoque penatibus et magnis dis parturient montes, nascetur
                        ridiculus mus.
                    </p>
                    <a href="">Ler mais</a>
                </div>
            </div>
        </div>
    </div>

    <div class="pet">
        <div class="pet-container">
            <div class="pet-container-text">
                <h2>Não poderiamos deixar nossos amigos de fora!</h2>
                <p>Envie a receita do seu pet para gente! Teremos o maior prazer em ajudar!</p>
                <button>Enviar receita</button>
            </div>
        </div>
    </div>

    <div class="blog">
        <div class="blog-container">
            <h2>Blog</h2>
            <h6>Fique por dentro das últimas notícias</h6>
            <div class="posts">
                <div class="posts-item">
                    <div class="posts-item-image">
                        <img src="https://picsum.photos/300/240" alt="">
                    </div>
                    <div class="posts-item-title">
                        <p>Titulo</p>
                    </div>
                    <div class="posts-item-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate nec quam sit amet mollis. Integer urna enim, semper vitae cursus sit amet, hendrerit eget turpis.</p>
                    </div>
                    <div class="posts-item-footer">
                        <p>{{ date('d/m/y - H:m') }}</p>
                        <a href="">Ler Mais <i class="fas fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
            <a class="blog-container-link" href="">Ler mais no blog</a>
        </div>
    </div>
    @endsection
