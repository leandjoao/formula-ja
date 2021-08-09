@extends('layouts.guest')
@section('content')
<div class="enviar">
    <div class="enviar-container">
        <form action="" class="enviar-container-steps">
            <div class="enviar-container-steps-step" id="passo-1">
                <div class="enviar-container-steps-step-header">
                    <h3>1. Identificação</h3>
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
                        <input type="text" id="zipCode" name="zipCode" @empty(Auth::user()->zipCode) onblur="getAddress(this.value)" @endempty placeholder="CEP" />
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
                </div>
            </div>
            <div class="enviar-container-steps-step inativo" id="passo-2">
                <div class="enviar-container-steps-step-header">
                    <h3>2. Detalhes</h3>
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
                        <input type="text" id="zipCode" name="zipCode" @empty(Auth::user()->zipCode) onblur="getAddress(this.value)" @endempty placeholder="CEP" />
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
                </div>
            </div>
            <div class="enviar-container-steps-step inativo" id="passo-3">
                <div class="enviar-container-steps-step-header">
                    <h3>3. Confirmação</h3>
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
                        <input type="text" id="zipCode" name="zipCode" @empty(Auth::user()->zipCode) onblur="getAddress(this.value)" @endempty placeholder="CEP" />
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
                </div>
            </div>
        </form>
        <div class="enviar-buttons">
            <button class="previous">Voltar</button>
            <button class="next">Avançar</button>
        </div>
    </div>
</div>
@endsection
