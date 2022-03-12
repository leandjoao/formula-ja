@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Informações :: Editar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('config.info.save')}}" method="post" class="form">
                @csrf
                <h6>Redes Sociais</h6>
                <div class="form-group">
                    @foreach ($sm as $social)
                        <div class="form-input">
                            <input type="text" id="social-{{$social->id}}" name="social[{{$social->id}}]" value="{{$social->link}}" required />
                            <label for="social-{{$social->id}}"><i class="{{$social->media}}"></i></label>
                        </div>
                    @endforeach
                </div>

                <h6>Contato</h6>
                <div class="form-group">
                    @foreach ($infos as $info)
                        <div class="form-input">
                            <input type="text" id="info-{{$info->id}}" name="info[{{$info->id}}]" value="{{$info->value}}" required />
                            <label for="info-{{$info->id}}"><i class="{{$info->type}}"></i>&nbsp;{{$info->label}}</label>
                        </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
