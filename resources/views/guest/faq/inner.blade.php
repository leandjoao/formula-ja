@extends('layouts.guest')
@section('content')
<section class="pages-header">
    <div class="pages-header-title">
        <h2>FAQ :: {{$page}}</h2>
    </div>
</section>
<section class="faq">
    <div class="faq-container">
        <ul class="faq-breadcrumb">
            <div class="faq-breadcrumb-item"><a href="{{route('guest.index')}}">Home</a></div>
            <div class="faq-breadcrumb-item"><a href="{{route('guest.faq')}}">Dúvidas</a></div>
            <div class="faq-breadcrumb-item">{{$page}}</div>
        </ul>

        <div class="faq-collapsible">
            @foreach ($faqs as $faq)
            <div class="faq-collapsible-item">
                <div class="question">
                    <p>{{$faq->question}}</p>
                </div>
                <div class="answer">
                    <p>{{$faq->answer}}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="faq-end">
            <p>Não encontrou o que procurava?</p>
            <a href="{{route('guest.contact')}}">Fale conosco</a>
        </div>
    </div>
</section>
@endsection
