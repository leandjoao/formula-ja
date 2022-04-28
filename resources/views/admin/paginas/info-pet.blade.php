@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar Página PET</h3>
    </div>
    
    <div class="main-content">
        {{-- <form action="{{route('texts.home.save')}}" class="form" method="POST" enctype="multipart/form-data"> --}}
        {!! Form::model($data, ['route' => ['texts.pet.save'], 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>SEO</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_seo', null,['name' => 'title_seo', 'id' => 'title_seo', 'required' => 'required'])}}
                                        <label for="title_seo">Título SEO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('description_seo', null,['name' => 'description_seo', 'id' => 'description_seo'])}}
                                        <label for="description_seo">Descrição SEO</label>
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
                            <h5>Banner</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('tag_banner', null,['name' => 'tag_banner', 'id' => 'tag_banner', 'required' => 'required'])}}
                                        <label for="tag_banner">Tag</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_banner', null,['name' => 'title_banner', 'id' => 'title_banner', 'required' => 'required'])}}
                                        <label for="title_banner">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_banner', null,['name' => 'subtitle_banner', 'id' => 'subtitle_banner'])}}
                                        <label for="subtitle_banner">Texto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_banner != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/pet/{{$data->img_banner}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_banner" name="img_banner" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_banner">Banner do Topo</label>
                                        <small class="text-danger">Dimensões: 1920x1080 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Como Funciona</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_como_funciona', null,['name' => 'title_como_funciona', 'id' => 'title_como_funciona'])}}
                                        <label for="title_como_funciona">Titulo</label>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cf1', null,['name' => 'title_cf1', 'id' => 'title_cf1'])}}
                                        <label for="title_cf1">Titulo 1</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cf1', null,['name' => 'subtitle_cf1', 'id' => 'subtitle_cf1'])}}
                                        <label for="subtitle_cf1">Subtitulo 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cf2', null,['name' => 'title_cf2', 'id' => 'title_cf2'])}}
                                        <label for="title_cf2">Titulo 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cf2', null,['name' => 'subtitle_cf2', 'id' => 'subtitle_cf2'])}}
                                        <label for="subtitle_cf2">Subtitulo 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cf3', null,['name' => 'title_cf3', 'id' => 'title_cf3'])}}
                                        <label for="title_cf3">Titulo 3</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cf3', null,['name' => 'subtitle_cf3', 'id' => 'subtitle_cf3'])}}
                                        <label for="subtitle_cf3">Subtitulo 3</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cf4', null,['name' => 'title_cf4', 'id' => 'title_cf4'])}}
                                        <label for="title_cf4">Titulo 4</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cf4', null,['name' => 'subtitle_cf4', 'id' => 'subtitle_cf4'])}}
                                        <label for="subtitle_cf4">Subtitulo 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cf5', null,['name' => 'title_cf5', 'id' => 'title_cf5'])}}
                                        <label for="title_cf5">Titulo 5</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cf5', null,['name' => 'subtitle_cf5', 'id' => 'subtitle_cf5'])}}
                                        <label for="subtitle_cf5">Subtitulo 5</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Sobre Nós</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_about', null,['name' => 'title_about', 'id' => 'title_about'])}}
                                        <label for="title_about">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_about', null,['name' => 'subtitle_about', 'id' => 'subtitle_about'])}}
                                        <label for="subtitle_about">Subtítulo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::textarea('txt_about', null,['name' => 'txt_about', 'id' => 'txt_about', 'class' => 'form-control','autocomplete' => 'off'])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_about != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/home/{{$data->img_about}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_about" name="img_about" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_about">Imagem Sobre Nós</label>
                                        <small class="text-danger">Dimensões: 1150x1720 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                                    </div>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>PET</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_pet', null,['name' => 'title_pet', 'id' => 'title_pet'])}}
                                        <label for="title_pet">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_pet', null,['name' => 'subtitle_pet', 'id' => 'subtitle_pet'])}}
                                        <label for="subtitle_pet">Subtítulo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_pet != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/home/{{$data->img_pet}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_pet" name="img_pet" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_pet">Imagem PET</label>
                                        <small class="text-danger">Dimensões: 1150x1720 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                                    </div>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Blog</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_blog', null,['name' => 'title_blog', 'id' => 'title_blog'])}}
                                        <label for="title_blog">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_blog', null,['name' => 'subtitle_blog', 'id' => 'subtitle_blog'])}}
                                        <label for="subtitle_blog">Subtítulo</label>
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
                            <h5>Depoimentos</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_depoimentos', null,['name' => 'title_depoimentos', 'id' => 'title_depoimentos'])}}
                                        <label for="title_depoimentos">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_depoimentos', null,['name' => 'subtitle_depoimentos', 'id' => 'subtitle_depoimentos'])}}
                                        <label for="subtitle_depoimentos">Subtítulo</label>
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
                            <h5>FAQ</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_faq', null,['name' => 'title_faq', 'id' => 'title_faq'])}}
                                        <label for="title_faq">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::textarea('subtitle_faq', null,['name' => 'subtitle_faq', 'id' => 'subtitle_faq', 'class' => 'form-control','autocomplete' => 'off'])}}
                                        {{-- <label for="subtitle_faq">Texto</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-formulaja">Salvar <i class="fa fa-save"></i></button>

        </form>
    </div>
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
    });
</script>
@endsection
