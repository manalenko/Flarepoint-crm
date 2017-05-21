@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>

    </table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            language: {
                edit: "Редактировать",
                search: "Поиск",
                processing:     "Обработка",
                lengthMenu:    "Выводить _MENU_ записей",
                info:           "Показаны записи с _START_ по _END_ из _TOTAL_",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix:    "",
                loadingRecords: "Загрузка...",
                zeroRecords:    "Нет записей",
                emptyTable:     "Нет данных",
                paginate: {
                    first: "Первый",
                    previous: "Предыдущий",
                    next: "Следующий",
                    last: "Последний"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            },
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'}
            ]
        });
    });
</script>
@endpush