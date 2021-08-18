@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Categorias</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de categorias ({{count($categories)}})</h3>
                <button><i class="fa fa-plus"></i> Adicionar categoria</button>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Posts</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category['label'] }}</td>
                            <td>{{$category['posts']}}</td>
                            <td>{{Carbon\Carbon::parse($category['created_at'])->diffForHumans()}}</td>
                            <td>
                                <a href=""><i class="fa fa-edit"></i></a>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$categories->links()}} --}}
        </div>
    </div>
</div>
@endsection
