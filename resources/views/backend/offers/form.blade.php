<div class="box-body">
    <div class="form-group">
        <!-- Create Your Field Label Here -->
        <!-- Look Below Example for reference -->
         {{ Form::label('offer_name', trans('labels.backend.offers.table.offer_name'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <!-- Create Your Input Field Here -->
            <!-- Look Below Example for reference -->
             {{ Form::text('offer_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.offer_name'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('offer_code', trans('labels.backend.offers.table.offer_code'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::text('offer_code', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.offer_code'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('offer_type', trans('labels.backend.offers.table.offer_type'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
            <select name="offer_type" id="offer_type" class="form-control box-size">
                
                <option value="1">FLAT DISCOUNT</option>
                <option value="2">PERCENTAGE DISCOUNT</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('offer_value', trans('labels.backend.offers.table.offer_value'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('offer_value', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.offer_value'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('offer_desc', trans('labels.backend.offers.table.offer_desc'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::textarea('offer_desc', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.offer_desc'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('min_order_value', trans('labels.backend.offers.table.min_order_value'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('min_order_value', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.min_order_value'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('max_discount', trans('labels.backend.offers.table.max_discount'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('max_discount', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.max_discount'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('min_offer_amount', trans('labels.backend.offers.table.min_offer_amount'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('min_offer_amount', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.min_offer_amount'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('is_active', trans('labels.backend.offers.table.is_active'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('is_active', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.is_active'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('start_date', trans('labels.backend.offers.table.start_date'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::date('start_date', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.start_date'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('end_date', trans('labels.backend.offers.table.end_date'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::date('end_date', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.end_date'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('no_of_counts', trans('labels.backend.offers.table.no_of_counts'), ['class' => 'col-lg-2 control-label required']) }}

        <div class="col-lg-10">
        {{ Form::number('no_of_counts', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.offers.table.no_of_counts'), 'required' => 'required']) }}
        </div>
    </div>
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
