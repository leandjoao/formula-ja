@extends('layouts.guest')
@section('content')
<section class="pages-header privacidade">
    <div class="pages-header-title">
        <h2>Politicas de Privacidade</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-text">
        <h4>{{ config('app.name') }}</h4>
        <p><strong>Este aviso de privacidade foi atualizado pela última vez em {{ Carbon\Carbon::parse($privacy->created_at)->locale('pt_BR')->isoFormat('LLL') }}</strong></p>
        {!! $privacy->privacy !!}
        <p><strong>Este aviso de privacidade foi atualizado pela última vez em {{ Carbon\Carbon::parse($privacy->created_at)->locale('pt_BR')->isoFormat('LLL') }}</strong></p>
    </div>
</section>
@endsection
