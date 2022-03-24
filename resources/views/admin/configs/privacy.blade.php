@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Editar textos :: Politicas de Privacidade</h3>
    </div>
    <div class="main-content">
        <form action="{{ route('texts.policy.save') }}" method="POST" class="w-100">
            @csrf
            <div class="create mb-4">
                <div class="create-form">
                    <div class="container">
                        <div class="py-2">
                            <h5>Texto de Politicas de Privacidade</h5>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <textarea name="privacy" id="privacy" class="form-control" rows="10">{!! $policy->privacy !!}</textarea>
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
        $('#privacy').summernote({
            placeholder: "Politicas de Privacidade",
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
