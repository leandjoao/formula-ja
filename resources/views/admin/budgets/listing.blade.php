@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Orçamentos</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de orçamentos ({{$orcamentos}})</h3>
            </div>
            <table class="table table-striped table-bordered" cellspacing=0>
                <thead>
                    <tr>
                        <th>Nº do Pedido</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>PET</th>
                        <th>Criado</th>
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
        `;
    }

    function pet(d) {
        return `
        <td>
            <i class="${(d) ? 'fa fa-check' : 'fa fa-times'}"></i>
        </td>
        `;
    }

    function status(d) {
        switch (d) {
            case "novo":
            return `<td><span class="status new">Novo <i class="far fa-star"></i></span></td>`;
            break;

            case "aguardando":
            return `<td><span class="status waiting">Aguardando <i class="far fa-clock"></i></span></td>`;
            break;

            case "enviado":
            return `<td><span class="status sent">Enviado <i class="fas fa-truck"></i></span></td>`;
            break;

            case "recusado":
            return `<td><span class="status refused">Recusado <i class="fa fa-times"></i></span></td>`;
            break;

            case "finalizado":
            return `<td><span class="status finished">Finalizado <i class="fa fa-check"></i></span></td>`;
            break;
        }
    }

    $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{(Auth::user()->access_level != 1) ? route('budgets.getBudgetsUser') : route('budgets.getBudgets')}}",
        autoWidth: false,
        columns: [
        { data: 'id' },
        { data: 'name', defaultContent: "", orderable: false},
        { data: function (row, type, set) {
            return status(row.status);
        }, "orderable": false},
        { data: function (row, type, set) {
            return pet(row.pet);
        }, "orderable": false},
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
