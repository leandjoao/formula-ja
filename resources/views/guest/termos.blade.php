@extends('layouts.guest')
@section('content')
<section class="pages-header termos">
    <div class="pages-header-title">
        <h2>Termos de Uso</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-text">
        {!! $terms->terms !!}
        <div class="pages-content-text-footer">
            <strong>Endereço Postal</strong>
            <p>{{config('app.name')}}</p>
            <p>{{config('app.address.street')}}, {{config('app.address.number')}} - {{config('app.address.neighborhood')}}</p>
            <p>{{config('app.address.city')}} - {{config('app.address.state')}}</p>
            <p>Endereço de e-mail: <a href="mailto:{{config('app.contact')}}">{{config('app.contact')}}</a></p>
        </div>
    </div>
</section>
@endsection
