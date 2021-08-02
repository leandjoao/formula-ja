@extends('layouts.auth', ['text' => 'Para criar sua conta informe os dados nos campos abaixo:'])
@section('content')
<form action="{{ route('register') }}" method="POST" class="auth-form">
    @csrf
    <input type="text" name="name" placeholder="Nome" required />
    <input type="text" name="cpf" placeholder="CPF" required />
    <input type="email" name="email" placeholder="E-mail" required />
    <input type="password" name="password" placeholder="Senha" required />
    <input type="password" name="password_confirmation" placeholder="Confirme a senha" required />
    <button>Cadastrar</button>
    <a href="{{ route('login') }}">Já tenho uma conta</a>
</form>
@endsection
