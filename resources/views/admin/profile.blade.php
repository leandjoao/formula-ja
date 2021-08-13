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
                        <form action="" class="form">
                            <input type="text" placeholder="Nome" value="{{Auth::user()->name}}" />
                            <input type="email" placeholder="E-mail" value="{{Auth::user()->email}}" />
                            <input type="text" placeholder="Telefone" value="{{Auth::user()->phone}}" />
                            <button type="submit">Salvar</button>
                        </form>
                    </div>
                    <div class="profile-context-section-content-picture">
                        <img src="@if(empty(Auth::user()->profile)) {{asset('storage/icons/user.png')}} @else {{asset('storage/users/' . Auth::user()->profile)}} @endif" alt="Foto de {{Auth::user()->name}}">
                        <form action="" class="form">
                            <input type="file" name="profile" id="profile" accept=".png, .jpg, .jpeg" class="hidden">
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
                        <form action="" class="form">
                            <input type="password" name="old_pass" placeholder="Senha atual">
                            <input type="password" name="new_pass" placeholder="Senha nova">
                            <input type="password" name="confirm_new_pass" placeholder="Confirme a nova senha">
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
                        <form action="" class="form">
                            <input type="text" name="cep" placeholder="CEP" value="{{Auth::user()->zipCode}}">
                            <input type="text" name="address" placeholder="Rua">
                            <input type="text" name="neighborhood" placeholder="Bairro">
                            <input type="text" name="city" placeholder="Cidade">
                            <input type="text" name="state" placeholder="Estado">
                            <input type="text" name="number" placeholder="Número">
                            <input type="text" name="complement" placeholder="Complemento">
                            <input type="text" name="reference" placeholder="Ponto de Referência">
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

                        <form action="" class="form">
                            <input type="password" placeholder="Insira sua senha">
                            <button type="submit">Apagar minha conta</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
@endsection
