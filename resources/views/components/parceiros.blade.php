<div class="parceiros">
    <h2>{{$title_parceiros}}</h2>

    <div class="parceiros-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach($partners as $partner)
            <div class="swiper-slide">

                <img src="{{ asset('storage/partners/'.$partner['logo'])}}" alt="{{$partner['name']}}">
            </div>
            @endforeach
        </div>

        <div class="swiper-button-prev parceiros-prev"></div>
        <div class="swiper-button-next parceiros-next"></div>
    </div>

    {{-- <button onclick="toggleModal()">Seja um parceiro</button> --}}
</div>

@section('modal')
<form action="" method="post" class="modal-parceiros">
    <div class="modal-parceiros-header">
        <h3>Seja um parceiro {{config('app.name')}}</h3>
        <p>Preencha o formulário abaixo para entrarmos em contato!</p>
    </div>
    <div class="modal-parceiros-input">
        <input type="text" placeholder="Nome" name="partnerName" required>
        <input type="email" placeholder="E-mail" name="partnerEmail" required>
        <input type="text" placeholder="Empresa" name="partnerBusiness" required>
        <input type="text" placeholder="Telefone" name="partnerPhone" required>
        <textarea name="partnerMessage" rows="4" placeholder="Mensagem" required></textarea>
        <button type="submit">Enviar</button>
    </div>
</form>
@endsection
