@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dashboard</h3>
    </div>

    <div class="main-content">
        <div class="main-content-boxes">
            <div class="main-content-boxes-box">
                <small>Vendas</small>
                <h5>2.000</h5>
                <p>
                    <span class="good">+100%</span> desde o mês passado
                </p>
            </div>
            <div class="main-content-boxes-box">
                <small>Ganhos</small>
                <h5>R$21.300</h5>
                <p>
                    <span class="bad">-1.5%</span> desde o mês passado
                </p>
            </div>
            <div class="main-content-boxes-box">
                <small>Usuários</small>
                <h5>501</h5>
                <p>
                    <span class="good">+10%</span> desde o mês passado
                </p>
            </div>
            <div class="main-content-boxes-box">
                <small>Parceiros</small>
                <h5>45</h5>
                <p>
                    <span class="good">+10%</span> desde o mês passado
                </p>
            </div>
        </div>
        <div class="main-content-graph">
            <small>Movimento durante o ano</small>
            <img src="{{asset('storage/graph.png')}}" alt="">
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
                        <th>Data de Envio</th>
                        <th>Status</th>
                        <th>Aceito por</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nome</td>
                        <td>{{date('d/m/Y')}}</td>
                        <td><span class="concluido">Concluido</span></td>
                        <td>Nome do Parceiro</td>
                    </tr>
                    <tr>
                        <td>Nome</td>
                        <td>{{date('d/m/Y')}}</td>
                        <td><span class="pendente">Pendente</span></td>
                        <td>Nome do Parceiro</td>
                    </tr>
                    <tr>
                        <td>Nome</td>
                        <td>{{date('d/m/Y')}}</td>
                        <td><span class="recusado">Recusado</span></td>
                        <td>Nome do Parceiro</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
