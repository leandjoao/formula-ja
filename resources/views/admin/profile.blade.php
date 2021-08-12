@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Perfil</h3>
    </div>

    <div class="main-content">
        <ul class="profile-navlist">
            <li class="profile-navlist-title">Configurações</li>
            <li class="profile-navlist-item account active">Conta</li>
            <li class="profile-navlist-item password">Senha</li>
            <li class="profile-navlist-item notifications">Notificações</li>
            <li class="profile-navlist-item delete">Deletar minha conta</li>
        </ul>

        <section class="profile-form">
            <div class="profile-form-header">
                <small>Informações</small>
            </div>
            <div class="profile-form-content">
                <form action="" class="form">
                    <input type="text" placeholder="{{Auth::user()->name}}" />
                    <input type="email" placeholder="{{Auth::user()->email}}" />
                    <input type="text" placeholder="{{Auth::user()->phone}}" />
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
