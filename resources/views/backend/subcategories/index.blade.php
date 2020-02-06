@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.subcategories.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.subcategories.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            
        @if(isset($category))
            <h3 class="box-title">{{ ' Category = ' .$category->category_name }}</h3>
        @endif
            <div class="box-tools pull-right">
                @include('backend.subcategories.partials.subcategories-header-buttons')
            </div>
        </div><!--box-header with-border-->
        
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="subcategories-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.subcategories.table.id') }}</th>
                            <th>{{ trans('labels.backend.subcategories.table.name') }}</th>
                            <th>{{ trans('labels.backend.subcategories.table.desc') }}</th>
                            <th>{{ trans('labels.backend.subcategories.table.category_id') }}</th>
                            <th>{{ trans('labels.backend.categories.table.active') }}</th>
                            <th>{{ trans('labels.backend.subcategories.table.createdat') }}</th>
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
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(asset('js/dataTable.js')) }}

    <script>
        //Below written line is short form of writing $(document).ready(function() { })
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var dataTable = $('#subcategories-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.subcategories.get",["id"=>$category->id]) }}',
                    type: 'get'
                },
                columns: [
                    {data: 'id', name: '{{config('module.subcategories.table')}}.id'},
                    {data: 'subcategory_name', name: '{{config('module.subcategories.table')}}.subcategory_name'},
                    {data: 'subcategory_desc', name: '{{config('module.subcategories.table')}}.subcateogry_desc'},
                    {data: 'category_id', name: '{{config('module.subcategories.table')}}.category_id'},
                    {data: 'is_active', name: '{{config('module.subcategories.table')}}.is_active'},
                    {data: 'created_at', name: '{{config('module.subcategories.table')}}.created_at'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[0, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        
                    ]
                }
            });
            

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection
