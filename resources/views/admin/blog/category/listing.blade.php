@extends('layouts.admin')
@section('content')
    <div class="main">
        <div class="main-header">
            <h3>Blog</h3>
        </div>
        <div class="main-content">
            <div class="listing">
                <div class="listing-title">
                    <h3>Listagem de categorias ({{count($categories)}})</h3>
                    <a href="{{route('blog.category.new')}}" class="btn btn-formulaja"><i class="fa fa-plus"></i> Adicionar Categoria</a>
                </div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th>Categoria</th>
                        <th>Posts</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->label}}</td>
                            <td>{{$category->posts_count}}</td>
                            <td>{{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}</td>
                            <td>
                                <a class="button view" href="{{route('blog.category.edit', $category->id)}}">
                                    <span class='text'>Editar</span>
                                    <span class="icon"><i class="fa fa-edit"></i></span>
                                </a>
                                <a class="button delete" href="{{route('blog.category.remove', $category->id)}}">
                                    <span class='text'>Remover</span>
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
@endsection
