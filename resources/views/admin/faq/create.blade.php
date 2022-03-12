@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dúvidas :: Criar</h3>
    </div>
    <div class="main-content">
        <div class="create">
            <div class="create-form">
                <form action="{{route('faq.save')}}" method="post" class="form">
                    @csrf
                    <div class="form-group">
                        <div class="form-input">
                            <input type="text" id="question" name="question" required />
                            <label for="question">Pergunta</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pet" name="pet">
                            <label class="form-check-label" for="pet">PET?</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="partner" name="partner">
                            <label class="form-check-label" for="partner">Parceiro?</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-input">
                            <textarea name="answer" id="answer" placeholder="Resposta" class="form-control" rows="6" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-formulaja"><i class="fa fa-save"></i> &nbsp; Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
