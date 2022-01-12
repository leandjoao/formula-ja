@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dashboard</h3>
    </div>

    <div class="main-content">
        <div class="main-content-boxes">
            <div class="main-content-boxes-box">
                <small>Pedidos</small>
                <h5>{{count($data['budgets'])}}</h5>
                <p><a href="{{route('budgets')}}">Ver Todos <i class="fas fa-long-arrow-alt-right"></i></a></p>
            </div>
            <div class="main-content-boxes-box">
                <small>Saldo</small>
                <h5>R$ {{number_format($data['balance']->available_amount/100, 2, ',', ' ')}}</h5>
                <p>
                    @if($data['balance']->waiting_funds_amount > 0)
                    <span class="good">+ R$ {{number_format($data['balance']->waiting_funds_amount/100, 2, ',', ' ')}}</span> para ser liberado
                    @else
                    <span class="bad">R$ {{number_format($data['balance']->waiting_funds_amount/100, 2, ',', ' ')}}</span> para ser liberado
                    @endif
                </p>
            </div>
            <div class="main-content-boxes-box">
                <small>Usuários</small>
                <h5>{{$data['users']}}</h5>
                <p><a href="{{route('users')}}">Ver Todos <i class="fas fa-long-arrow-alt-right"></i></a></p>
            </div>
            <div class="main-content-boxes-box">
                <small>Parceiros</small>
                <h5>{{$data['partners']}}</h5>
                <p><a href="{{route('partners')}}">Ver Todos <i class="fas fa-long-arrow-alt-right"></i></a></p>
            </div>
        </div>
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
