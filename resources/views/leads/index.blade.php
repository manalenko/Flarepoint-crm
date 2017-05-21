@extends('layouts.master')
@section('heading')
    <h1>{{__('All Leads')}}</h1>
@stop

@section('content')
    <table class="table table-hover" id="leads-table">
        <thead>
        <tr>

            <th>{{ __('Title') }}</th>
            <th>{{ __('Created by') }}</th>
            <th>{{ __('Deadline') }}</th>
            <th>{{ __('Assigned') }}</th>

        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#leads-table').DataTable({
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
            ajax: '{!! route('leads.data') !!}',
            columns: [

                {data: 'titlelink', name: 'title'},
                {data: 'user_created_id', name: 'user_created_id'},
                {data: 'contact_date', name: 'contact_date',},
                {data: 'user_assigned_id', name: 'user_assigned_id'},


            ]
        });
    });
</script>
@endpush