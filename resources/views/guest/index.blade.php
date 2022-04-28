@extends('layouts.guest')
@section('content')
<section class="banner" style="background-image: linear-gradient(-18deg, rgba(253, 232, 161, 0.4), rgba(255, 250, 236, 0.4) 80%), url({{asset('storage/paginas/home/'.$data['dataPage']['img_banner'])}});">
    <div class="banner-container">
        <div class="banner-container-text">
            <h4>{{$data['dataPage']['tag_banner']}}</h4>
            <h2>{{$data['dataPage']['title_banner']}}</h2>
            <p>{{$data['dataPage']['subtitle_banner']}}</p>
            <a href="{{route('send.receipt')}}">Envie sua receita!</a>
        </div>
    </div>
</section>

<div class="hiw">
    <div class="hiw-title">
        <h4>{{$data['dataPage']['title_como_funciona']}}</h4>
    </div>
    <div class="hiw-container">
        {{-- @foreach($data['hiw'] as $hiw) --}}
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/upload.png')}}" alt="{{$data['dataPage']['title_cf1']}}">
            <p>{{$data['dataPage']['title_cf1']}}</p>
            <span>{{$data['dataPage']['subtitle_cf1']}}</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/budget.png')}}" alt="{{$data['dataPage']['title_cf2']}}">
            <p>{{$data['dataPage']['title_cf2']}}</p>
            <span>{{$data['dataPage']['subtitle_cf2']}}</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/payment.png')}}" alt="{{$data['dataPage']['title_cf3']}}">
            <p>{{$data['dataPage']['title_cf3']}}</p>
            <span>{{$data['dataPage']['subtitle_cf3']}}</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/manipulate.png')}}" alt="{{$data['dataPage']['title_cf4']}}">
            <p>{{$data['dataPage']['title_cf4']}}</p>
            <span>{{$data['dataPage']['subtitle_cf4']}}</span>
        </div>
        <div class="hiw-container-step">
            <img src="{{asset('storage/icons/deliver.png')}}" alt="{{$data['dataPage']['title_cf5']}}">
            <p>{{$data['dataPage']['title_cf5']}}</p>
            <span>{{$data['dataPage']['subtitle_cf5']}}</span>
        </div>
        {{-- @endforeach --}}
    </div>
</div>

<div class="why-us">
    <div class="why-us-container">
        <div class="why-us-container-image">
            <img src="{{asset('storage/paginas/home/'.$data['dataPage']['img_about'])}}" alt="{{$data['dataPage']['title_about']}}">
        </div>
        <div class="why-us-container-text">
            <div class="why-us-container-text-content">
                <h5>{{$data['dataPage']['title_about']}}</h5>
                <span>{{$data['dataPage']['subtitle_about']}}</span>
                <p>{!!$data['dataPage']['txt_about']!!}</p>
                <a href="{{route('guest.about')}}">Ler mais</a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="pet" style="background-image: linear-gradient(to left, rgba(67, 126, 106, 0.2), rgba(67, 126, 106, 0.8) 80%), url({{asset('storage/paginas/home/'.$data['dataPage']['img_pet'])}});">
    <div class="pet-container">
        <div class="pet-container-text">
            <h2>{{$data['dataPage']['title_pet']}}</h2>
            <p>{{$data['dataPage']['subtitle_pet']}}</p>
            <a href="{{route('guest.receita.pet')}}">Enviar receita</a>
        </div>
    </div>
</div> --}}

@if(!empty($data['posts']))
<div class="blog">
    <div class="blog-container">
        <h2>{{$data['dataPage']['title_blog']}}</h2>
        <h6>{{$data['dataPage']['subtitle_pet']}}</h6>
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
                    {!! strip_tags(Str::limit($post['content'], 130, '...')) !!}
                </div>
               
                <div class="posts-item-footer">
                    <p>{{ Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</p>
                    <a href="{{route('guest.blog.inner', [\Str::slug($post['category']['label']), $post['slug']])}}">Ler Mais <i class="fas fa-long-arrow-alt-right"></i></a>
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
            <h3>{{$data['dataPage']['title_depoimentos']}}</h3>
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
            <h3>{{$data['dataPage']['title_faq']}}</h3>
            <p>{{$data['dataPage']['subtitle_faq']}}</p>
        </div>
        <div class="duvidas-container-collapsible">
            <div class="collapsible">
                {{-- <div class="collapsible-title">Ajuda para Usuários</div> --}}
                @foreach($data['faq']['user'] as $faq)
                <div class="collapsible-content-title"><i class="fa fa-caret-right"></i> {{$faq['question']}}</div>
                <div class="collapsible-content-text">
                    <p>{{$faq['answer']}}</p>
                </div>
                @endforeach
            </div>
        </div>
        {{-- <div class="duvidas-container-collapsible">
            <div class="collapsible">
                <div class="collapsible-title">Ajuda para Perceiros</div>
                @foreach($data['faq']['partner'] as $faq)
                <div class="collapsible-content-title"><i class="fa fa-caret-right"></i> {{$faq['question']}}</div>
                <div class="collapsible-content-text">
                    <p>{{$faq['answer']}}</p>
                </div>
                @endforeach
            </div>
        </div> --}}
    </div>
</div>
@endif

@if(!empty($partners))
    @include('components.parceiros', ['title_parceiros' => $title_parceiros ?? 'Conheça os nossos parceiros'])
@endif

@endsection
