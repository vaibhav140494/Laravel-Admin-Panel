@extends ('backend.layouts.app')

@section ('title', 'Prodcut Variation Management' . ' | ' . 'Variation Creation')

@section('page-header')
    <h1>
        {{ 'Prodcut Variation Management' }}
        <small>{{ 'Variation Creation' }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.products.variations.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-productvariation','enctype' => 'multipart/form-data']) }}

        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ 'Variation Creation'}}</h3>
            </div><!--box-header with-border-->
            <div class="box-body">
                <div class="form-group">
                {{ Form::label('variation_name','Variation Name', ['class' => 'col-lg-2 control-label required']) }}
                <div class="col-lg-10">
                    {{ Form::text('variation_name',null, ['class' => 'form-control box-size', 'placeholder' => 'Variation Name', 'required' => 'required']) }}
                </div>
                </div>
                <div class="form-group">
                        {{ Form::label('variation_values','Variation Values', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-9">
                        <div class="input_fields_container">
                            <div>
                                <input type="text" name="variation_value[]" class="form-control box-size">
                            </div><br>
                            
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button class="btn btn-sm btn-primary add_more_button">Add</button>
                    </div>
                </div>
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.variation.show', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
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
            $('.input_fields_container').append('<div><input type="text" name="variation_value[]" class="form-control box-size"> </div><br>'); //add input field
        }
    });  
    $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
@endsection
