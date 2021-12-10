@extends('layouts.guest')
@section('content')
<div class="enviar">
    <div class="hiw">
        <div class="hiw-title">
            <h4>Como funciona?</h4>
        </div>
        <div class="hiw-container">
            @foreach($how as $hiw)
            <div class="hiw-container-step">
                @if(request()->routeIs('guest.receita.pet'))
                <img src="{{asset('storage/icons/pet/'.$hiw['icon'])}}" alt="{{$hiw['title']}}">
                @else
                <img src="{{asset('storage/icons/'.$hiw['icon'])}}" alt="{{$hiw['title']}}">
                @endif
                <p>{{$hiw['title']}}</p>
                <span>{{$hiw['text']}}</span>
            </div>
            @endforeach
        </div>
    </div>
    <div class="enviar-container">
        <form action="{{route('send.receipt')}}" class="enviar-container-steps" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="enviar-container-steps-step" id="passo-1">
                <div class="enviar-container-steps-step-header">
                    <h3>1. Identificação</h3>
                    <p>Confirme seus dados</p>
                </div>
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="text" id="name" name="name" value="{{Auth::user()->name}}" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="email" id="email" name="email" value="{{Auth::user()->email}}" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="phone" name="phone" data-mask="(00) 0 0000-0000" value="{{Auth::user()->phone}}" readonly />
                    </div>
                    @if(Auth::user()->address->count() == 0)
                    <div class="enviar-input">
                        <input type="text" id="zipCode" name="zipCode" placeholder="CEP" data-mask="00000-000" autofocus />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="street" placeholder="Rua" name="street" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="neighborhood" placeholder="Bairro" name="neighborhood" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="city" placeholder="Cidade" name="city" readonly />
                        <input type="text" id="state" placeholder="Estado" name="state" readonly />
                        <input type="text" id="number" placeholder="Número" name="number" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="complement" placeholder="Complemento" name="complement" />
                        <input type="text" id="reference" placeholder="Ponto de referencia" name="reference" />
                    </div>
                    @endif
                </div>
            </div>
            <div class="enviar-container-steps-step" id="passo-2">
                <div class="enviar-container-steps-step-header">
                    <h3>2. Detalhes</h3>
                    <p>Confirme os dados de entrega</p>
                </div>
                @if(Auth::user()->address->count() == 0)
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="checkbox" id="sameInfo" name="sameInfo" />
                        <label for="sameInfo">Usar o mesmo endereço anterior</label>
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingName" name="shippingName" placeholder="Destinatário" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingPhone" name="shippingPhone" data-mask="(00) 0 0000-0000" placeholder="Telefone do destinatário" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingZipCode" name="shippingZipCode" onblur="getAddress(this.value)" placeholder="CEP" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingStreet" placeholder="Rua" name="shippingStreet" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingNeighborhood" placeholder="Bairro" name="shippingNeighborhood" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingCity" placeholder="Cidade" name="shippingCity" readonly />
                        <input type="text" id="shippingState" placeholder="Estado" name="shippingState" readonly />
                        <input type="text" id="shippingNumber" placeholder="Número" name="shippingNumber" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingComplement" placeholder="Complemento" name="shippingComplement" />
                        <input type="text" id="shippingReference" placeholder="Ponto de referencia" name="shippingReference" />
                    </div>
                </div>
                @else
                <div class="enviar-container-steps-step-inputs">
                    @foreach(Auth::user()->address as $address)
                    <div class="enviar-container-steps-step-inputs-cards" id="{{$address['id']}}">
                        <label for="endereco-{{$address['id']}}" @if(boolval($address['default'])) class="selected" @endif>
                            <div class="card-group">
                                <input type="radio" id="endereco-{{$address['id']}}" name="defaultAddress" value="{{$address['id']}}" @if(boolval($address['default'])) checked @endif>
                                <p>{{$address['name']}}</p>
                            </div>
                            <small>{{$address['address']}}, {{$address['number']}}, {{$address['neighborhood']}} - {{$address['city']}}/{{$address['state']}} - {{$address['cep']}}</small>
                        </label>
                    </div>
                    @endforeach
                    <a href="{{route('profile')}}" target="_blank" class="enviar-buttons submit">Alterar Endereço</a>
                </div>
                @endif
            </div>
            <div class="enviar-container-steps-step" id="passo-3">
                <div class="enviar-container-steps-step-header">
                    <h3>3. Enviar</h3>
                    <p>Anexe a sua receita abaixo</p>
                </div>
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="file" id="file" name="file" accept=".png, .jpg, .pdf, .jpeg" />
                    </div>
                </div>
                <p>Ao clicar em enviar a sua receita, você aceita e está de acordo com os nossos <a href="{{route('guest.termos')}}" target="_blank">Termos de Uso</a> e <a href="{{route('guest.privacidade')}}" target="_blank">Políticas de Privacidade</a>.</p>
                <button type="submit" class="enviar-buttons submit">Enviar receita</button>
            </div>

            <input type="checkbox" class="hidden" name="pet" @if(request()->routeIs('guest.receita.pet')) checked @endif>
        </form>
    </div>
</div>
@endsection
