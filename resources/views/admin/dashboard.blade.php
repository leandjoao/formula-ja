@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dashboard</h3>
    </div>

    <div class="main-content">
        <div class="main-content-boxes">
            {{-- <div class="main-content-boxes-box">
                <small>Vendas</small>
                <h5>2.000</h5>
                <p>
                    <span class="good">+100%</span> desde o mês passado
                </p>
            </div> --}}
            {{-- <div class="main-content-boxes-box">
                <small>Ganhos</small>
                <h5>R$21.300</h5>
                <p>
                    <span class="bad">-1.5%</span> desde o mês passado
                </p>
            </div> --}}
            <div class="main-content-boxes-box">
                <small>Usuários</small>
                <h5>{{$data['users']}}</h5>
                <p><a href="{{route('users')}}">Ver Todos <i class="fas fa-long-arrow-alt-right"></i></a></p>
                {{-- <p>
                    <span class="good">+10%</span> desde o mês passado
                </p> --}}
            </div>
            <div class="main-content-boxes-box">
                <small>Parceiros</small>
                <h5>{{$data['partners']}}</h5>
                <p><a href="{{route('partners')}}">Ver Todos <i class="fas fa-long-arrow-alt-right"></i></a></p>
                {{-- <p>
                    <span class="good">+10%</span> desde o mês passado
                </p> --}}
            </div>
        </div>
        {{-- <div class="main-content-graph">
            <small>Movimento durante o ano</small>
            <img src="{{asset('storage/graph.png')}}" alt="">
        </div> --}}
    </div>

    <div class="main-list">
        <div class="main-list-header">
            <small>Últimos pedidos</small>
        </div>
        <div class="main-list-content">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Data de Envio</th>
                        <th>Status</th>
                        <th>PET</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['budgets'] as $pedido)
                    <tr>
                        <td>{{Str::ucfirst($pedido['sender']['name'])}}</td>
                        <td>{{$pedido['sender']['phone']}}</td>
                        <td>{{$pedido['sender']['email']}}</td>
                        <td>{{ Carbon\Carbon::parse($pedido['created_at'])->diffForHumans() }}</td>
                        <td><span class="status {{$pedido['status']['label']}}">{{Str::ucfirst($pedido['status']['label'])}}</span></td>
                        <td><i class="fa {{ boolval($pedido['pet']) ? "fa-check" : "fa-times" }}"></i></td>
                        <td><a href="{{route('budgets.inner', $pedido['id'])}}">Ver Pedido</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
