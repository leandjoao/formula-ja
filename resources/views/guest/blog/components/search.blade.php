<h5>Buscar</h5>
<form action="{{ route('blog.search') }}" method="POST" class="block-search-form">
    @csrf
    <div class="block-search-form-input">
        <input type="text" name="search" minlength="3" placeholder="Ex.: Categoria, Título do post" required>
        <button type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>
