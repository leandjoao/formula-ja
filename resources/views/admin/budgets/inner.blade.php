@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3> Orçamento: #32112</h3>
    </div>
    <div class="main-content">
        <div class="budget">
            <div class="budget-infos">
                <table>
                    <tr>
                        <th><i class="fa fa-user"></i> Nome:</th>
                        <td>Nome de quem enviou</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-at"></i> Email: </th>
                        <td><a href="mailto:teste@teste.com.br">teste@teste.com.br</a></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-phone"></i> Telefone: </th>
                        <td>(15) 9 9999-9999</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-paw"></i> PET: </th>
                        <td><i class="fa {{ (rand(1,4) % 2) ? 'fa-check' : 'fa-times'}}"></i></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-question"></i> Status: </th>
                        <td>Aguardando</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-calendar-alt"></i> Enviado em: </th>
                        <td>{{ Carbon\Carbon::now()->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-file-pdf"></i> Arquivo enviado: </th>
                        <td><a href="{{asset('storage/uploads/exemplo.pdf')}}" target="_blank">Ver Arquivo</a></td>
                    </tr>
                </table>
            </div>

            @if(Auth::user()->access_level === 1 || Auth::user()->access_level === 2)
                <div class="budget-answered">
                    <div class="budget-answered-title">
                        <h3>Orçamento Respondido</h3>
                        @if(Auth::user()->access_level === 2)
                        <div class="btn-group">
                            <div class="accept"><i class="fa fa-check"></i> Aceitar</div>
                            <div class="revoke"><i class="fa fa-times"></i> Recusar</div>
                        </div>
                        @endif
                    </div>
                    <ul class="budget-answered-list">
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                        <li>
                            <p>Item</p>
                            <p>R$ 99,99</p>
                        </li>
                    </ul>
                    <div class="budget-summary">
                        <p><strong>Total</strong></p>
                        <p>R$ <span class="summary">10.333,00</span></p>
                    </div>
                </div>
            @endif
            @if(Auth::user()->access_level === 3)
            <div class="budget-answer">
                <div class="budget-answer-title">
                    <h3>Responder orçamento</h3>
                    <div class="btn-group">
                        <div class="add"><i class="fa fa-plus"></i> Adicionar</div>
                        <div class="remove"><i class="fa fa-minus"></i> Remover</div>
                    </div>
                </div>
                <div class="budget-answer-list">
                    <form action="" class="form">
                        <div class="input-group">
                            <input type="text" name="answer[0][medicine]" placeholder="Item">
                            <input type="number" name="answer[0][value]" placeholder="Preço">
                        </div>
                    </form>
                </div>
                <div class="budget-summary">
                    <p><strong>Total</strong></p>
                    <p>R$ <span class="summary">10.333,00</span></p>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
