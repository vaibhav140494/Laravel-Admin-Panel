@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.offers.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.offers.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.offers.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.offers.partials.offers-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="offers-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.offers.table.id') }}</th>
                            <th>{{ trans('labels.backend.offers.table.offer_name') }}</th>
                            <th>{{ trans('labels.backend.offers.table.offer_code') }}</th>
                            <th>{{ trans('labels.backend.offers.table.offer_type') }}</th>
                            <th>{{ trans('labels.backend.offers.table.offer_desc') }}</th>
                            <th>{{ trans('labels.backend.offers.table.min_order_value') }}</th>
                            <th>{{ trans('labels.backend.offers.table.max_discount') }}</th>
                            <th>{{ trans('labels.backend.offers.table.min_offer_amount') }}</th>
                            <th>{{ trans('labels.backend.offers.table.is_active') }}</th>
                            <th>{{ trans('labels.backend.offers.table.start_date') }}</th>
                            <th>{{ trans('labels.backend.offers.table.end_date') }}</th>
                            <th>{{ trans('labels.backend.offers.table.no_of_counts') }}</th>
                            <th>{{ trans('labels.backend.offers.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.offers.table.updatedat') }}</th>
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
            
            var dataTable = $('#offers-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.offers.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.offers.table')}}.id'},
                    {data: 'offer_name', name: '{{config('module.offers.table')}}.offer_name'},
                    {data: 'offer_code', name: '{{config('module.offers.table')}}.offer_code'},
                    {data: 'offer_type', name: '{{config('module.offers.table')}}.offer_type'},
                    {data: 'offer_desc', name: '{{config('module.offers.table')}}.offer_desc'},
                    {data: 'min_order_value', name: '{{config('module.offers.table')}}.min_order_value'},
                    {data: 'max_discount', name: '{{config('module.offers.table')}}.max_discount'},
                    {data: 'min_offer_amount', name: '{{config('module.offers.table')}}.min_offer_amount'},
                    {data: 'is_active', name: '{{config('module.offers.table')}}.is_active'},
                    {data: 'start_date', name: '{{config('module.offers.table')}}.start_date'},
                    {data: 'end_date', name: '{{config('module.offers.table')}}.end_date'},
                    {data: 'no_of_counts', name: '{{config('module.offers.table')}}.no_of_counts'},
                    {data: 'created_at', name: '{{config('module.offers.table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('module.offers.table')}}.updated_at'},
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
