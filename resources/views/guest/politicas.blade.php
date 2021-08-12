@extends('layouts.guest')
@section('content')
<section class="pages-header privacidade">
    <div class="pages-header-title">
        <h2>Politicas de Privacidade</h2>
    </div>
</section>
<section class="pages-content">
    <div class="pages-content-text">
        <h4>{{ config('app.name') }}</h4>
        <p><strong>Este aviso de privacidade foi atualizado pela última vez em {{ Carbon\Carbon::now()->locale('pt_BR')->isoFormat('LLL') }}</strong></p>
        @for($i = 0; $i < 5; $i++)
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis congue massa. Pellentesque sollicitudin vestibulum ex eu malesuada. Duis rhoncus in lorem ac egestas. Cras et lorem tincidunt lacus facilisis gravida et quis purus. Maecenas et elit quis orci vehicula malesuada. In aliquam justo eu felis blandit, pellentesque lacinia dolor accumsan. Nam interdum orci ac mauris hendrerit suscipit. Nullam id nunc viverra lectus gravida sagittis. Donec nec vehicula lectus. Nullam quis felis a justo scelerisque luctus. Duis gravida vestibulum massa, vitae pretium purus fringilla sit amet. Etiam feugiat posuere congue. Aenean lectus tortor, molestie quis imperdiet a, hendrerit id enim. Mauris faucibus diam libero, vitae posuere augue eleifend at. Donec nibh neque, finibus eu aliquet eu, imperdiet nec turpis.</p>
        @endfor
        <p><strong>Este aviso de privacidade foi atualizado pela última vez em {{ Carbon\Carbon::now()->locale('pt_BR')->isoFormat('LLL') }}</strong></p>
    </div>
</section>
@endsection
