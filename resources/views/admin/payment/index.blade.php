@extends('layouts.admin')
@section('content')

<div class="main">
    <div class="main-header">
        <h3>Pagamento</h3>
    </div>
    <div class="main-content">
        <div class="payment row">
            <div class="payment-info col-md-5">
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
            @if(empty($budget['payment']))
            <div class="payment-methods col-md-7">
                <h6 class="mb-3">Selecione o meio de pagamento</h6>
                <div class="payment-methods-options mb-3">
                    <button class="btn btn-dark" id="card"><i class="fa fa-credit-card"></i> Cartão de Crédito</button>
                    <button class="btn btn-dark" id="pix"><i class="fab fa-pix"></i> PIX</button>
                </div>

                <div class="payment-card d-none">
                    <p>Preencha com os dados do seu cartão para pagamento</p>
                    <small>Não guardamos nenhum dado de pagamento. Todas as suas informações estão seguras.</small>
                    <form action="{{route('budgets.checkout')}}" method="POST" class="form">
                        <input type="hidden" name="payMethod" value="credit_card" />
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
                                <label for="cvv">CVV</label>
                            </div>
                            <div class="form-input">
                                <select name="exp_month" id="exp_month" required>
                                    @for($i = 1; $i < 13; $i++)
                                    <option value="{{$i}}">{{$i}} - {{ Str::ucfirst(Carbon\Carbon::create()->month($i)->locale('pt_BR')->monthName)}}</option>
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
                            <div class="form-input">
                                <select name="installments" id="installments" required>
                                    <option value="1" selected>À Vista</option>
                                    @if($budget['amount'] >= 500)
                                    <option value="2">2x </option>
                                    <option value="3">3x </option>
                                    @elseif($budget['amount'] >= 200 && $budget['amount'] <= 300)
                                    <option value="2">2x </option>
                                    @endif
                                </select>
                                <label for="installments">Parcelas</label>
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

                <div class="payment-pix {{ !session()->get('pix') ? 'd-none' : null}}">
                    <form action="{{route('budgets.checkout')}}" method="POST" class="form {{ session()->get('pix') ? 'd-none' : null}}">
                        @csrf
                        <input type="hidden" name="payMethod" value="pix" />
                        <input type="hidden" name="answerId" value="{{$budget['id']}}" />
                        <div class="btn-group">
                            <button type="submit">Pagar <i class="fab fa-pix"></i></button>
                        </div>
                    </form>
                    <div class="row {{ !session()->get('pix') ? 'd-none' : null}}">
                        <div class="col-12 text-center">
                            <h6>Aponte o aplicativo do seu banco para realizar o pagamento</h6>
                            <img src="https://place-hold.it/200x200?text=PIX" alt="" class="qr_img img-fluid mt-2">
                        </div>
                        <div class="col-12 mt-5">
                            <input class="form-control qr_code" onclick="copyQR()" />
                            <div class="alert alert-success mt-2 pixAlert d-none" role="alert">
                                <i class="fa fa-check"></i>  Copiado!
                            </div>
                        </div>
                        <div class="col-12 mt-1 text-center">
                            <p>Após realizar o pagamento, clique no botão abaixo para finalizar a compra *</p>
                            <form action="{{route('budgets.pix')}}" method="POST">
                                @csrf
                                <input type="text" name="answer_id" value="{{$budget['id']}}" readonly class="d-none" />
                                <input type="text" name="amount" value="{{$budget['amount']}}" readonly class="d-none" />
                                <input type="text" name="code" id="paycode" value="" readonly class="d-none" />
                                <button class="btn btn-formulaja mx-auto my-2" type="submit">Finalizar pagamento</button>
                            </form>
                            <small>* Sujeito a aprovação de pagamento</small>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($budget['payment']['status'] == 'paid')
            <div class="col-7 aproving">
            <h6 class="text-muted"><i class="fa fa-check text-success"></i> Pagamento Confirmado!</h6>
            </div>
            @else
            <div class="col-7 aproving">
                <h6 class="text-muted"><i class="fa fa-spin fa-spinner"></i> Aguardando confirmação de pagamento</h6>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection

@if(empty($budget['budget']['payment']))
@section('extraJS')
@if(session()->get('pix'))
<script type="text/javascript">
    $('.qr_code').val("{{session()->get('pix.qr_code')}}");
    $('.qr_img').attr("src","{{session()->get('pix.qr_image')}}");
    $('#paycode').val("{{session()->get('pix.code')}}");
</script>
@endif
<script type="text/javascript">
    $('#card').on('click', function(e) {
        e.preventDefault();
        $('.payment-card').removeClass('d-none');
        $('.payment-pix').addClass('d-none');
    });
    $('#pix').on('click', function(e) {
        e.preventDefault();
        $('.payment-card').addClass('d-none');
        $('.payment-pix').removeClass('d-none');
    });
</script>
@endsection
@endif
