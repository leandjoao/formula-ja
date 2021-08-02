@extends('layouts.auth', ['text' => 'Para entrar utilize as credenciais que você utilizou no cadastro ou recebeu em seu e-mail.'])
@section('content')
<form action="{{ route('login') }}" method="POST" class="auth-form">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required />
    <input type="password" name="password" placeholder="Senha" required />
    <button>Entrar</button>
    <a href="{{ route('password.request') }}">Recuperar minha senha</a>
    <a href="{{ route('register') }}">Fazer cadastro</a>
</form>
@endsection
