<h5>Últimos Posts</h5>
<ul class="block-feed-posts">
    @foreach ($lastPosts as $post)
    <li>
        <a href="{{ route('guest.blog.inner', [\Str::slug($post['category']['label']), $post['slug']]) }}">
            <img src="{{asset('storage/blog/'.$post['banner'])}}" alt="{{ $post['title'] }}">
            <span>
                <p>{{ $post['title'] }}</p>
                <small>{{ Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</small>
            </span>
        </a>
    </li>
    @endforeach
</ul>
