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

<div class="hiw">
    <div class="hiw-title">
        <h4>Como funciona?</h4>
    </div>
    <div class="hiw-container">
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/upload.png')}}" alt="">
            <p>Envio da Receita</p>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/budget.png')}}" alt="">
            <p>Orçamento</p>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/payment.png')}}" alt="">
            <p>Pagamento</p>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/manipulate.png')}}" alt="">
            <p>Manipulação</p>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/deliver.png')}}" alt="">
            <p>Envio do produto</p>
            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
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

<div class="parceiros">
    <h2>Conheça os nossos parceiros</h2>

    <div class="parceiros-slider swiper-container">
        <div class="swiper-wrapper">
            @for($i = 0; $i < 5; $i++)
            <div class="swiper-slide">
                <img src="{{asset('storage/pet-example.png')}}" alt="">
            </div>
            @endfor
        </div>
        <div class="swiper-button-prev parceiros-prev"></div>
        <div class="swiper-button-next parceiros-next"></div>
    </div>
</div>

@endsection
