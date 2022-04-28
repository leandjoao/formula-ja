@extends('layouts.admin')
@section('content')
<div class="main">
    <div class="main-header">
        <h3>Parceiros</h3>
    </div>
    <div class="main-content">
        <div class="listing">
            <div class="listing-title">
                <h3>Listagem de parceiros ({{$partners}})</h3>
                <a href="{{route('partners.create')}}"><i class="fa fa-plus"></i> Adicionar parceiro</a>
            </div>
            <table class="table table-striped table-bordered" cellspacing=0>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nome</th>
                        <th>PET?</th>
                        <th>Desde</th>
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
            <a class="button view" href="${d.editar}">
                <span class='text'>Editar</span>
                <span class="icon"><i class="fa fa-edit"></i></span>
            </a>
            <a class="button delete" href="${d.remove}">
                <span class='text'>Remover</span>
                <span class="icon"><i class="fa fa-trash"></i></span>
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

    function image(d) {
        return `
        <td>
            <img src="${d.image}" alt="${d.title}" />
        </td>
        `;
    }

    $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('partners.getPartners')}}",
        autoWidth: false,
        columns: [
        { data: 'id' },
        { data: function (row, type, set) {
            return image(row.logo);
        }, "defaultContent": "", "orderable": false},
        { data: 'name' },
        { data: function (row, type, set) {
            return pet(row.pet);
        }, className: 'pet', "orderable": false},
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
