@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.orders.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.orders.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.orders.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.orders.partials.orders-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="orders-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.orders.table.id') }}</th>
                            <th>{{ trans('labels.backend.orders.table.user_id') }}</th>
                            <th>{{ trans('labels.backend.orders.table.offer_id') }}</th>
                            <th>{{ trans('labels.backend.orders.table.order_id') }}</th>
                            <th>{{ trans('labels.backend.orders.table.instructions') }}</th>
                            <th>{{ trans('labels.backend.orders.table.gross_amount') }}</th>
                            <th>{{ trans('labels.backend.orders.table.tax_amount') }}</th>
                            <th>{{ trans('labels.backend.orders.table.total_amount') }}</th>
                            <th>{{ trans('labels.backend.orders.table.discount') }}</th>
                            <th>{{ trans('labels.backend.orders.table.status') }}</th>
                            <th>{{ trans('labels.backend.orders.table.type') }}</th>
                            <th>{{ trans('labels.backend.orders.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.orders.table.updatedat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        //Below written line is short form of writing $(document).ready(function() { })
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var dataTable = $('#orders-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.orders.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.orders.table')}}.id'},
                    {data: 'user_id', name: '{{config('module.orders.table')}}.user_id'},
                    {data: 'offer_id', name: '{{config('module.orders.table')}}.offer_id'},
                    {data: 'order_id', name: '{{config('module.orders.table')}}.order_id'},
                    {data: 'instructions', name: '{{config('module.orders.table')}}.instructions'},
                    {data: 'gross_amount', name: '{{config('module.orders.table')}}.gross_amount'},
                    {data: 'tax_amount', name: '{{config('module.orders.table')}}.tax_amount'},
                    {data: 'total_amount', name: '{{config('module.orders.table')}}.total_amount'},
                    {data: 'discount', name: '{{config('module.orders.table')}}.discount'},
                    {data: 'status', name: '{{config('module.orders.table')}}.status'},
                    {data: 'type', name: '{{config('module.orders.table')}}.type'},
                    {data: 'created_at', name: '{{config('module.orders.table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('module.orders.table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1 ]  }}
                    ]
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
