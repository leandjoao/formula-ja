<h5>Redes Sociais</h5>
<div class="block-social-links">
    {{-- @foreach($sm as $media) --}}
    {{-- <a href="{{$media['link']}}" target="_blank"><i class="{{$media['media']}}"></i></a> --}}
    
    @if ($getInfo->facebook != "")
        <a href="{{$getInfo->facebook}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
    @endif
    @if ($getInfo->instagram != "")
        <a href="{{$getInfo->instagram}}" target="_blank"><i class="fab fa-instagram"></i></a>
    @endif
    @if ($getInfo->linkedin != "")
        <a href="{{$getInfo->linkedin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
    @endif
    @if ($getInfo->twitter != "")
        <a href="{{$getInfo->twitter}}" target="_blank"><i class="fab fa-twitter-in"></i></a>
    @endif
    @if ($getInfo->youtube != "")
        <a href="{{$getInfo->youtube}}" target="_blank"><i class="fab fa-youtube-in"></i></a>
    @endif
    {{-- @endforeach --}}
</div>
