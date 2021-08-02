@extends('layouts.guest')
@section('content')
<section class="pages-header">
    <div class="pages-header-title">
        <h2>Sobre nós</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-image">
        <img src="{{asset('storage/team.jpeg')}}" alt="">
    </div>
    <div class="pages-content-text">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium est at risus placerat viverra. Nam ut blandit odio, nec condimentum eros. Phasellus nulla felis, laoreet in ipsum vitae, congue vulputate tortor. Aenean nulla nibh, rhoncus nec sem in, luctus eleifend lorem. Etiam pulvinar, mauris at iaculis suscipit, lectus neque auctor nunc, ac placerat magna lacus quis enim. Integer volutpat mauris eget nunc commodo, ac pharetra urna varius. Aenean et mi non justo aliquet interdum in ac dolor.
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium est at risus placerat viverra. Nam ut blandit odio, nec condimentum eros. Phasellus nulla felis, laoreet in ipsum vitae, congue vulputate tortor. Aenean nulla nibh, rhoncus nec sem in, luctus eleifend lorem. Etiam pulvinar, mauris at iaculis suscipit, lectus neque auctor nunc, ac placerat magna lacus quis enim. Integer volutpat mauris eget nunc commodo, ac pharetra urna varius. Aenean et mi non justo aliquet interdum in ac dolor.
        </p>
    </div>
</section>
<section class="team">
    <div class="team-container">
        <div class="team-container-title">
            <h4>Conheça nossa equipe</h4>
        </div>
        <div class="team-container-members">
            <div class="team-container-members-member">
                <img src="{{asset('storage/icons/user.png')}}" alt="">
                <h4>Nome</h4>
                <p>CEO</p>
            </div>
            <div class="team-container-members-member">
                <img src="{{asset('storage/icons/user.png')}}" alt="">
                <h4>Nome</h4>
                <p>Vice-Presidente</p>
            </div>
        </div>
    </div>
</section>
@include('components.parceiros')
@endsection
