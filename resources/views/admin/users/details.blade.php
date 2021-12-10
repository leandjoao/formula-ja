@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3> Usuário: {{$user['name']}}</h3>
    </div>
    <div class="main-content">
        <div class="user">
            <div class="user-infos">
                <h4>Informações:</h4>
                <table>
                    <tr>
                        <th><i class="fa fa-user"></i> Nome: </th>
                        <td>{{Str::ucfirst($user['name'])}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-at"></i> E-mail: </th>
                        <td><a href="mailto:{{$user['email']}}">{{$user['email']}}</a></td>
                    </tr>
                    <tr>
                        <th><i class="far fa-id-card"></i> CPF: </th>
                        <td>{{$user['cpf']}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-phone"></i> Telefone: </th>
                        <td>{{$user['phone']}}</td>
                    </tr>
                    <tr>
                        <th><i class="far fa-calendar-alt"></i> Criado em: </th>
                        <td>{{Carbon\Carbon::parse($user['created_at'])->toFormattedDateString()}}</td>
                    </tr>
                </table>
            </div>
            <div class="user-address">
                <h4>{{(count($user['address']) <= 1) ? "Endereço:" : "Endereços:"}}</h4>
                <table class="table table-striped table-bordered" cellspacing=0>
                    <thead>
                        <tr>
                            <th>Nome:</th>
                            <th>Telefone:</th>
                            <th>CEP:</th>
                            <th>Endereço:</th>
                            <th>Número:</th>
                            <th>Bairro:</th>
                            <th>Cidade:</th>
                            <th>Estado:</th>
                            <th>Primário:</th>
                            <th>Complemento:</th>
                            <th>Referência:</th>
                            <th>Criado em:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user['address'] as $address)
                        <tr>
                            <td>{{$address['name']}}</td>
                            <td>{{$address['phone']}}</td>
                            <td>{{$address['cep']}}</td>
                            <td>{!! Str::limit($address['address'], 10, ' [...]') !!}</td>
                            <td>{{$address['number']}}</td>
                            <td>{!! Str::limit($address['neighborhood'], 10, ' [...]') ?? "-" !!}</td>
                            <td>{{$address['city']}}</td>
                            <td>{{$address['state']}}</td>
                            <td><i class="fa {{boolval($address['default']) ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td>{!! Str::limit($address['complement'], 10, ' [...]') ?? "-" !!}</td>
                            <td>{!! Str::limit($address['reference'], 10, ' [...]') ?? "-" !!}</td>
                            <td>{{Carbon\Carbon::parse($address['created_at'])->toFormattedDateString()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($user['access_level'] == 2)
            <div class="user-budgets">
                <h4>{{(count($user['budgets']) <= 1) ? "Pedido:" : "Pedidos:"}}</h4>
                <table class="table table-striped table-bordered" cellspacing=0>
                    <thead>
                        <tr>
                            <th>Status:</th>
                            <th>Respostas:</th>
                            <th>PET:</th>
                            <th>Criado em:</th>
                            <th colspan="2">Ação:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user['budgets'] as $budget)
                        <tr>
                            <td>{{Str::ucfirst($budget['status'])}}</td>
                            <td>{{count($budget['answers'])}}</td>
                            <td><i class="fa {{boolval($budget['pet']) ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td>{{Carbon\Carbon::parse($budget['created_at'])->toFormattedDateString()}}</td>
                            <td><a href="{{route('budgets.inner', $budget['id'])}}">Ver Pedido</a></td>
                            <td><a href="{{asset('storage/uploads/'.$budget['file']['file'])}}" target="_blank">Ver Arquivo</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if($user['access_level'] == 3)
            <div class="user-pharmacy">
                <h4>Informações do parceiro:</h4>
                <table>
                    <tr>
                        <th><i class="fa fa-building"></i> Nome: </th>
                        <td>{{Str::ucfirst($user['pharmacy']['name'])}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-phone"></i> Telefone: </th>
                        <td>{{$user['pharmacy']['phone']}}</td>
                    </tr>
                    <tr>
                        <th><i class="far fa-id-badge"></i> CNPJ: </th>
                        <td>{{$user['pharmacy']['cnpj']}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-map-marker-alt"></i> Endereço: </th>
                        <td>{{$user['pharmacy']['street']}}, {{$user['pharmacy']['number']}} - {{$user['pharmacy']['neighborhood']}}, {{$user['pharmacy']['city']}}/{{$user['pharmacy']['state']}} - {{$user['pharmacy']['zipCode']}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-business-time"></i> Criado em: </th>
                        <td>{{Carbon\Carbon::parse($user['pharmacy']['created_at'])->toFormattedDateString()}}</td>
                    </tr>
                </table>
            </div>

            <div class="pharmacy-answers">
                <h4>{{(count($user['pharmacy']['answers']) <= 1) ? "Resposta:" : "Respostas:"}}</h4>
                <table class="table table-striped table-bordered" cellspacing=0>
                    <thead>
                        <tr>
                            <th>Número do pedido:</th>
                            <th>Aceito:</th>
                            <th>Items:</th>
                            <th>Respondido em:</th>
                            <th>Ação:</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user['pharmacy']['answers'] as $answer)
                        <tr>
                            <td>{{$answer['budget_id']}}</td>
                            <td><i class="fa {{boolval($answer['accepted']) ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td>{{count($answer['items'])}}</td>
                            <td>{{Carbon\Carbon::parse($answer['created_at'])->toFormattedDateString()}}</td>
                            <td><a href="{{route('budgets.inner', $answer['budget_id'])}}">Ver Pedido</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif
        </div>
    </div>
</div>
@endsection
