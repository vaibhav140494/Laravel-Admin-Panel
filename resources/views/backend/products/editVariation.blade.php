@extends ('backend.layouts.app')

@section ('title', 'Prodcut Variation Management' . ' | ' . 'Variation Edit')

@section('page-header')
    <h1>
        {{ 'Prodcut Variation Management' }}
        <small>{{ 'Variation Edit' }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route'=>'admin.products.productvariations.update','class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-productvariation','enctype' => 'multipart/form-data']) }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ 'Variation Edit'}}</h3>
            </div><!--box-header with-border-->
            <div class="box-body">
                <div class="form-group">
                {{ Form::label('product_name','Product Name', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::text('product_name',$pdetails[0]->product_name, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required','readonly'=>'true']) }}
                    </div>
                </div>
                <div class="form-group">
                {{ Form::label('variation_name','Variation Name', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::text('variation_name',$pdetails[0]->variation_name , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10">
                        {{ Form::hidden('variation_id',$pdetails[0]->variation_id , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required']) }}
                        {{ Form::hidden('product_id',$pdetails[0]->product_id , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name')]) }}
                        {{ Form::hidden('product_variation_id',$pdetails[0]->product_variation_id , ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name')]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('variation_values','Variation Values' , ['class' => 'col-lg-2 control-label required']) }}    
                    <div class="col-lg-10">
                            @if(isset($values))
                                <select name="variation_value_id[]" id="variation_value_id" class="form-control box-size" multiple="multiple">
                                @foreach($values as $vv)
                                    <?php $var_value_array = json_decode($pdetails[0]->variation_values_id);?>
                                    @if(in_array($vv->id,$var_value_array))
                                        <option value="{{$vv->id}}" selected>{{$vv->variation_value}}</option>
                                    @else
                                        <option value="{{$vv->id}}">{{$vv->variation_value}}</option>
                                    @endif
                                @endforeach
                                </select>
                            @endif
                    </div>
                </div>
               <div class="form-group">
               <div class="edit-form-btn">
                        {{ link_to_route('admin.products.productvariations.show', trans('buttons.general.cancel'), [$pdetails[0]->product_id], ['class' => 'btn btn-danger btn-md']) }}
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