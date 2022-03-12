@extends('layouts.guest')
@section('content')
<section class="pages-header">
    <div class="pages-header-title">
        <h2>FAQ</h2>
    </div>
</section>
<section class="faq">
    <div class="faq-container">
        <div class="faq-header">
            <h3>Selecione a categoria da sua dúvida</h3>
        </div>
        <div class="faq-general">
            <a href="{{route('guest.faq') . '/general-user'}}">Dúvidas Gerais &mdash; Usuários</a>
            <a href="{{route('guest.faq') . '/general-partner'}}">Dúvidas Gerais &mdash; Parceiros</a>
        </div>
        <span></span>
        <div class="faq-pet">
            <a href="{{route('guest.faq') . '/pet-user'}}">Dúvidas PET &mdash; Usuários</a>
            <a href="{{route('guest.faq') . '/pet-partner'}}">Dúvidas PET &mdash; Parceiros</a>
        </div>
    </div>
</section>
@endsection
