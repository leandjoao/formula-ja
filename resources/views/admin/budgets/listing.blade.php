@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Orçamentos</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de novos</h3>
                @if(Auth::user()->access_level == 2)
                <a href="{{route('guest.receita')}}">Enviar receita</a>
                @endif
            </div>
            @if(count($orcamentos['answered']) + count($orcamentos['new']) !== 0)
            <table class="table table-striped table-bordered" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nº do Pedido</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>PET</th>
                        <th>Criado</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orcamentos['new'] as $orcamento)
                    @if($orcamento['status_id'] == 1)
                    <tr>
                        <td>{{$orcamento['id']}}</td>
                        <td>{{$orcamento['sender']['name']}}</td>
                        <td><span class="status {{$orcamento['status']['label']}}">{{Str::ucfirst($orcamento['status']['label'])}}</span></td>
                        <td class="pet"><i class="{{ boolval($orcamento['pet']) ? 'fa fa-check' : 'fa fa-times'}}"></i></td>
                        <td>{{ Carbon\Carbon::parse($orcamento['created_at'])->diffForHumans() }}</td>
                        <td>
                            <a class="button view" href="{{route('budgets.inner', $orcamento['id'])}}">
                                <span class='text'>Ver</span>
                                <span class="icon"><i class="fa fa-eye"></i></span>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

            <div class="listing-title">
                <h3>Listagem de respondidos</h3>
            </div>
            <table class="table table-striped table-bordered" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nº do Pedido</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>PET</th>
                        <th>Criado</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orcamentos['answered'] as $orcamento)
                    <tr>
                        <td>{{$orcamento['id']}}</td>
                        <td>{{$orcamento['sender']['name']}}</td>
                        <td><span class="status {{$orcamento['status']['label']}}">{{Str::ucfirst($orcamento['status']['label'])}}</span></td>
                        <td class="pet"><i class="{{ boolval($orcamento['pet']) ? 'fa fa-check' : 'fa fa-times'}}"></i></td>
                        <td>{{ Carbon\Carbon::parse($orcamento['created_at'])->diffForHumans() }}</td>
                        <td>
                            <a class="button view" href="{{route('budgets.inner', $orcamento['id'])}}">
                                <span class='text'>Ver</span>
                                <span class="icon"><i class="fa fa-eye"></i></span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <p class="text-center">Sem pedidos</p>
            @endif
        </div>
    </div>
</div>
@endsection
