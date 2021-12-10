@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Usuários :: Criar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('users.create.save')}}" class="form" method="POST" enctype="multipart/form-data" id="address">
                    @csrf
                    <div class="form-group">
                        <div class="form-input">
                            <input id="name" name="name" type="text" pattern=".+" required />
                            <label class="label" for="name">Nome</label>
                        </div>
                        <div class="form-input">
                            <input id="email" name="email" type="email" required />
                            <label class="label" for="email">E-mail</label>
                        </div>
                        <div class="form-input">
                            <input id="phone" name="phone" data-mask="(00) 90000-0000" type="text" required />
                            <label class="label" for="phone">Telefone</label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="cpf" data-mask="000.000.000-00" id="cpf" required />
                            <label for="cpf">CPF:</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <select name="pet" id="pet">
                                <option value="1">Sim</option>
                                <option value="0" selected>Não</option>
                            </select>
                            <label class="label" for="pet">PET?</label>
                        </div>
                        <div class="form-input">
                            <select name="pharmacy" id="pharmacy">
                                <option value="3">Sim</option>
                                <option value="2" selected>Não</option>
                            </select>
                            <label class="label" for="pharmacy">Parceiro?</label>
                        </div>
                        <div class="form-input partnerName">
                            <input type="text" name="partnerName" id="partnerName" required />
                            <label for="partnerName">Nome do Estabelecimento:</label>
                        </div>
                        <div class="form-input partnerName">
                            <input type="text" name="cnpj" id="partnerId" data-mask="00.000.000/0000-00" id="cnpj" required />
                            <label for="cnpj">CNPJ:</label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="cep" data-mask="00000-000" id="zipCode" required />
                            <label for="zipCode">CEP:</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="address" id="address" required />
                            <label for="address">Rua: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="number" id="number" required />
                            <label for="number">Número: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="neighborhood" id="neighborhood" required />
                            <label for="neighborhood">Bairro: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="city" id="city" required />
                            <label for="city">Cidade: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="state" id="state" required />
                            <label for="state">Estado: </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="complement" id="complement" />
                            <label for="complement">Complemento: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="reference" id="reference" />
                            <label for="reference">Ponto de Referência: </label>
                        </div>
                    </div>


                    <div class="form-input">
                        <button type="submit">Salvar <i class="fa fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
