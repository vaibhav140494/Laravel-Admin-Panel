@extends ('backend.layouts.app')

@section ('title','customized product')

@section('page-header')
    <h1>{{ 'CUSTOMIZED PRODUCT' }}</h1>
@endsection
<?php $count=1 ?> 
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $name[0]->pname }}</h3>

            <div class="box-tools pull-right">
                
                <div class="btn-group">
    <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" role="menu">
        
        @permission( 'create-product' )
            <li>
                <a href="{{ route( 'admin.products.productvariations.create',[$productid]) }}">
                    <i class="fa fa-plus"></i> {{ 'Create Product Variation' }}
                </a>
            </li>
        @endauth
    </ul>
</div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ 'id' }}</th>
                            <th>{{ 'Variation Name' }}</th>
                            <th>{{ 'Variation Values' }}</th>
                            <th>{{'Edit'}}</th>
                            <th>{{'Delete'}}</th>
                           
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                       @foreach($data as $d)
                       <tr>
                       <td>{{$d->id}}</td>
                       <td>{{$d->VariationName}}</td>
                       <td>{{$d->Variationvalues}}</td>
                       <td><a href="" class="btn btn-flat btn-default">
                           <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                           </a>
                       </td>
                       <td>
                           <a href="{{ route('admin.products.productvariations.delete',[$d->id]) }}" class="btn btn-flat btn-default">
                           <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                           </a>
                       </td>
                       </tr>
                       
                       @endforeach
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
    {!!  $data->links() !!}
@endsection
@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}
    <script>
            $(function(){

                
            });
    </script>
@endsection
