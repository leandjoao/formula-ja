<form action="{{ route('send.receipt') }}" class="modal-pet form" method="POST" enctype="multipart/form-data">
    <div class="modal-pet-header">
        <h3>Envie a receita do seu pet!</h3>
        <p>Lorem ipsum</p>
    </div>
    @if($errors->any())
    <ul class="errors">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif
    <div class="modal-pet-input">
        <div class="form-input">
            @csrf
            <input class="@error('name') invalid @endif" type="text" placeholder="Seu nome" name="name" required />
            <input class="@error('email') invalid @endif" type="email" placeholder="Seu e-mail" name="email" required />
            <input class="@error('phone') invalid @endif" type="text" placeholder="Seu telefone" name="phone" required />
            <input class="@error('file') invalid @endif" type="file" name="file" accept=".png, .jpg, .pdf, .jpeg" required />
            <input type="checkbox" name="pet" checked class="hidden">
            <button type="submit">Enviar &nbsp;<i class="fas fa-paw"></i></button>
        </div>
    </div>
</form>
