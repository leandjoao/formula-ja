@extends('layouts.guest')
@section('content')
<div class="enviar">
    <div class="hiw">
        <div class="hiw-title">
            <h4>Como funciona?</h4>
        </div>
        <div class="hiw-container">
            <div class="hiw-container-step">
                <img src="{{asset('storage/icons/upload.png')}}" alt="">
                <p>Envio da Receita</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
            </div>
            <div class="hiw-container-step">
                <img src="{{asset('storage/icons/budget.png')}}" alt="">
                <p>Orçamento</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
            </div>
            <div class="hiw-container-step">
                <img src="{{asset('storage/icons/payment.png')}}" alt="">
                <p>Pagamento</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
            </div>
            <div class="hiw-container-step">
                <img src="{{asset('storage/icons/manipulate.png')}}" alt="">
                <p>Manipulação</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
            </div>
            <div class="hiw-container-step">
                <img src="{{asset('storage/icons/deliver.png')}}" alt="">
                <p>Envio do produto</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula egestas.</span>
            </div>
        </div>
    </div>
    <div class="enviar-container">
        <form action="" class="enviar-container-steps">
            @csrf
            <div class="enviar-container-steps-step" id="passo-1">
                <div class="enviar-container-steps-step-header">
                    <h3>1. Identificação</h3>
                    <p>Preencha com seus dados</p>
                </div>
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="text" id="name" name="name" value="{{Auth::user()->name}}" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="email" id="email" name="email" value="{{Auth::user()->email}}" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}" readonly />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="zipCode" name="zipCode" placeholder="CEP" autofocus />
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
                </div>
            </div>
            <div class="enviar-container-steps-step inativo" id="passo-2">
                <div class="enviar-container-steps-step-header">
                    <h3>2. Detalhes</h3>
                    <p>Confirme os dados de entrega</p>
                </div>
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="checkbox" id="sameInfo" name="sameInfo" />
                        <label for="sameInfo">Usar o mesmo endereço anterior</label>
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingName" name="shippingName" placeholder="Destinatário" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingPhone" name="shippingPhone" placeholder="Telefone do destinatário" />
                    </div>
                    <div class="enviar-input">
                        <input type="text" id="shippingZipCode" name="shippingZipCode" @empty(Auth::user()->zipCode) onblur="getAddress(this.value)" @endempty placeholder="CEP" />
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
            </div>
            <div class="enviar-container-steps-step inativo" id="passo-3">
                <div class="enviar-container-steps-step-header">
                    <h3>3. Enviar</h3>
                    <p>Anexe a sua receita abaixo</p>
                </div>
                <div class="enviar-container-steps-step-inputs">
                    <div class="enviar-input">
                        <input type="file" id="file" name="file" accept=".png, .jpg, .pdf, .jpeg" />
                    </div>
                </div>
                <p>Ao clicar em enviar a sua receita, você aceita e está de acordo com os nossos <a href="{{route('guest.termos')}}">Termos de Uso</a> e <a href="{{route('guest.privacidade')}}">Políticas de Privacidade</a>.</p>
                <button type="submit" class="enviar-buttons submit" disabled>Enviar receita</button>
            </div>

            <input type="checkbox" class="hidden" name="pet" @if(request()->routeIs('guest.receita.pet')) checked @endif>
        </form>
        <div class="enviar-buttons">
            <button class="previous invisible">Voltar</button>
            <button class="next">Avançar</button>
        </div>
    </div>
</div>
@endsection
