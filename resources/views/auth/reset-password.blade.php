
@extends('layouts.auth', ['text' => 'Cadastre sua nova senha'])
@section('content')
<form action="{{ route('password.update') }}" method="POST" class="auth-form">
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    @csrf
    @error('email')
        <small>Usuário inválido</small>
    @enderror
    <input @error('email') class="invalid" @enderror type="email" name="email" placeholder="E-mail" value="{{$request->email}}" required autofocus />
    <input @error('password') class="invalid" @enderror type="password" name="password" placeholder="Senha" required />
    <input @error('password_confirmation') class="invalid" @enderror type="password" name="password_confirmation" placeholder="Confirme a senha" required />
    <button>Alterar senha</button>
</form>
@endsection
