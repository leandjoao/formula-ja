@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Usuários</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de usuários ({{$users}})</h3>
                <a href="{{route('users.create')}}"><i class="fa fa-plus"></i> Adicionar usuário</a>
            </div>
            <table class="table table-striped table-bordered" cellspacing=0>
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
        </div>
    </div>
</div>
@endsection
@section('extraJS')
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
function format(d) {
    return `
        <td>
            <a class="button view" href="${d.view}">
                <span class='text'>Ver</span>
                <span class="icon"><i class="fa fa-eye"></i></span>
            </a>
        </td>
        <td>
            <a class="button delete" href="${d.remove}">
                <span class='text'>Remover</span>
                <span class="icon"><i class="fa fa-trash"></i></span>
            </a>
        </td>
    `;
}

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
        { data: function (row, type, set) {
            return format(row.actions);
        }, "orderable": false}
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json'
        },
    });
</script>
@endsection
