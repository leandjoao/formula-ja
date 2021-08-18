@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Orçamentos</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de orçamentos ({{count($orcamentos)}})</h3>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>PET</th>
                        <th>Status</th>
                        <th>Criado</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orcamentos as $orcamento)
                        <tr>
                            <td>{{ $orcamento['name'] }}</td>
                            <td>@if($orcamento['pet']) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</td>
                            <td><span class="{{ $orcamento['status'] }}">{{ $orcamento['status'] }}</span></td>
                            <td>{{ Carbon\Carbon::parse($orcamento['created_at'])->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('budgets.inner')}}"><i class="fa fa-eye"></i></a>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$orcamentos->links()}} --}}
        </div>
    </div>
</div>
@endsection
