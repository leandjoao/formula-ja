@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Usuários</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de usuários ({{count($users)}})</h3>
                <button><i class="fa fa-plus"></i> Adicionar usuário</button>
            </div>
            <table class="listing-table" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="hide-on-mobile">Telefone</th>
                        <th class="hide-on-mobile">Nivel de acesso</th>
                        <th class="hide-on-mobile">Membro desde</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="hide-on-mobile">{{ $user->phone }}</td>
                            <td class="hide-on-mobile">{{ $user->access->label }}</td>
                            <td class="hide-on-mobile">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href=""><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
