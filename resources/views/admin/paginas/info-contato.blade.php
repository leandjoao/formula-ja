@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar Página Contato</h3>
    </div>
    
    <div class="main-content">
        {{-- <form action="{{route('texts.home.save')}}" class="form" method="POST" enctype="multipart/form-data"> --}}
        {!! Form::model($data, ['route' => ['texts.contato.save'], 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
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
                                        <img src="/storage/paginas/contato/{{$data->img_banner}}?rand={{rand(10,999)}}" class="img-thumbnail">
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
                            <h5>Informações de Contato</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('title_info', null,['name' => 'title_info', 'id' => 'title_info'])}}
                                        <label for="title_info">Título</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('subtitle_info', null,['name' => 'subtitle_info', 'id' => 'subtitle_info'])}}
                                        <label for="subtitle_info">Subtítulo</label>
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
