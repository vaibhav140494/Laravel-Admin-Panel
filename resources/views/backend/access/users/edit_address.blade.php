@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>Edit Address</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($multiple_adder, ['route' => ['admin.access.user.address.update', $multiple_adder], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
    
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Address</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                <div class="form-group">
                    {{ Form::label('contact_person', 'Contact person name', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('contact_person', null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Person Name', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('contact_person_no', 'contact person no', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::number('contact_person_no', null, ['class' => 'form-control box-size', 'placeholder' => 'Contact Person No', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('country', 'Country', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('country', null, ['class' => 'form-control box-size', 'placeholder' => 'Country', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('state', 'State', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('state', null, ['class' => 'form-control box-size', 'placeholder' =>'State', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('city', 'City', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('city', null, ['class' => 'form-control box-size', 'placeholder' => 'City', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('address', 'Address', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::textarea('address', null, ['class' => 'form-control box-size', 'placeholder' => 'Address', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
                <div class="form-group">
                    {{ Form::label('pincode','Pincode', ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('pincode', null, ['class' => 'form-control box-size', 'placeholder' =>'Pincode', 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div>
           
                <div class="edit-form-btn">
                    {{ link_to_route('admin.access.user.edit', trans('buttons.general.cancel'), [$multiple_adder->user_id], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

       

    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script type="text/javascript">
        Backend.Utils.documentReady(function(){
            csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            Backend.Users.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            Backend.Users.init("edit");
        });
        window.onload = function () {
            Backend.Users.windowloadhandler();
        };
        
    </script>
@endsection
