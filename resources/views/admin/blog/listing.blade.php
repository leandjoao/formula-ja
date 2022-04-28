@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Blog</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de posts ({{count($posts)}})</h3>
                <a href="{{route('blog.new')}}" class="btn btn-formulaja"><i class="fa fa-plus"></i> Adicionar post</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{$post->category->label}}</td>
                            <td>{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</td>
                            <td>
                                <a class="button view" href="{{route('blog.edit', $post->id)}}">
                                    <span class='text'>Editar</span>
                                    <span class="icon"><i class="fa fa-edit"></i></span>
                                </a>
                                <a class="button view" href="{{route('guest.blog.inner', [$post->category, $post->slug])}}">
                                    <span class='text'>Ver</span>
                                    <span class="icon"><i class="fa fa-eye"></i></span>
                                </a>
                                <a class="button delete" href="{{route('blog.remove', $post->slug)}}">
                                    <span class='text'>Remover</span>
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             {{$posts->links()}}
        </div>
    </div>
</div>
@endsection
