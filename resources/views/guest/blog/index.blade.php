@extends('layouts.guest')
@section('content')
<div class="blog-section">
    <div class="blog-section-banner">
        <h3>Blog</h3>
    </div>
    <div class="blog-section-content">
        <section class="blog-content">
            @if(empty($posts))
            <div class="no-posts">
                <h2>Infelizmente, não temos nenhum post 🙁</h2>
            </div>
            @else
            <div class="blog-content-posts">
                @foreach ($posts as $post )
                @include('guest.blog.components.post')
                @endforeach
            </div>
            {{ $posts->links() }}
            @endif
        </section>
        <aside class="blog-aside">
            <div class="blog-aside-blocks">

                <div class="block block-search">
                    @include('guest.blog.components.search')
                </div>

                {{-- <div class="block block-instagram">
                    @include('guest.blog.components.instagram')
                </div> --}}

                @if(!empty($sm))
                <div class="block block-social">
                    @include('guest.blog.components.social')
                </div>
                @endif

                @if(!empty($posts))
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
