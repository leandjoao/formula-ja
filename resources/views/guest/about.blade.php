@extends('layouts.guest')
@section('content')
<section class="pages-header about" style="background-image: linear-gradient(-18deg, rgba(251, 208, 66, 0.4), rgba(252, 213, 86, 0.4) 80%), url({{asset('storage/paginas/about/'.$dataPage['img_banner'])}});">
    <div class="pages-header-title">
        <h2>{{$dataPage['title_banner']}}</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-image">
        <img src="{{asset('storage/paginas/about/'.$dataPage['img_about'])}}" alt="">
    </div>
    <div class="pages-content-text">
        <p>{!!$dataPage['txt_about']!!}</p>
    </div>
</section>
<section class="team" style="background-image: url({{asset('storage/paginas/about/'.$dataPage['img_equipe'])}});">
    <div class="team-container">
        <div class="team-container-text">
            <h4>{{$dataPage['title_equipe']}}</h4>
            <p><p>{!!$dataPage['txt_equipe']!!}</p></p>
        </div>
    </div>
</section>

@if(!empty($partners))
@include('components.parceiros', ['title_parceiros' => $dataPage['title_parceiros'] ?? 'Conheça os nossos parceiros'])
@endif

@endsection
