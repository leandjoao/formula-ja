@extends('layouts.auth', ['text' => 'Para criar sua conta informe os dados nos campos abaixo:'])
@section('content')
<form action="{{ route('register') }}" method="POST" class="auth-form">
    @csrf
    @if($errors->any())
        @foreach ($errors as $error)
            <small>{{ $error }}</small>
        @endforeach
    @endif
    <input @error('name') class="invalid" @enderror type="text" name="name" placeholder="Nome" required />
    <input @error('cpf') class="invalid" @enderror type="text" name="cpf" placeholder="CPF" required />
    <input @error('email') class="invalid" @enderror type="email" name="email" placeholder="E-mail" required />
    <input @error('password') class="invalid" @enderror type="password" name="password" placeholder="Senha" required />
    <input @error('password_confirmation') class="invalid" @enderror type="password" name="password_confirmation" placeholder="Confirme a senha" required />
    <button>Cadastrar</button>
    <a href="{{ route('login') }}">Já tenho uma conta</a>
</form>
@endsection
