@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Informações Gerais</h3>
    </div>
    
    <div class="main-content">
        {{-- <form action="{{route('texts.home.save')}}" class="form" method="POST" enctype="multipart/form-data"> --}}
        {!! Form::model($data, ['route' => ['info.save'], 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
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
                                        {{Form::text('title', null,['name' => 'title', 'id' => 'title', 'required' => 'required'])}}
                                        <label for="title">Título</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('description', null,['name' => 'description', 'id' => 'description'])}}
                                        <label for="description">Texto Sobre A Empresa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('telefone', null,['name' => 'telefone', 'id' => 'telefone'])}}
                                        <label for="telefone">Telefone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('celular', null,['name' => 'celular', 'id' => 'celular'])}}
                                        <label for="celular">Celular</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('email', null,['name' => 'email', 'id' => 'email'])}}
                                        <label for="email">E-mail</label>
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
                            <h5>Redes Sociais</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('facebook', null,['name' => 'facebook', 'id' => 'facebook'])}}
                                        <label for="facebook">Facebook</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('instagram', null,['name' => 'instagram', 'id' => 'instagram'])}}
                                        <label for="instagram">Instagram</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('linkedin', null,['name' => 'linkedin', 'id' => 'linkedin'])}}
                                        <label for="linkedin">Linkedin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('twitter', null,['name' => 'twitter', 'id' => 'twitter'])}}
                                        <label for="twitter">Twitter</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mt-4">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('youtube', null,['name' => 'youtube', 'id' => 'youtube'])}}
                                        <label for="youtube">Youtube</label>
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
                            <h5>Texto de Call to Action <small class="text-muted">(Barra amarela antes do rodapé)</small></h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-input">
                                        {{Form::text('cta', null,['name' => 'cta', 'id' => 'cta'])}}
                                        <label for="cta">Texto</label>
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
@endsection
