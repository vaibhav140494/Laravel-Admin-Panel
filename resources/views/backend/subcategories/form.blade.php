<div class="box-body">

@if(isset($category))
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('name', trans('labels.backend.categories.table.name'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
        <div class="form-group-a">
            
            <select class="form-control" name="category_id">
           
            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
           
            </select>

        </div>        

        </div><!--col-lg-10-->
    </div><!--form-group-->
    @endif
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('name', trans('labels.backend.subcategories.table.name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
         {{ Form::text('subcategory_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subcategories.table.name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('description', trans('labels.backend.subcategories.table.desc'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::textarea('subcategory_desc', null,['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.subcategories.table.desc')]) }}

        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
        {{ Form::label('active', trans('labels.backend.categories.table.active'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::checkbox('active',null,true) }} 

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
