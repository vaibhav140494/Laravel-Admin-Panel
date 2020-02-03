
@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.products.management') . ' | ' . 'Add Images')

@section('page-header')
    <h1>
        {{ trans('labels.backend.products.management') }}
        <small>{{ 'Add Product Images' }}</small>
    </h1>
@endsection
@section('content')

    {{ Form::open(['route'=>'admin.products.productimages.store','class' => 'form-horizontal', 'role' => 'form' , 'method' => 'post', 'id' => 'create-product','enctype' => 'multipart/form-data']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ 'Add Product Images' }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.products.partials.products-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->

            <div class="box-body">
                <div class="form-group">
                    
                    <div class="col-lg-10">
                        {{ Form::hidden('product_id',$pdetails[0]->id, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required','readonly'=>'true']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('product_name','Product Name', ['class' => 'col-lg-2 control-label required']) }}
                    <div class="col-lg-10">
                        {{ Form::text('product_name',$pdetails[0]->product_name, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required','readonly'=>'true']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('images',trans('labels.backend.products.table.image'), ['class' => 'col-lg-2 control-label required']) }}    
                    <div class="col-lg-10">
                        {{ Form::file('images[]', [ 'required' => 'required','multiple'=>'true']) }}
                    </div>
                </div>
                <div class="form-group">
                   
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.products.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection