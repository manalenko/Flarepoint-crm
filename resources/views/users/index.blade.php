@extends('layouts.master')
@section('heading')
    <h1>{{ __('All Users') }}</h1>
@stop

@section('content')

    <table class="table table-hover " id="users-table">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Mail') }}</th>
            <th>{{ __('Work number') }}</th>
            <th></th>
            <th></th>
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
            ajax: '{!! route('users.data') !!}',
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'work_number', name: 'work_number'},
                    @if(Entrust::can('user-update'))
                {
                    data: 'edit', name: 'edit', orderable: false, searchable: false
                },
                    @endif
                    @if(Entrust::can('user-delete'))
                {
                    data: 'delete', name: 'delete', orderable: false, searchable: false
                },
                @endif
            ]
        });
    });
</script>
@endpush
