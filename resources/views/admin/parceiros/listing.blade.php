@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Parceiros</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de parceiros ({{count($parceiros)}})</h3>
                <button><i class="fa fa-plus"></i> Adicionar parceiro</button>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>PET?</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parceiros as $parceiro)
                        <tr>
                            <td>{{ $parceiro['name'] }}</td>
                            <td>@if($parceiro['pet']) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</td>
                            <td>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$parceiros->links()}} --}}
        </div>
    </div>
</div>
@endsection
