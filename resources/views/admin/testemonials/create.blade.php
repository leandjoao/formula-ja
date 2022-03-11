@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Depoimentos :: Criar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('testemonials.save')}}" method="post" class="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="name" name="name" required />
                        <label for="name">Nome da pessoa</label>
                    </div>
                    <div class="form-input">
                        <input type="text" id="business" name="business" required />
                        <label for="business">Nome da empresa</label>
                    </div>
                    <div class="form-input">
                        <input type="file" id="avatar" name="avatar" accept="image/jpg, image/png, image/jpeg" required />
                        <label for="avatar">Foto</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-input">
                        <input type="text" id="title" name="title" required />
                        <label for="title">Título</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-input">
                        <textarea name="testemonial" id="testemonial" class="form-control" rows="6" placeholder="Depoimento" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
