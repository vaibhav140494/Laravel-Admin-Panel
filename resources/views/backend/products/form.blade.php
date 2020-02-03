<div class="box-body">
   
    <div class="form-group">
         {{ Form::label('category_id', trans('labels.backend.categories.title'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
                @if(isset($products->id))
                <select name="category_id" id="category_id" class="form-control box-size">
                <option value="">Select Category</option>
                        @foreach($category_list as $category)
                        @if($products->category_id == $category->id)
                        <option value="{{ $category->id}}" selected>{{ $category->category_name}}</option>
                        @else
                        <option value="{{ $category->id}}">{{ $category->category_name}}</option>
                        @endif
                        @endforeach
                        
                </select>
                @else
                <select name="category_id" id="category_id" class="form-control box-size">
                    <option value="">Select Category</option>
                        @foreach($category_list as $category)
                        <option value="{{ $category->id}}">{{ $category->category_name}}</option>
                        @endforeach
                        
                </select>
                @endif
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('subcategory_id','Sub Categories' , ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        
                @if(isset($products->id))
                <select name="subcategory_id" id="subcategory_id" class="form-control box-size">
                        @foreach($subcategory_name as $subcategory)
                            @if($products->subcategory_id == $subcategory->id)
                                <option value="{{ $subcategory->id}}" selected>{{ $subcategory->subcategory_name}}</option>
                        @else
                                <option value="{{ $subcategory->id}}">{{ $subcategory->subcategory_name}}</option>
                        @endif
                @endforeach
                </select>
                @else
                <select name="subcategory_id" id="subcategory_id" class="form-control box-size">
                </select>
                @endif
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('sku', trans('labels.backend.products.table.sku'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::number('sku', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.sku'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('product_name',trans('labels.backend.products.table.product_name'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::text('product_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.product_name'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('quantity',trans('labels.backend.products.table.quantity'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::number('quantity', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.quantity'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('type',trans('labels.backend.products.table.type'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        <select name="type" id="type" class="form-control box-size">
        <option value="1">Simple Product</option>
        <option value="2">Congigurable Product</option>
        </select>
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('price',trans('labels.backend.products.table.price'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::number('price', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.price'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('discouted_price',trans('labels.backend.products.table.discouted_price'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::number('discouted_price', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.discouted_price'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('specification',trans('labels.backend.products.table.specification'), ['class' => 'col-lg-2 control-label required']) }}    
        <div class="col-lg-10">
        {{ Form::text('specification', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.products.table.specification'), 'required' => 'required']) }}
        </div>
    </div>
    <div class="form-group">
         {{ Form::label('image',trans('labels.backend.products.table.image'), ['class' => 'col-lg-2 control-label required']) }}    
         <div class="col-lg-10">
        {{ Form::file('image', [ 'required' => 'required']) }}
        @if( isset($products))
            
            <div style="margin-top:20px;">
            {{ Html::image('storage/products/'.$products->image, 'alt ', array('class' => 'css-class img-thumbnail', 'height' => '100px','width'=>'100px')) }}
            </div>
       @endif
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
            $("#category_id").change(function(){
                var selected_cat=$(this).children("option:selected").val();
                $.ajax({
                        method: 'GET',
                        url: '{{route("admin.products.ajax.subcategrory")}}',
                        data : { 'id' : selected_cat },
                        success: function(data){
                            data = JSON.parse(data);
                            var html = "";
                            for (var i = 0; i < data.length; i++) {
                            html = html + "<option value='" + data[i].id + "'>" + data[i].subcategory_name + "</option>";
                                    };
                            $("#subcategory_id").html(html);
                            }
                        });    
            });
        });
    </script>
@endsection
