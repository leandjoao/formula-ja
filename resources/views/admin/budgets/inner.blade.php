@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3> Orçamento: #{{$budget['id']}}</h3>
    </div>
    <div class="main-content">
        <div class="budget">
            <div class="budget-infos">
                <table>
                    <tr>
                        <th><i class="fa fa-user"></i> Nome:</th>
                        <td>{{Str::ucfirst(($budget['sender']['name']))}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-at"></i> Email: </th>
                        <td><a href="mailto:{{$budget['sender']['email']}}">{{$budget['sender']['email']}}</a></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-phone"></i> Telefone: </th>
                        <td>{{$budget['sender']['phone']}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-paw"></i> PET: </th>
                        <td><i class="fa {{ boolval($budget['pet']) ? 'fa-check' : 'fa-times'}}"></i></td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-question"></i> Status: </th>
                        <td>{{$budget['status']}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-calendar-alt"></i> Enviado em: </th>
                        <td>{{ Carbon\Carbon::parse($budget['created_at'])->toFormattedDateString()}}</td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-file-pdf"></i> Arquivo enviado: </th>
                        <td><a href="{{asset('storage/uploads/'.$budget['file']['file'])}}" target="_blank">Ver Arquivo</a></td>
                    </tr>
                </table>
            </div>

            @if(Auth::user()->access_level == 1 || Auth::user()->access_level == 2)
            @foreach ($budget['answers'] as $answers)
            <div class="budget-answered">
                <div class="budget-answered-title">
                    <h3>Reposta de: {{$answers['info']['name']}}</h3>
                    @if(Auth::user()->access_level == 2)
                    <div class="btn-group">
                        <a class="accept" href="{{route('budgets.accept', $answers['id'])}}"><i class="fa fa-check"></i> Aceitar</a>
                    </div>
                    @endif
                </div>
                @if($answers['description'])
                    <div class="budget-answered-description">
                        <p><strong>Descrição:</strong> {{$answers['description']}}</p>
                    </div>
                @endif
                @php($total = 0)
                <button class="accordion">Ver Items ({{count($answers['items'])}})</button>
                <div class="panel">
                    <ul class="budget-answered-list">
                        @foreach ($answers['items'] as $item)
                        <li>
                            <p>{{$item['item']}}</p>
                            <p>R$ {{number_format($item['price'], 2, ',','.')}}</p>
                        </li>
                        @php($total += number_format($item['price']))
                        @endforeach
                    </ul>
                </div>
                <div class="budget-summary">
                    <p><strong>Total</strong></p>
                    <p>R$ <span class="summary">{{ number_format($total, 2, ',', '.') }}</span></p>
                </div>
            </div>
            @endforeach
            @endif
            @if(Auth::user()->access_level == 3)
            <div class="budget-answer">
                <div class="budget-answer-title">
                    <h3>Responder orçamento</h3>
                    <div class="btn-group">
                        <div class="add"><i class="fa fa-plus"></i> Adicionar</div>
                        <div class="remove"><i class="fa fa-minus"></i> Remover</div>
                    </div>
                </div>
                <div class="budget-answer-list">
                    <form action="{{route('budgets.sendAnswer')}}" class="form" method="POST">
                        @csrf
                        <div class="form-group" id="item-0">
                            <div class="form-input">
                                <input type="text" name="answer[0][item]" id="answer-0-item" required />
                                <label for="answer-0-item">Item</label>
                            </div>
                            <div class="form-input">
                                <input type="text" class="money"  name="answer[0][price]" id="answer-0-price" required />
                                <label for="answer-0-price">Preço</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="budget-summary">
                    <p><strong>Total</strong></p>
                    <p>R$ <span class="summary" id="budgetSummary">00.00</span></p>
                </div>

                <div class="budget-send">
                    <div class="btn-group">
                        <button type="submit" class="sendBudget">Enviar <i class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
@section('extraJS')
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
@endsection
