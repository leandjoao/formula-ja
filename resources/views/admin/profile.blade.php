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
            <li class="profile-navlist-item password">Senha</li>
            <li class="profile-navlist-item address">Endereço</li>
            <li class="profile-navlist-item delete">Deletar minha conta</li>
        </ul>

        <section class="profile-context">
            <div class="profile-context-section active" id="account">
                <div class="profile-context-section-header">
                    <small>Informações</small>
                </div>
                <div class="profile-context-section-content">
                    <div class="profile-context-section-content-form">
                        <form action="{{ route('profile.update')}}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}" required />
                                    <label for="name">Nome:</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="email" name="email" id="email" value="{{Auth::user()->email}}" required />
                                    <label for="email">E-mail:</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="phone" id="phone" value="{{Auth::user()->phone}}" required />
                                    <label for="phone">Telefone:</label>
                                </div>
                            </div>
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="profile-context-section-content-picture">
                        <img class="change" src="@if(empty(Auth::user()->avatar)) {{asset('storage/icons/user.png')}} @else {{asset('storage/avatar/' . Auth::user()->avatar)}} @endif" alt="Foto de {{Auth::user()->name}}">
                        <form action="{{route('profile.picture')}}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf
                            <input type="file" name="file" id="profile" accept=".png, .jpg, .jpeg" class="hidden">
                            <label for="profile">Alterar foto</label>
                            <small>Para melhor exibição, utilize fotos no tamanho <strong>128px x 128px</strong></small>
                        </form>
                    </div>
                </div>
            </div>

            <div class="profile-context-section" id="password">
                <div class="profile-context-section-header">
                    <small>Alterar Senha</small>
                </div>
                <div class="profile-context-section-content">
                    <div class="profile-context-section-content-form">
                        <form action="{{route('profile.password')}}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="password" name="old_pass" id="old_pass" required />
                                    <label for="old_pass">Senha atual:</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="password" name="new_pass" id="new_pass" required />
                                    <label for="new_pass">Senha nova:</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="password" name="new_pass_confirmation" id="new_pass_confirm" required />
                                    <label for="new_pass_confirm">Confirme a nova senha:</label>
                                </div>
                            </div>

                            <button type="submit">Alterar senha</button>
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
                        <form action="{{ route('profile.address') }}" method="POST" class="form">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="cep" id="zipCode" value="{{Auth::user()->zipCode}}" required />
                                    <label for="zipCode">CEP:</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="address" id="address" required />
                                    <label for="address">Rua: </label>
                                </div>
                            </div>
                            <div class="form-group">
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
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="state" id="state" required />
                                    <label for="state">Estado: </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="number" id="number" required />
                                    <label for="number">Número: </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="complement" id="complement" />
                                    <label for="complement">Complemento: </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" name="reference" id="reference" />
                                    <label for="reference">Ponto de Referência: </label>
                                </div>
                            </div>

                            <button type="submit">Salvar Endereço</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="profile-context-section" id="delete">
                <div class="profile-context-section-header">
                    <small>Deletar conta</small>
                </div>
                <div class="profile-context-section-content">
                    <div class="profile-context-section-content-text">
                        <p><strong>Atenção!</strong></p>
                        <p>Ao clicar em deletar a conta, você apagará todos as informações pertencentes a sua conta, mas os dados não serão removidos, assim como está explicito na sessão de <a href="{{route('guest.privacidade')}}">politicas de privacidade</a></p>

                        <form action="{{route('profile.remove')}}" class="form" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="password" id="deleteAccount" name="password" required />
                                    <label for="deleteAccount">Insira sua senha</label>
                                </div>
                            </div>
                            <button type="submit">Apagar minha conta</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
@endsection
