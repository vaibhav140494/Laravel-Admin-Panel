<div class="box-body">
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('name', trans('labels.backend.categories.table.name'), ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('category_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.categories.table.name'), 'required' => 'required']) }} 
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('Description', trans('labels.backend.categories.table.desc'), ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::textarea('category_desc', null,['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.categories.table.desc')]) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('image', trans('labels.backend.categories.table.image'), ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10 custom-file">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::file('category_image', null, ['class' => 'custom-file-input box-size', 'required' => 'required']) }} 
                @if( isset($categories))
            
                    <div style="margin-top:20px;">
                    {{ Html::image('storage/category/'.$categories->category_image, 'alt ', array('class' => 'css-class img-thumbnail', 'height' => '300px','width'=>'300px')) }}
                    </div>
               @endif
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('active', trans('labels.backend.categories.table.active'), ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10 checkbox">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::checkbox('active','active',true) }} 
        </div><!--col-lg-10-->
    </div><!--form-group-->
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
