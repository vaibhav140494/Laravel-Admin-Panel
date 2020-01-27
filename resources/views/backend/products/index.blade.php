@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.products.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.products.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.products.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.products.partials.products-header-buttons')
            </div>
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="products-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.products.table.id') }}</th>
                            <th>{{ trans('labels.backend.products.table.category_id') }}</th>
                            <th>{{ trans('labels.backend.products.table.subcategory_id') }}</th>
                            <th>{{ trans('labels.backend.products.table.sku') }}</th>
                            <th>{{ trans('labels.backend.products.table.quantity') }}</th>
                            <th>{{ trans('labels.backend.products.table.type') }}</th>
                            <th>{{ trans('labels.backend.products.table.price') }}</th>
                            <th>{{ trans('labels.backend.products.table.discouted_price') }}</th>
                            <th>{{ trans('labels.backend.products.table.image') }}</th>
                            <th>{{ trans('labels.backend.products.table.specification') }}</th>
                            <th>{{ trans('labels.backend.products.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.products.table.updatedat') }}</th>
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
            
            var dataTable = $('#products-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.products.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.products.table')}}.id'},
                    {data: 'category_id', name: '{{config('module.products.table')}}.category_id'},
                    {data: 'subcategory_id', name: '{{config('module.products.table')}}.subcategory_id'},
                    {data: 'sku', name: '{{config('module.products.table')}}.sku'},
                    {data: 'quantity', name: '{{config('module.products.table')}}.quantity'},
                    {data: 'type', name: '{{config('module.products.table')}}.type'},
                    {data: 'price', name: '{{config('module.products.table')}}.price'},
                    {data: 'discouted_price', name: '{{config('module.products.table')}}.discouted_price'},
                    {data: 'image', name: '{{config('module.products.table')}}.image'},
                    {data: 'specification', name: '{{config('module.products.table')}}.specification'},
                    {data: 'created_at', name: '{{config('module.products.table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('module.products.table')}}.updated_at'},
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
