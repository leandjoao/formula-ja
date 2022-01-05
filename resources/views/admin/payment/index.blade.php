@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Pagamento</h3>
    </div>
    <div class="main-content">
        <div class="payment">
            <div class="payment-info">
                <div class="payment-info-header">
                    <h6>Orçamento de {{$budget['info']['name']}}</h6>
                </div>
                <ul class="payment-info-items">
                    <p><strong>Descrição:</strong> {{$budget['description']}}</p>
                    @foreach ($budget['items'] as $item)
                        <li>
                            <span>{{$item['item']}}</span>
                            <span>R$ {{number_format($item['price'], 2, ',','.')}}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="payment-info-summary">
                    <p>Total:</p>
                    <p>R$ <span class="summary">{{ number_format($budget['amount'], 2, ',', '.') }}</span></p>
                </div>
            </div>
            <div class="payment-card">
                <p>Preencha com os dados do seu cartão para pagamento</p>
                <small>Não guardamos nenhum dado de pagamento. Todas as suas informações estão seguras.</small>
                <form action="{{route('budgets.checkout')}}" method="POST" class="form">
                    @csrf
                    <input type="hidden" name="answerId" value="{{$budget['id']}}" />
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="number" id="number" data-mask="0000 0000 0000 0000" required />
                            <label for="number">Número do Cartão</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="cvv" id="cvv" required data-mask="0009" />
                            <label for="cvv">Código de Segurança</label>
                        </div>
                        <div class="form-input">
                            <select name="exp_month" id="exp_month" required>
                                @for($i = 1; $i < 13; $i++)
                                    <option value="{{$i}}">{{ Carbon\Carbon::create()->month($i)->format('F')}}</option>
                                @endfor
                            </select>
                            <label for="exp_month">Mês de validade</label>
                        </div>
                        <div class="form-input">
                            <select name="exp_year" id="exp_year" required>
                                @for($i = 0; $i < 11; $i++)
                                    <option value="{{Carbon\Carbon::now()->addYears($i)->format('Y')}}">{{ Carbon\Carbon::now()->addYears($i)->format('Y')}}</option>
                                @endfor
                            </select>
                            <label for="exp_year">Ano de validade</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="holder_name" id="holder_name" value="{{Auth::user()->name}}" required />
                            <label for="holder_name">Nome idêntico ao do cartão</label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit">Pagar <i class="far fa-credit-card"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

