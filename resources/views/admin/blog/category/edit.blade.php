@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Categorias :: Editar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('blog.category.edit.save', $category->id)}}" method="post" class="form">
                @csrf
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="label" name="label" value="{{$category->label}}" required />
                        <label for="label">Nome da categoria</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
