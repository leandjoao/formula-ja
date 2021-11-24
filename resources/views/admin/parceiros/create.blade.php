@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Parceiros :: Criar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('partners.create')}}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-input">
                            <input id="name" name="name" type="text" pattern=".+" required />
                            <label class="label" for="name">Nome</label>
                        </div>
                        <div class="form-input">
                            <select name="pet" id="pet">
                                <option value="1">Sim</option>
                                <option value="0" selected>Não</option>
                            </select>
                            <label class="label" for="pet">PET?</label>
                        </div>
                        <div class="form-input">
                            <input id="logo" name="logo" type="file" required accept="image/png, image/jpg, image/jpeg" />
                            <label class="label" for="logo">Logo</label>
                        </div>
                    </div>
                    <div class="form-input">
                        <button type="submit">Salvar <i class="fa fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
