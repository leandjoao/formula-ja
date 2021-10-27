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
            <table class="table" cellspacing=0>
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
            </table>
            {{$users->links()}}
        </div>
    </div>
</div>
@endsection
@section('extraJS')
<script type="text/javascript">
    $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('users.getUsers')}}",
        autoWidth: false,
        columns: [
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'access_level' },
        { data: 'created_at' },
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json'
        },
    });
</script>
@endsection
