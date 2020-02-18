@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.categories.management') . ' | ' . trans('labels.backend.categories.create'))

@section('page-header')
    <h1>
        User Management
        <small>Add User Address</small>
    </h1>
@endsection

@section('content')
    {{ Form::open([ 'route' => array('admin.access.user.address.store',$id), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add-address','enctype' => 'multipart/form-data']) }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Address</h3>

                <div class="box-tools pull-right">
                @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                <div class="box-body">
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('contact_person', 'Contact Person', ['class' => 'col-lg-2 control-label']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('contact_person', null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Person Name']) }} 
            

        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('contact_person_no', 'Contact Person No', ['class' => 'col-lg-2 control-label ']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('contact_person_no', null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Person No']) }} 
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('country', 'Country', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => 'Country', 'required' => 'required']) }} 
            <span style="color:red;">{{$errors->register->first('country') ?? ''}}</span>
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('state', 'State', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('state', null, ['class' => 'form-control box-size', 'placeholder' => 'State', 'required' => 'required']) }} 
            <span style="color:red;">{{$errors->register->first('state') ?? ''}}</span>
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('city', 'City', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => 'city', 'required' => 'required']) }} 
            <span style="color:red;">{{$errors->register->first('city') ?? ''}}</span>
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('address', 'Address', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            {{ Form::textarea('address', null,['class' => 'form-control box-size', 'placeholder' => 'Address']) }}
            <span style="color:red;">{{$errors->register->first('address') ?? ''}}</span>
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('pincode', 'Pincode', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
           
            {{ Form::number('pincode', null, ['class' => 'form-control box-size', 'placeholder' => 'Pincode', 'required' => 'required']) }} 
            <span style="color:red;">{{$errors->register->first('pincode') ?? ''}}</span>
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('default_address_chkbx', 'Make this as default Address', ['class' => 'col-lg-2 control-label required']) }} 

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
            <input type="checkbox" name="mk_default_address_admin" >
            
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

                    <div class="edit-form-btn">
                        {{ link_to_route('admin.access.user.edit', trans('buttons.general.cancel'), [$id], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
