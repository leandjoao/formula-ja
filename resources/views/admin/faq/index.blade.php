@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Dúvidas</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de dúvidas ({{count($faqs)}})</h3>
                <a href="{{route('faq.new')}}" class="btn btn-formulaja"><i class="fa fa-plus"></i> Adicionar pergunta e resposta</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Pergunta</th>
                        <th>PET</th>
                        <th>Parceiro</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faqs as $faq)
                        <tr>
                            <td>{{$faq->question }}</td>
                            <td><i class="fa {{$faq->pet ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td><i class="fa {{$faq->partner ? 'fa-check' : 'fa-times'}}"></i></td>
                            <td>{{Carbon\Carbon::parse($faq->created_at)->diffForHumans()}}</td>
                            <td>
                                <a class="button view" href="{{route('faq.edit', $faq->id)}}">
                                    <span class='text'>Editar</span>
                                    <span class="icon"><i class="fa fa-edit"></i></span>
                                </a>
                                <a class="button delete" href="{{route('faq.remove', $faq->id)}}">
                                    <span class='text'>Remover</span>
                                    <span class="icon"><i class="fa fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
             {{$faqs->links()}}
        </div>
    </div>
</div>
@endsection
