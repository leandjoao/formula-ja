@extends('layouts.guest')
@section('content')
<section class="pages-header" style="background-image: linear-gradient(-18deg, rgba(251, 208, 66, 0.4), rgba(252, 213, 86, 0.4) 80%), url({{asset('storage/paginas/faq/'.$dataPage['img_banner'])}});">
    <div class="pages-header-title">
        <h2>{{$dataPage['title_banner']}}</h2>
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
