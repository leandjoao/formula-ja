@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Blog :: Editar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                {{-- <form action="{{route('blog.save')}}" method="post" class="mt-4" enctype="multipart/form-data"> --}}
                {!! Form::model($data, ['route' => ['blog.edit.save', $data->id], 'method' => 'post', 'class' => 'mt-4', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <div class="form-group">
                        <div class="form-input">
                            {{-- <input type="text" id="title" name="title" required /> --}}
                            {{Form::text('title', null,['autocomplete' => 'off', 'name' => 'title', 'id' => 'title', 'required' => 'required'])}}
                            <label for="title">Títutlo do post</label>
                        </div>
                        <div class="form-input">
                            {{Form::select('category_id', $category, null)}}
                            <label for="category">Categoria do post</label>
                            <small>Para adicionar uma nova categoria clique <a href="{{route('blog.category.new')}}">aqui</a></small>
                        </div>
                    </div>
                    @if($data->banner != NULL)
                    <div class="form-group">
                        <p class="text-center photo-content">
                            <img src="/storage/blog/{{$data->banner}}?rand={{rand(10,999)}}" class="img-thumbnail">
                        </p>
                    </div>
                    @endif
                    <div class="form-group" style="margin-top: 40px;">
                        <div class="form-input">
                            <input type="file" id="banner" name="banner" accept="image/jpg, image/png, image/jpeg" />
                            <label for="banner">Banner do post</label>
                            <small class="text-danger">Dimensões: 866x488 | Peso Máx: 1MB | Formatos: .JPG, .PNG, .JPEG</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            {{Form::textarea('content', null,['class' => 'form-control','autocomplete' => 'off'])}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                
                    {{-- {{Form::hidden('id', $data->id, ['id' => 'data_id'])}} --}}
            
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('extraCSS')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<style>
    .note-btn-group.open .note-dropdown-menu, .note-dropdown-item {
        display: flex !important;
    }
</style>
@endsection
@section('extraJS')
<script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace( 'content' 
            // {
            // 	filebrowserBrowseUrl: '/assets/painel/ckfinder/ckfinder.html',
            //     filebrowserImageBrowseUrl: '/assets/painel/ckfinder/ckfinder.html?type=Images',
            //     filebrowserUploadUrl: '/assets/painel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            //     filebrowserImageUploadUrl: '/assets/painel/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            // } 
        );
        // $('#text').summernote({
        //     placeholder: "Conteudo do post",
        //     height: 250,
        //     toolbar: [
        //     ['font', ['bold', 'italic']],
        //     ['color', ['color']],
        //     ['para', ['ul', 'ol', 'paragraph']],
        //     ['insert', ['link']],
        //     ]
        // });
    });
</script>
@endsection
