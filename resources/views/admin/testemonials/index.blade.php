@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Depoimentos</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de depoimentos ({{count($testemonials)}})</h3>
                <a href="{{route('testemonials.new')}}" class="btn btn-formulaja"><i class="fa fa-plus"></i> Adicionar depoimento</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testemonials as $testemonial)
                        <tr>
                            <td>{{$testemonial->name }}</td>
                            <td>{{$testemonial->business}}</td>
                            <td>{{$testemonial->title}}</td>
                            <td>{{Carbon\Carbon::parse($testemonial->created_at)->diffForHumans()}}</td>
                            <td>
                                <a class="button view" href="{{route('testemonials.edit', $testemonial->id)}}">
                                    <span class='text'>Ver</span>
                                    <span class="icon"><i class="fa fa-eye"></i></span>
                                </a>
                                <a class="button delete" href="{{route('testemonials.remove', $testemonial->id)}}">
                                    <span class='text'>Remover</span>
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             {{$testemonials->links()}}
        </div>
    </div>
</div>
@endsection
