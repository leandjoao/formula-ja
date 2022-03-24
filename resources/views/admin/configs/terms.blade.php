@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar textos :: Termos de Uso</h3>
    </div>
    <div class="main-content">
        <form action="{{ route('texts.terms.save') }}" method="POST" class="w-100">
            @csrf
            <div class="create mb-4">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Texto de Termos de Uso</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <textarea name="terms" id="terms" class="form-control">{!! $terms->terms !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-formulaja">Salvar</button>
        </form>
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#terms').summernote({
            placeholder: "Termos de Uso",
            height: 400,
            toolbar: [
            ['font', ['bold', 'italic']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ]
        });
    });
</script>
@endsection
