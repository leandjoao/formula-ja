@extends('layouts.auth', ['text' => 'Para entrar utilize as credenciais que você utilizou no cadastro ou recebeu em seu e-mail.'])
@section('content')
<form action="{{ route('login') }}" method="POST" class="auth-form">
    @csrf
    @if($errors->any())
        <small>Usuário ou senha inválidos</small>
    @endif
    <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" @if($errors->any()) class="invalid" @endif required />
    <input type="password" name="password" @if($errors->any()) class="invalid" @endif placeholder="Senha" required />
    <button>Entrar</button>
    <a href="{{ route('password.request') }}">Recuperar minha senha</a>
    <a href="{{ route('register') }}">Fazer cadastro</a>
</form>
@endsection
