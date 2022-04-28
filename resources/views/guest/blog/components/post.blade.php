<div class="post">
    <div class="post-image">
        <img src="{{asset('storage/blog/'.$post['banner'])}}" alt="{{$post['title']}}">
    </div>
    <div class="post-text">
        <h4>{{ $post['title']}} </h4>
        <p>{!! strip_tags(Str::limit($post['content'], 100, '...')) !!}</p>
        <div class="post-text-footer">
            <small>{{ Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</small>
            <a href="{{ route('guest.blog.inner', [\Str::slug($post['category']['label']), $post['slug']]) }}">Ler Mais <i class="fas fa-long-arrow-alt-right"></i></a>
        </div>
    </div>
</div>
