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
                nulla pariatur.
            </p>
            <a href="">Envie sua receita!</a>
        </div>
    </div>
</section>

<div class="how-it-works">
    <div class="how-it-works-title">
        <h4>Como funciona?</h4>
    </div>
    <div class="how-it-works-container">
        <div class="how-it-works-container-item">
            <img src="{{ asset('storage/icons/upload.png') }}" alt="">
            <span>Envio da receita</span>
        </div>
        <div class="how-it-works-container-item">
            <img src="{{ asset('storage/icons/budget.png') }}" alt="">
            <span>Orçamento</span>
        </div>
        <div class="how-it-works-container-item">
            <img src="{{ asset('storage/icons/payment.png') }}" alt="">
            <span>Pagamento</span>
        </div>
        <div class="how-it-works-container-item">
            <img src="{{ asset('storage/icons/manipulate.png') }}" alt="">
            <span>Manipulação</span>
        </div>
        <div class="how-it-works-container-item">
            <img src="{{ asset('storage/icons/deliver.png') }}" alt="">
            <span>Envio do produto</span>
        </div>
    </div>
</div>

<div class="why-us">
    <div class="why-us-container">
        <div class="why-us-container-boxes">
            <div class="boxes">
                <div class="boxes-item">
                    <img src="{{ asset('storage/icons/organic.png') }}" alt="">
                    <p>100% Orgânico</p>
                    <span>Duis aute irure dolor in reprehenderit in voluptate</span>
                </div>
                <div class="boxes-item">
                    <img src="{{ asset('storage/icons/chemistry.png') }}" alt="">
                    <p>Sem Química</p>
                    <span>Duis aute irure dolor in reprehenderit in voluptate</span>
                </div>
                <div class="boxes-item">
                    <img src="{{ asset('storage/icons/tested.png') }}" alt="">
                    <p>Produtos Testados</p>
                    <span>Duis aute irure dolor in reprehenderit in voluptate</span>
                </div>
                <div class="boxes-item">
                    <img src="{{ asset('storage/icons/wellness.png') }}" alt="">
                    <p>Bem estar garantido</p>
                    <span>Duis aute irure dolor in reprehenderit in voluptate</span>
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
                <a href="{{route('guest.about')}}">Ler mais</a>
            </div>
        </div>
    </div>
</div>

<div class="pet">
    <div class="pet-container">
        <div class="pet-container-text">
            <h2>Não poderiamos deixar nossos amigos de fora!</h2>
            <p>Envie a receita do seu pet para gente! Teremos o maior prazer em ajudar!</p>
            <button onclick="toggleModal()">Enviar receita</button>
        </div>
    </div>
</div>

@if(!empty($posts))
<div class="blog">
    <div class="blog-container">
        <h2>Blog</h2>
        <h6>Fique por dentro das últimas notícias</h6>
        <div class="posts">
            @foreach ($posts as $post)
            <div class="posts-item">
                <div class="posts-item-image">
                    <img src="{{$post['banner']}}" alt="{{$post['title']}}" title="{{$post['title']}}">
                </div>
                <div class="posts-item-title">
                    <p>{{$post['title']}}</p>
                </div>
                <div class="posts-item-text">
                    {!! Str::limit($post['content'], 100, '...') !!}
                </div>
                <div class="posts-item-footer">
                    <p>{{ Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</p>
                    <a href="{{route('guest.blog.inner', [$post['category']['label'], $post['slug']])}}">Ler Mais <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
        <a class="blog-container-link" href="{{route('guest.blog')}}">Ler mais no blog</a>
    </div>
</div>
@endif

<div class="depoimentos">
    <div class="depoimentos-container">
        <div class="depoimentos-container-title">
            <h3>Depoimentos</h3>
            <p>Lorem Ipsum</p>
        </div>
        <div class="swiper-container depoimentos-slider">
            <div class="swiper-wrapper">
                @for($i = 0; $i < 4; $i++)
                <div class="swiper-slide">
                    <div class="depoimentos-item">
                        <div class="depoimentos-item-header">
                            <img src="{{asset('storage/icons/user.png')}}" alt="">
                            <p>Nome do Usuário</p>
                        </div>
                        <div class="depoimentos-item-content">
                            <h5>Título</h5>
                            <p>
                                Aliquam ultrices a nunc tincidunt semper. Cras dui sapien, cursus eu ultrices quis, sodales eget lorem. Nunc varius mi a orci ornare sagittis. Nam ac venenatis mauris, condimentum malesuada eros. Aenean rutrum, augue vel consequat fringilla, ligula dui venenatis velit, et eleifend metus odio ultrices dui.
                            </p>
                            <span><small>{{ date('d/m/Y') }}</small></span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="swiper-pagination depoimentos-pagination"></div>
        </div>
    </div>
</div>

@endsection

@section('modal')
@include('guest.modal.pet')
@endsection
