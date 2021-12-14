<h5>Redes Sociais</h5>
<div class="block-social-links">
    @foreach($sm as $media)
    <a href="{{$media['link']}}"><i class="{{$media['media']}}"></i></a>
    @endforeach
</div>
