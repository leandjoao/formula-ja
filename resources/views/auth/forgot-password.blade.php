@extends('layouts.auth', ['text' => 'Se você deseja resetar sua senha, informe seu e-mail abaixo.'])
@section('content')
<form action="{{ route('password.email') }}" method="POST" class="auth-form">
    @csrf
    @error('email')
        <small>Usuário inválido</small>
    @enderror
    <input @error('email') class="invalid" @enderror type="email" name="email" placeholder="E-mail" required />
    <button>Recuperar senha</button>
    <a href="{{ route('login') }}">Login</a>
</form>
@endsection
