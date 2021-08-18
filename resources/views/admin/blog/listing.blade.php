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
                <button><i class="fa fa-plus"></i> Adicionar post</button>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post['name'] }}</td>
                            <td>{{$post['category']}}</td>
                            <td>{{$post['author']}}</td>
                            <td>{{Carbon\Carbon::parse($post['created_at'])->diffForHumans()}}</td>
                            <td>
                                <a href=""><i class="fa fa-edit"></i></a>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$posts->links()}} --}}
        </div>
    </div>
</div>
@endsection
