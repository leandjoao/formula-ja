@extends('layouts.guest')
@section('content')
<section class="banner">
    <div class="banner-container">
        <div class="banner-container-text">
            <h4>{{$data['banner']['super_text']}}</h4>
            <h2>{{$data['banner']['slogan']}}</h2>
            <p>{{$data['banner']['under_text']}}</p>
            <a href="{{route('send.receipt')}}">Envie sua receita!</a>
        </div>
    </div>
</section>

<div class="hiw">
    <div class="hiw-title">
        <h4>Como funciona?</h4>
    </div>
    <div class="hiw-container">
        @foreach($data['hiw'] as $hiw)
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/pet/'.$hiw['icon'])}}" alt="{{$hiw['title']}}">
            <p>{{$hiw['title']}}</p>
            <span>{{$hiw['text']}}</span>
        </div>
        @endforeach
    </div>
</div>

@if(!empty($data['posts']))
<div class="blog">
    <div class="blog-container">
        <h2>Blog</h2>
        <h6>Fique por dentro das últimas notícias</h6>
        <div class="posts">
            @foreach ($data['posts'] as $post)
            <div class="posts-item">
                <div class="posts-item-image">
                    <img src="{{asset('storage/blog/'.$post['banner'])}}" alt="{{$post['title']}}" title="{{$post['title']}}">
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

@if(!empty($data['depoimentos']))
<div class="depoimentos">
    <div class="depoimentos-container">
        <div class="depoimentos-container-title">
            <h3>Depoimentos</h3>
        </div>
        <div class="swiper-container depoimentos-slider">
            <div class="swiper-wrapper">

                @foreach ($data['depoimentos'] as $depoimento)
                <div class="swiper-slide">
                    <div class="depoimentos-item">
                        <div class="depoimentos-item-header">
                            @if(is_null($depoimento['avatar']))
                            <img src="{{asset('storage/icons/user.png')}}" alt="Avatar de {{$depoimento['name']}}">
                            @else
                            <img src="{{asset('storage/testemonials/'.$depoimento['avatar'])}}" alt="Avatar de {{$depoimento['name']}}">
                            @endif
                            <div class="depoimentos-item-header-info">
                                <p>{{$depoimento['name']}}</p>
                                <small>{{$depoimento['business']}}</small>
                            </div>
                        </div>
                        <div class="depoimentos-item-content">
                            <h5>{{$depoimento['title']}}</h5>
                            <p>
                                {{$depoimento['testemonial']}}
                            </p>
                            <span><small>{{ Carbon\Carbon::parse($depoimento['created_at'])->diffForHumans() }}</small></span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination depoimentos-pagination"></div>
        </div>
    </div>
</div>
@endif

@if((count($data['faq']['user']) + count($data['faq']['partner'])) !== 0)
<div class="duvidas">
    <div class="duvidas-container">
        <div class="duvidas-container-text">
            <h3>{{$data['et']['faq_title']}}</h3>
            <p>{{$data['et']['faq_text']}}</p>
        </div>
        <div class="duvidas-container-collapsible">
            <div class="collapsible">
                <div class="collapsible-title">Ajuda para Usuários</div>
                @foreach($data['faq']['user'] as $faq)
                <div class="collapsible-content-title"><i class="fa fa-caret-right"></i> {{$faq['question']}}</div>
                <div class="collapsible-content-text">
                    <p>{{$faq['answer']}}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="duvidas-container-collapsible">
            <div class="collapsible">
                <div class="collapsible-title">Ajuda para Perceiros</div>
                @foreach($data['faq']['partner'] as $faq)
                <div class="collapsible-content-title"><i class="fa fa-caret-right"></i> {{$faq['question']}}</div>
                <div class="collapsible-content-text">
                    <p>{{$faq['answer']}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty($partnersPet))
<div class="parceiros">
    <h2>Conheça os nossos parceiros</h2>

    <div class="parceiros-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach($partnersPet as $partner)
            <div class="swiper-slide">
                <img src="{{$partner['logo'] ?? "http://placehold.it/150x150?text=".$partner['name']}}" alt="{{$partner['name']}}">
            </div>
            @endforeach
        </div>
        <div class="swiper-button-prev parceiros-prev"></div>
        <div class="swiper-button-next parceiros-next"></div>
    </div>
</div>
@endif

@endsection
