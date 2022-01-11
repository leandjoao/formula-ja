@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Perfil</h3>
    </div>

    <div class="main-content profile">
        <ul class="profile-navlist">
            <li class="profile-navlist-title">Configurações</li>
            <li class="profile-navlist-item account">Conta</li>
            <li class="profile-navlist-item address">Endereço</li>
        </ul>

        <section class="profile-context">
            <div class="profile-context-section active" id="account">
                <div class="profile-context-section-header">
                    <small>Informações de {{$pharmacy['name']}}</small>
                </div>
                <div class="profile-context-section-content">
                    <div class="profile-context-section-content-form">
                        <form action="{{ route('profile.update.partner')}}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="name" name="name" value="{{$pharmacy['name']}}" required />
                                    <label for="name">Nome:</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <select name="pet" id="pet" required>
                                        <option value="1" {{ boolval($pharmacy['pet']) ? "selected" : '' }}>Sim</option>
                                        <option value="0" {{ boolval($pharmacy['pet']) ? "" : 'selected' }}>Não</option>
                                    </select>
                                    <label for="pet">PET:</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="phone" id="phone" value="{{$pharmacy['phone']}}" required />
                                    <label for="phone">Telefone:</label>
                                </div>
                            </div>
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="profile-context-section-content-picture">
                        <img class="change" src="@if(empty($pharmacy['logo'])) {{asset('storage/icons/user.png')}} @else {{asset('storage/partners/' . $pharmacy['logo'])}} @endif" alt="Foto de {{Auth::user()->name}}">
                        <form action="{{route('profile.update.logo')}}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf
                            <input type="file" name="file" id="profile" accept=".png, .jpg, .jpeg" class="hidden">
                            <label for="profile">Alterar foto</label>
                            <small>Para melhor exibição, utilize fotos no tamanho <strong>128px x 128px</strong></small>
                        </form>
                    </div>
                </div>
            </div>

            <div class="profile-context-section" id="address">
                <div class="profile-context-section-header">
                    <small>Alterar Endereço</small>
                </div>
                <div class="profile-context-section-content">
                    <div class="profile-context-section-content-form">
                        <form action="{{ route('profile.update.address') }}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="cep" id="zipCode" value="{{$pharmacy['zip_code'] ?? "" }}" required />
                                    <label for="zipCode">CEP:</label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="address" id="address" value="{{$pharmacy['street'] ?? "" }}" required />
                                    <label for="address">Rua: </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="neighborhood" id="neighborhood" value="{{$pharmacy['neighborhood'] ?? "" }}" required />
                                    <label for="neighborhood">Bairro: </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="city" id="city" value="{{$pharmacy['city'] ?? "" }}" required />
                                    <label for="city">Cidade: </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="state" id="state" value="{{$pharmacy['state'] ?? "" }}" required />
                                    <label for="state">Estado: </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="number" id="number" value="{{$pharmacy['number'] ?? "" }}" required />
                                    <label for="number">Número: </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="complement" id="complement" value="{{$pharmacy['complement'] ?? "" }}" />
                                    <label for="complement">Complemento: </label>
                                </div>
                                <div class="form-input">
                                    <input type="text" name="reference" id="reference" value="{{$pharmacy['reference'] ?? "" }}" />
                                    <label for="reference">Ponto de Referência: </label>
                                </div>
                            </div>

                            <button type="submit">Salvar Endereço</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
