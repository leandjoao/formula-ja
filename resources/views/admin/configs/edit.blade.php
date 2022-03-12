@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Configurações :: Editar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('config.save')}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <h6>FAQ e Call to Action</h6>
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="faq_title" value="{{$configs->faq_title}}" name="faq_title" required />
                        <label for="faq_title">Título FAQ</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="faq_text" value="{{$configs->faq_text}}" name="faq_text" required />
                        <label for="faq_text">Texto FAQ</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="cta" value="{{$configs->cta}}" name="cta" required />
                        <label for="cta">Texto Call to Action (Barra antes do rodapé)</label>
                    </div>
                </div>

                <h6>Quem Somos</h6>
                <div class="form-group">
                    <div class="form-input">
                        <textarea name="about_us_text" id="about_us_text" class="form-control" rows="7">{{$configs->about_us_text}}</textarea>
                    </div>
                    <div class="form-input">
                        <input type="file" id="about_us_image" accept="image/png, image/jpg, image/jpeg" name="about_us_image" />
                        <label for="about_us_image">Imagem do Quem Somos</label>
                    </div>
                </div>

                <h6>Time</h6>
                <div class="form-group">
                    <div class="form-input">
                        <textarea name="team_text" id="team_text" class="form-control" rows="7">{{$configs->team_text}}</textarea>
                    </div>
                    <div class="form-input">
                        <input type="file" id="team_image" accept="image/png, image/jpg, image/jpeg" name="team_image" />
                        <label for="team_image">Imagem do Time</label>
                    </div>
                </div>

                <h6>Contato</h6>
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="contact_text" value="{{$configs->contact_text}}" name="contact_text" required />
                        <label for="contact_text">Texto Contato</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
