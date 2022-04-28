@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar Página Seja um Parceiro</h3>
    </div>
    
    <div class="main-content">
        {!! Form::model($data, ['route' => ['texts.parceiro.save'], 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
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
                                        <img src="/storage/paginas/parceiro/{{$data->img_banner}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_banner" name="img_banner" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_banner">Banner do Topo</label>
                                        <small class="text-danger">Dimensões: 920x626 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Números</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_numeros', null,['name' => 'title_numeros', 'id' => 'title_numeros'])}}
                                        <label for="title_numeros">Titulo</label>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_numero1', null,['name' => 'title_numero1', 'id' => 'title_numero1'])}}
                                        <label for="title_numero1">Titulo 1</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_numero1', null,['name' => 'subtitle_numero1', 'id' => 'subtitle_numero1'])}}
                                        <label for="subtitle_numero1">Subtitulo 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_numero2', null,['name' => 'title_numero2', 'id' => 'title_numero2'])}}
                                        <label for="title_numero2">Titulo 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_numero2', null,['name' => 'subtitle_numero2', 'id' => 'subtitle_numero2'])}}
                                        <label for="subtitle_numero2">Subtitulo 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_numero3', null,['name' => 'title_numero3', 'id' => 'title_numero3'])}}
                                        <label for="title_numero3">Titulo 3</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_numero3', null,['name' => 'subtitle_numero3', 'id' => 'subtitle_numero3'])}}
                                        <label for="subtitle_numero3">Subtitulo 3</label>
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
                                        <img src="/storage/paginas/parceiro/{{$data->img_about}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_about" name="img_about" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_about">Imagem Sobre Nós</label>
                                        <small class="text-danger">Dimensões: 542x480 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Diferenciais</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_diferenciais', null,['name' => 'title_diferenciais', 'id' => 'title_diferenciais'])}}
                                        <label for="title_diferenciais">Titulo</label>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_diferenciais', null,['name' => 'subtitle_diferenciais', 'id' => 'subtitle_diferenciais'])}}
                                        <label for="subtitle_diferenciais">Subitulo</label>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_diferencial1', null,['name' => 'title_diferencial1', 'id' => 'title_diferencial1'])}}
                                        <label for="title_diferencial1">Titulo 1</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_diferencial1', null,['name' => 'subtitle_diferencial1', 'id' => 'subtitle_diferencial1'])}}
                                        <label for="subtitle_diferencial1">Subtitulo 1</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_diferencial2', null,['name' => 'title_diferencial2', 'id' => 'title_diferencial2'])}}
                                        <label for="title_diferencial2">Titulo 2</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_diferencial2', null,['name' => 'subtitle_diferencial2', 'id' => 'subtitle_diferencial2'])}}
                                        <label for="subtitle_diferencial2">Subtitulo 2</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_diferencial3', null,['name' => 'title_diferencial3', 'id' => 'title_diferencial3'])}}
                                        <label for="title_diferencial3">Titulo 3</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_diferencial3', null,['name' => 'subtitle_diferencial3', 'id' => 'subtitle_diferencial3'])}}
                                        <label for="subtitle_diferencial3">Subtitulo 3</label>
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
                            <h5>CTA</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_cta', null,['name' => 'title_cta', 'id' => 'title_cta'])}}
                                        <label for="title_cta">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_cta', null,['name' => 'subtitle_cta', 'id' => 'subtitle_cta'])}}
                                        <label for="subtitle_cta">Subtítulo</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                @if($data->img_cta != NULL)
                                <div class="form-group">
                                    <p class="text-center photo-content">
                                        <img src="/storage/paginas/parceiro/{{$data->img_cta}}?rand={{rand(10,999)}}" class="img-thumbnail">
                                    </p>
                                </div>
                                @endif
                                <div class="form-group" style="margin-top: 40px;">
                                    <div class="form-input">
                                        <input type="file" id="img_cta" name="img_cta" accept="image/jpg, image/png, image/jpeg" />
                                        <label for="img_cta">Imagem CTA</label>
                                        <small class="text-danger">Dimensões: 540x595 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
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
                            <h5>Formulário</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_form', null,['name' => 'title_form', 'id' => 'title_form'])}}
                                        <label for="title_form">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_form', null,['name' => 'subtitle_form', 'id' => 'subtitle_form'])}}
                                        <label for="subtitle_form">Subtítulo</label>
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
    });
</script>
@endsection
