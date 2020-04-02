@extends ('backend.layouts.app')

@section ('title', 'Prodcut Variation Management' . ' | ' . 'Variation Edit')

@section('page-header')
    <h1>
        {{ 'Prodcut Variation Management' }}
        <small>{{ 'Variation Edit' }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route'=>'admin.products.variations.update','class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-productvariation','enctype' => 'multipart/form-data']) }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ 'Variation Edit'}}</h3>
            </div><!--box-header with-border-->
            <div class="box-body">
                
                <div class="form-group">
                {{ Form::label('variation_name','Variation Name', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::text('variation_name',$vdetails[0]->variation_name , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        {{ Form::hidden('variation_id',$vdetails[0]->id , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                        {{ Form::label('variation_values','Variation Values', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-9">
                        <div class="input_fields_container">
                            <?php  $i=0;?>
                            @foreach($vdetails as $value)
                                <div>
                                    @if($i < count($product_variation_values))
                                            @if($product_variation_values[$i] == $value->variation_value_id)
                                    
                                        <span>You cannot Edit this value</span>
                                        <!-- <input type="hidden" name="variation_value_id[]" value="{{$value->variation_value_id}}"> -->
                                        <input type="text" name="variation_val_old" class="form-control box-size" value="{{$value->variation_value}}" disabled>
                                        @endif
                                    @else
                                    <input type="hidden" name="variation_value_id[]" value="{{$value->variation_value_id}}">
                                        <input type="text" name="variation_value[]" class="form-control box-size" value="{{$value->variation_value}}">
                                   @endif
                                </div><br>
                                <?php $i++;?>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-primary add_more_button">Add</button>
                    </div>
                </div>
               <div class="form-group">
               <div class="edit-form-btn">
                        {{ link_to_route('admin.variation.show', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                </div>
               </div>
               </div><!--box-body-->
        </div>
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
@section("after-scripts")
<script>
    $(document).ready(function() {
    var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 1; //initialize counter for text box
    $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        if(x < max_fields_limit){ //check conditions
            x++; //counter increment
            $('.input_fields_container').append('<div><input type="text" name="variation_value[]" class="form-control box-size"></div><br>'); //add input field
        }
    });  
    $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@endsection 