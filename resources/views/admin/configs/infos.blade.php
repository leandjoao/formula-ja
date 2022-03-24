@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar textos :: Outros Textos</h3>
    </div>
    <form action="{{route('texts.infos.save')}}" class="form" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="create">
            <div class="create-form">
                <div class="container">
                    <div class="py-2">
                        <h5>Contato</h5>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="contact_text" name="contact_text" value="{{$extra->contact_text}}" required>
                                    <label for="contact_text">Texto &nbsp;<small class="text-muted">(Texto ao lado do formulário)</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        @foreach ($contacts as $contact)
                        <div class="col-4">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="contact-{{$contact->id}}" name="contact[{{$contact->id}}]" value="{{$contact->value}}" required>
                                    <label for="contact-{{$contact->id}}"><i class="{{$contact->type}}"></i> &nbsp; {{$contact->label}}</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="create">
            <div class="create-form">
                <div class="container">
                    <div class="py-2">
                        <h5>Redes Sociais</h5>
                    </div>
                    <div class="row mt-4">
                        @foreach ($sm as $social)
                        <div class="col-4">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="social-{{$social->id}}" name="social[{{$social->id}}]" value="{{$social->link}}" required>
                                    <label for="social-{{$social->id}}"><i class="{{$social->media}}"></i></label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="create">
            <div class="create-form">
                <div class="container">
                    <div class="py-2">
                        <h5>Texto de Call to Action <small class="text-muted">(Barra amarela antes do rodapé)</small></h5>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="cta" name="cta" value="{{$extra->cta}}" required>
                                    <label for="cta">Texto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="create">
            <div class="create-form">
                <div class="container">
                    <div class="py-2">
                        <h5>Texto de Quem Somos</h5>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="about_us_text" name="about_us_text" value="{{$extra->about_us_text}}" required>
                                    <label for="about_us_text">Texto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="file" id="about_us_image" name="about_us_image">
                                    <label for="about_us_image">Alterar Imagem</label>
                                    <small class="text-danger">Dimensões: 1150x1720 ou 1920x1080 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6>Imagem Atual</h6>
                            <img src="{{asset('storage/team.jpeg')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="create">
            <div class="create-form">
                <div class="container">
                    <div class="py-2">
                        <h5>Texto de Time</h5>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="text" id="team_text" name="team_text" value="{{$extra->team_text}}" required>
                                    <label for="team_text">Texto</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-input">
                                    <input type="file" id="team_image" name="team_image">
                                    <label for="team_image">Alterar Imagem</label>
                                    <small class="text-danger">Dimensões: 1920x1080 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6>Imagem Atual</h6>
                            <img src="{{asset('storage/team-banner.jpg')}}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-formulaja">Salvar <i class="fa fa-save"></i></button>
    </form>
</div>
@endsection
