@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar textos :: Home</h3>
    </div>
    <form action="{{route('texts.home.save')}}" class="form" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach ($data['banner'] as $banner)
        <div class="main-content">
            <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Texto do Banner @if($banner['isPet']) &mdash; PET @endif</h4>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="banner-{{$banner['id']}}" name="banner[{{$banner['id']}}][super_text]" value="{{$banner['super_text']}}" required>
                                        <label for="banner-{{$banner['id']}}"> @if($banner['isPet'])<i class='fa fa-paw'></i> &nbsp;@endif Sobre texto</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="slogan-{{$banner['id']}}" name="banner[{{$banner['id']}}][slogan]" value="{{$banner['slogan']}}" required>
                                        <label for="slogan-{{$banner['id']}}">@if($banner['isPet'])<i class='fa fa-paw'></i> &nbsp;@endif Slogan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="text-{{$banner['id']}}" name="banner[{{$banner['id']}}][under_text]" value="{{$banner['under_text']}}" required>
                                        <label for="text-{{$banner['id']}}">@if($banner['isPet'])<i class='fa fa-paw'></i> &nbsp;@endif Texto após slogan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="file" id="image-{{$banner['id']}}" name="banner[{{$banner['id']}}][image]">
                                        <label for="image-{{$banner['id']}}">@if($banner['isPet'])<i class='fa fa-paw'></i> &nbsp;@endif Alterar Banner</label>
                                        <small class="text-danger">Dimensões: 1920x1080 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6>Imagem Atual</h6>
                                @if($banner['isPet'])
                                <img src="{{asset('storage/background-pet.jpeg')}}" alt="" class="img-fluid">
                                @else
                                <img src="{{asset('storage/background.jpg')}}" alt="" class="img-fluid">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

            <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Textos de Como Funciona</h5>
                        </div>
                        <div class="row mt-4">
                            @foreach ($data['hiw'] as $hiw)
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="hiw-title-{{$hiw['id']}}" name="hiw[{{$hiw['id']}}][title]" value="{{$hiw['title']}}" required>
                                        <label for="hiw-title-{{$hiw['id']}}"> Título</label>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <div class="form-input">
                                        <textarea id="hiw-text-{{$hiw['id']}}" name="hiw[{{$hiw['id']}}][text]" class="form-control" rows="5">{{$hiw['text']}}</textarea>
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
                            <h5>Texto de Por que nós</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="et-title-{{$data['wu']['id']}}" name="wu[title]" value="{{$data['wu']['title']}}" required>
                                        <label for="et-title-{{$data['wu']['id']}}">Título</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="wu-under-{{$data['wu']['id']}}" name="wu[under_title]" value="{{$data['wu']['under_title']}}" required>
                                        <label for="wu-under-{{$data['wu']['id']}}">Subtítulo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{-- <textarea id="wu-text-{{$data['wu']['id']}}" name="wu[text]" class="form-control" rows="5" required>{{$data['wu']['text']}}</textarea> --}}
                                        <textarea id="wu-text-{{$data['wu']['id']}}" name="wu[text]" class="form-control" rows="5" required>
                                            {{$data['wu']['text']}}
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="file" id="wu-image" name="wu[image]">
                                        <label for="wu-image">Alterar Imagem</label>
                                        <small class="text-danger">Dimensões: 1150x1720 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Texto de FAQ</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="et-title" name="et[faq_title]" value="{{$data['et']['faq_title']}}" required>
                                        <label for="et-title">Título</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        <input type="text" id="et-under" name="et[faq_text]" value="{{$data['et']['faq_text']}}" required>
                                        <label for="et-under">Subtítulo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-formulaja">Salvar <i class="fa fa-save"></i></button>
        </div>
    </form>
</div>
@endsection
@section('extraJS')
<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // CKEDITOR.replace('about_us_text', {
        //         toolbar: [
        //             { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
        //             { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
        //         ]
        //     });
        CKEDITOR.replace('wu-text-{{$data['wu']['id']}}', {
                toolbar: [
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                ]
            });
    });
</script>
@endsection
