@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.supporttickets.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.supporttickets.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.supporttickets.management') }}</h3>
    <div class="box-tools pull-right">
    <div class="col-lg-3"><label for="status">Filter:</label></div>
    <div class="col-lg-9">
            <select name="status" id="filter" class="form-control box-size">
                <option value="all" >all</option>
                <option value="generated" >generated</option>
                <option value="processed" >processed</option>
                <option value="removed">removed</option>
            </select>
    </div>
            
    </div>
            
        </div><!--box-header with-border-->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="supporttickets-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.supporttickets.table.id') }}</th>
                            <th>User Name</th>
                            <th>Topic</th>
                            <th>{{ trans('labels.backend.supporttickets.table.order_id') }}</th>
                            <th>{{ trans('labels.backend.supporttickets.table.discription') }}</th>
                            <th>{{ trans('labels.backend.supporttickets.table.admin_comment') }}</th>
                            <th>{{ trans('labels.backend.supporttickets.table.status') }}</th>
                            <th>{{ trans('labels.backend.supporttickets.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.supporttickets.table.updatedat') }}</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
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
            
            var dataTable = $('#supporttickets-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.supporttickets.get") }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: '{{config('module.supporttickets.table')}}.id'},
                    {data: 'full_name', name: '{{config('module.supporttickets.table')}}.full_name'},
                    {data: 'topic', name: '{{config('module.supporttickets.table')}}.topic'},
                    {data: 'order_id', name: '{{config('module.supporttickets.table')}}.order_id'},
                    {data: 'discription', name: '{{config('module.supporttickets.table')}}.discription'},
                    {data: 'admin_comment', name: '{{config('module.supporttickets.table')}}.admin_comment'},
                    {data: 'status', name: '{{config('module.supporttickets.table')}}.status'},
                    {data: 'created_at', name: '{{config('module.supporttickets.table')}}.created_at'},
                    {data: 'updated_at', name: '{{config('module.supporttickets.table')}}.updated_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0,1,2,3,4,5,6,7,8,9, 10 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0,1,2,3,4,5,6,7,8,9, 10 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1 ]  }}
                    ]
                }
                
            });

            
            $('#filter').on('change', function(){
                
                var uni = $(this).val();
                if(uni == 'all')
                {
                    location.reload();
                }
                else{
                    var myTable = $('#supporttickets-table').dataTable();  // get the table ID
                    dataTable.api().columns(6).search(uni).draw();
                }
                
            });
         
            
        });
    </script>
@endsection
