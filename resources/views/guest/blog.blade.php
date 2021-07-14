@extends('layouts.guest')
@section('content')
<div class="blog-section">
    <div class="blog-section-banner">
        <h3>Blog</h3>
    </div>
    <div class="blog-section-content">
        <section class="blog-content">
            <div class="no-posts">
                <h2>Infelizmente, não temos nenhum post 🙁</h2>
            </div>
            {{--
            <div class="blog-content-posts">
                @for($i = 0; $i < 9; $i++)
                <div class="post">
                    <div class="post-image">
                        <img src="http://placehold.it/277x200" alt="">
                    </div>
                    <div class="post-text">
                        <h4>Título</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis, risus quis maximus ultricies, sapien purus elementum justo, at vestibulum nunc est eget lacus. Donec egestas sagittis nunc, vel tristique sapien commodo vitae.
                        </p>
                        <div class="post-text-footer">
                            <small>{{ Carbon\Carbon::now()->add($i, 'day')->diffForHumans() }}</small>
                            <a href="">Ler Mais <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            --}}
        </section>
        <aside class="blog-aside">
            <div class="blog-aside-blocks">

                {{--
                <div class="block block-search">
                    <h5>Buscar</h5>
                    <form action="{{ route('blog.search') }}" method="POST" class="block-search-form">
                        <div class="block-search-form-input">
                            <input type="text" name="search" placeholder="Ex.: Categoria, Título do post">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                --}}

                <div class="block block-instagram">
                    <h5>Instagram</h5>
                    <div class="block-instagram-images">
                        @for($i = 0; $i < 6; $i++)
                        <img src="http://placehold.it/76x76" alt="" />
                        @endfor
                    </div>
                </div>

                <div class="block block-social">
                    <h5>Redes Sociais</h5>
                    <div class="block-social-links">
                        <a href=""><i class="fab fa-facebook-f"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                {{--
                <div class="block block-categories">
                    <h5>Categorias</h5>
                    <ul class="block-categories-list">
                        @for($i = 0; $i < 6; $i++)
                        <li>
                            <a href="">Categoria</a>
                            <p>(14)</p>
                        </li>
                        @endfor
                    </ul>
                </div>

                <div class="block block-feed">
                    <h5>Últimos Posts</h5>
                    <ul class="block-feed-posts">
                        @for($i = 0; $i < 4; $i++)
                        <li>
                            <a href="">
                                <img src="http://placehold.it/70x70" alt="">
                                <span>
                                    <p>Titulo</p>
                                    <small>{{ Carbon\Carbon::now()->add($i, 'day')->diffForHumans() }}</small>
                                </span>
                            </a>
                        </li>
                        @endfor
                    </ul>
                </div>
                --}}
            </div>
        </aside>
    </div>
</div>
@endsection
