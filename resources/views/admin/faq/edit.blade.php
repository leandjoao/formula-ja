@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dúvidas :: Editar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('faq.edit.save', $faq->id)}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" id="question" name="question" value="{{$faq->question}}" required />
                            <label for="question">Pergunta</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pet" name="pet" {{$faq->pet ? 'checked' : null}}>
                            <label class="form-check-label" for="pet">PET?</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="partner" name="partner" {{$faq->partner ? 'checked' : null}}>
                            <label class="form-check-label" for="partner">Parceiro?</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <textarea name="answer" id="answer" placeholder="Resposta" class="form-control" rows="6" required>{{$faq->answer}}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
