@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.subcategories.management') . ' | ' . trans('labels.backend.subcategories.create'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.subcategories.management') }}
        <small>{{ trans('labels.backend.subcategories.create') }}</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.subcategories.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-subcategory']) }}
        <div class="box box-info">
        {{--{{ dd($cid ?? '') }}--}}
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.subcategories.create') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.subcategories.partials.subcategories-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!--box-header with-border-->
            
            <div class="box-body">
                <div class="form-group">
                    {{-- Including Form blade file --}}
                    @include("backend.subcategories.form")
                    <div class="edit-form-btn">
                        {{ link_to_route('admin.categories.id.get', trans('buttons.general.cancel'), ['id'=>$category->id], ['class' => 'btn btn-danger btn-md']) }}
                        {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                        <div class="clearfix"></div>
                    </div><!--edit-form-btn-->
                </div><!-- form-group -->
            </div><!--box-body-->
        </div><!--box box-success-->
    {{ Form::close() }}
@endsection
