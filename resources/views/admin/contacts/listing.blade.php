@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Contatos</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de contatos ({{count($contacts)}})</h3>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Data</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contato)
                        <tr>
                            <td>{{ $contato['name'] }}</td>
                            <td>{{ $contato['email'] }}</td>
                            <td>{{ $contato['phone'] }}</td>
                            <td>{{ Carbon\Carbon::parse($contato['created_at'])->diffForHumans() }}</td>
                            <td>
                                <a href=""><i class="fa fa-eye"></i></a>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$contacts->links()}} --}}
        </div>
    </div>
</div>
@endsection
