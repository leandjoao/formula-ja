@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Parceiros :: Criar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('partners.create.save')}}" class="form" method="POST" enctype="multipart/form-data" id="address">
                    @csrf
                    <div class="form-group">
                        <p><strong>Informações Iniciais</strong></p>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input id="name" name="name" type="text" required />
                            <label class="label" for="name">Nome</label>
                        </div>
                        <div class="form-input">
                            <input id="phone" name="phone" type="text" data-mask="(00) 90000-0000" required />
                            <label class="label" for="phone">Telefone</label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="cnpj" id="partnerId" data-mask="00.000.000/0000-00" id="cnpj" />
                            <label for="cnpj">CNPJ:</label>
                        </div>
                        <div class="form-input">
                            <select name="pet" id="pet">
                                <option value="1">Sim</option>
                                <option value="0" selected>Não</option>
                            </select>
                            <label class="label" for="pet">PET?</label>
                        </div>
                        <div class="form-input">
                            <input id="logo" name="logo" type="file" required accept="image/png, image/jpg, image/jpeg" />
                            <label class="label" for="logo">Logo</label>
                            <small class="text-danger">Dimensões: 230x60 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="cep" data-mask="00000-000" id="zipCode" required />
                            <label for="zipCode">CEP:</label>
                        </div>
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
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" name="city" id="city" required />
                            <label for="city">Cidade: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="state" id="state" required />
                            <label for="state">Estado: </label>
                        </div>
                        <div class="form-input">
                            <input type="text" name="complement" id="complement" />
                            <label for="complement">Complemento: </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" list="users" name="owner" id="owner" required />
                            <label for="owner">CPF do Responsável: </label>

                            <datalist id="users">
                                @foreach ($users as $user)
                                    <option value="{{$user['cpf']}}" label="{{$user['name']}}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <div class="form-group">
                        <p><strong>Informações Bancárias</strong></p>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <div class="form-input">
                                <input list="banks" type="text" name="cod_bank" id="bank" required>
                                <label for="bank">Código do Banco: </label>

                                <datalist id="banks">
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank['code']}}" label="{{$bank['label']}}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <input type="text" name="branch" id="branch" data-mask="0009" required />
                                <label for="branch">Agência: </label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="branch_check_digit" id="branch_check_digit" data-mask="9" />
                                <label for="branch_check_digit">Dígito: </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <input type="text" name="account_number" id="account_number" data-mask="9999999999999" required />
                                <label for="account_number">Número da conta: </label>
                            </div>
                            <div class="form-input">
                                <input type="text" name="account_check_digit" id="account_check_digit" data-mask="99" />
                                <label for="account_check_digit">Dígito da conta: </label>
                            </div>
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
