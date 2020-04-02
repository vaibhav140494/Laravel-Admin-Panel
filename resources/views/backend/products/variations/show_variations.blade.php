@extends ('backend.layouts.app')

@section ('title','customized product')

@section('page-header')
    <h1>{{ ' Product Variations' }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
                
                <div class="btn-group">
                <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
                </button>
            <ul class="dropdown-menu" role="menu">
        
        @permission( 'create-product' )
           
            @if(isset($productvariation))
                <li>
                    <a href="{{ route( 'admin.products.variations.create') }}">
                        <i class="fa fa-plus"></i> {{ 'Create Product Variation' }}
                    </a>
                </li>
            @endif
        @endauth
    </ul>
            </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="variation" class="table display table-condensed table-hover table-bordered">
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
                       @foreach($productvariation as $prod_variation)
                       <tr>
                       <td>{{$prod_variation->id}}</td>
                       <td>{{$prod_variation->variation_name}}</td>
                       <td>{{$prod_variation->variationvalues}}</td>
                       <td><a href="{{ route('admin.products.variations.edit',[$prod_variation->id]) }}" class="btn btn-flat btn-default">
                           <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                           </a>
                       </td>
                       <td>
                           <a href="{{ route('admin.products.productvariations.delete',[$prod_variation->id]) }}" class="btn btn-flat btn-default">
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

@endsection
@section('after-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}
    
    <script>
            $(function(){
                
                $('#variation').DataTable();
                
            });
           
    </script>
@endsection

