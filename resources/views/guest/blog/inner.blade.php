@extends('layouts.guest')
@section('content')
<div class="blog-section">
    <div class="blog-section-banner">
        <h3>{{ $post['title'] }}</h3>
        <ul class="blog-section-banner-breadcrumb">
            <li><a href="{{ route('guest.blog')}}">Blog</a></li>
            <li><span>{{$post['title']}}</span></li>
        </ul>
    </div>
    <div class="blog-section-content">
        <section class="blog-content">
            <div class="blog-content-banner">
                <img src="{{ $post['banner'] }}" title="Imagem de {{ $post['title'] }}" alt="{{ $post['title'] }}">
            </div>
            <div class="blog-content-text">
                {!! $post['content'] !!}
            </div>
        </section>
        <aside class="blog-aside">
            <div class="blog-aside-blocks">

                <div class="block block-search">
                    @include('guest.blog.components.search')
                </div>

                <div class="block block-instagram">
                    @include('guest.blog.components.instagram')
                </div>

                <div class="block block-social">
                    @include('guest.blog.components.social')
                </div>
                @if(!empty($post))
                    <div class="block block-categories">
                        @include('guest.blog.components.categorias')
                    </div>

                    <div class="block block-feed">
                        @include('guest.blog.components.lastPosts')
                    </div>
                @endif
            </div>
        </aside>
    </div>
</div>
@endsection
