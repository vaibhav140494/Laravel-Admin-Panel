@extends ('backend.layouts.app')

@section ('title', 'Prodcut GALARY' . ' | ' . 'PRODUCT GALARY')

@section('page-header')
    <h1>
        {{ 'PRODUCT GALARY' }}
        <small>{{ 'PRODUCT GALARY' }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ 'Product Galary'}}</h3>
                    <div class="box-tools pull-right">
                
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-flat dropdown-toggle"      data-toggle="dropdown">Action
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
            <ul class="dropdown-menu" role="menu">
        
        
            <li>
                <a href="{{ route( 'admin.products.productimages.upload',[$productid]) }}">
                    <i class="fa fa-plus"></i> {{ 'Add Product Images' }}
                </a>
            </li>
        
            </ul>
            </div>
            </div><!--box-header with-border-->
            <div class="box-body">
            <br>
                <div class="container">
                    <div class="row">
                    
                        @foreach($images as $image)
                            <div class="col-md-3" >
                                <button class="delete fa fa-trash"  value="{{$image->id}}"></button>
                                <div>
                                </div>
                            
                                <img src="{{url('storage/productimages/'.$image->product_image)}}" style="margin:10px 0;" border="0" width="100px" height="100px" class="img-thumbnail" align="center" />
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
            </div>
@endsection

@section("after-scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js" integrity="sha256-vHsV98JlYVo7h9eo1BQrqWgGQDt6prGrUbKAlHfP+0Y=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" integrity="sha256-sfG8c9ILUB8EXQ5muswfjZsKICbRIJUG/kBogvvV5sY=" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
           $('.delete').click(function(){
            var did=$(this).val();
            var el=this;

            bootbox.confirm("Do you really want to delete record?", function(result) {

                if(result){
                    $.ajax({
                        url:'{{route("admin.products.productimages.galary.delete")}}',
                        type:'POST',
                        data:{
                            id:did
                                },
                        success: function(response){
                                if(response == 1){
                                $(el).parent().remove();
                                //location.reload(true);
                                }
                        }        
                    });
                }
            });
        });
    });


</script>    
@endsection