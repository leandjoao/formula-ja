@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar Página Sobre Nós</h3>
    </div>
    
    <div class="main-content">
        {{-- <form action="{{route('texts.home.save')}}" class="form" method="POST" enctype="multipart/form-data"> --}}
        {!! Form::model($data, ['route' => ['texts.about.save'], 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
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
                                        {{Form::text('title_banner', null,['name' => 'title_banner', 'id' => 'title_banner', 'required' => 'required'])}}
                                        <label for="title_banner">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_banner != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/about/{{$data->img_banner}}?rand={{rand(10,999)}}" class="img-thumbnail">
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
                            <h5>Sobre Nós</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::textarea('txt_about', null,['name' => 'txt_about', 'id' => 'txt_about', 'class' => 'form-control','autocomplete' => 'off'])}}
                                        {{-- <label for="txt_about">Texto</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_about != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/about/{{$data->img_about}}?rand={{rand(10,999)}}" class="img-thumbnail">
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
            </div>
            
            <div class="create">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Equipe</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_equipe', null,['name' => 'title_equipe', 'id' => 'title_equipe'])}}
                                        <label for="title_equipe">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::textarea('txt_equipe', null,['name' => 'txt_equipe', 'id' => 'txt_equipe', 'class' => 'form-control','autocomplete' => 'off'])}}
                                        {{-- <label for="txt_about">Texto</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_equipe != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/about/{{$data->img_equipe}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_equipe" name="img_equipe" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_equipe">Imagem Equipe</label>
                                        <small class="text-danger">Dimensões: 1150x1720 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Parceiros</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_parceiros', null,['name' => 'title_parceiros', 'id' => 'title_parceiros'])}}
                                        <label for="title_parceiros">Título</label>
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
        CKEDITOR.replace('txt_about', {
                toolbar: [
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                ]
            });
        CKEDITOR.replace('txt_equipe', {
                toolbar: [
                    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                ]
            });
    });
</script>
@endsection
