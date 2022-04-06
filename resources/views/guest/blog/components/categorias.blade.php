<h5>Categorias</h5>
<ul class="block-categories-list">
    @foreach ($categorias as $categoria )
    <li>
        <a href="{{ route('guest.blog.category', $categoria['slug']) }}">{{ $categoria['label'] }}</a>
        <p>({{ $categoria['posts_count'] }})</p>
    </li>
    @endforeach
</ul>
