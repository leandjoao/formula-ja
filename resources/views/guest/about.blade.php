@extends('layouts.guest')
@section('content')
<section class="pages-header about">
    <div class="pages-header-title">
        <h2>Sobre nós</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-image">
        <img src="{{asset('storage/team.jpeg')}}" alt="">
    </div>
    <div class="pages-content-text">
        <p>{!!$text->about_us_text!!}</p>
    </div>
</section>
<section class="team">
    <div class="team-container">
        <div class="team-container-text">
            <h4>Conheça nossa equipe</h4>
            <p><p>{{$text->team_text}}</p></p>
        </div>
    </div>
</section>
@include('components.parceiros')
@endsection
