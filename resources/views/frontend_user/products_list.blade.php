@include('frontend_user.header')
<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Sub category: {{$subcategory->subcategory_name}}</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
                            <li><a href="{{route('frontend.category.list')}}">{{$category->category_name}}</a></li>
                            <li><a href="{{route('frontend.subcategory.list',[$category->id])}}">{{$subcategory->subcategory_name}}</a></li>
							<li><span>Products</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		<!-- Start product Area -->
		
		<section id="product_area" class="section_padding">
			<div class="container">		
				<div class="row">
					
					<div class="col-md-12 text-center">
						<div class="section_title">	
							<!-- <span class="sub-title">Check Our All Products</span> -->
							<h2>Our Products</h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>
				<div class="shop_bar_tp fix">
					<div class="row">
						<div class="col-sm-3 col-xs-12 short_by_area text-center">
							<h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
						</div>

						<div class="col-sm-9 col-xs-12 show_area">
						<div class="short_by_inner">
								<label>sort by:</label>
								<select class="sort-select" name="sort-product">
									<option value="latest" selected>Latest products</option>
									<option value="price-asc">Price low-high</option>
									<option value="price-desc">Price high-low</option>
									<option value="name-asc">Name Ascending</option>
									<option value="name-desc">Name Descending</option>
									<option value="rating">By rating</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="filter-div">
							<!-- BEGIN FILTERS -->
							<!-- <div class="col-md-3"> -->
								
								<!-- BEGIN FILTER BY CATEGORY -->
									<h4>{{$category->category_name}}:</h4>
									@foreach($all_subcategory[$category->id] as $allsub)
									<div class="checkbox">
									<a href="{{route('frontend.products.list',[$allsub->id,$category->id])}}">{{$allsub->subcategory_name}}</a>
									</div>
									@endforeach
								<!-- END FILTER BY CATEGORY -->
								
								<div class="padding"></div>
								
								<!-- BEGIN FILTER BY PRICE -->
								<h4>By price:</h4>
								From:
								<input type="number" min="1" max="10000" value='0' class="slider" id="minRange">
								To:
								<input type="number" min="1"  max="10000" value="0" class="slider" id="maxRange">
								<div class="padding"></div>
								<button class="btn btn-primary icheck" btnid="range-btn"> Find</button>
								<div class="padding"></div>
								<h4>By Rating:</h4>
								<div>	
									<a rid=4 class="icheck">
										<li class="fa fa-star rating"></li>
										<li class="fa fa-star rating"></li>
										<li class="fa fa-star rating"></li>
										<li class="fa fa-star rating"></li>
										<li class="fa fa-star"></li>
										& Up
									</a>
									</div>
									<div>
										<a rid=3 class="icheck">
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star"></li>
											& Up
										</a>
									</div>
									<div>
										<a rid=2 class="icheck">
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star"></li>
											& Up
										</a>
									</div>
									<div>
										<a rid=1 class="icheck">
											<li class="fa fa-star rating"></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star "></li>
											<li class="fa fa-star"></li>
											& Up
										</a>
									</div>
									<div class="padding"></div>
									@foreach($product_var as $pvariation)
										<h4> By {{$pvariation->variation_name}} :</h4>
										@foreach($pvariation->variationValues as $pvar_values )
										<div class="checkbox">
											<label><input type="checkbox" class="icheck"  name="{{$pvariation->variation_name}}" vid='{{$pvar_values->variation_value}}'>{{$pvar_values->variation_value}}</label>
										</div>
										@endforeach
										<div class="padding"></div>
									@endforeach	
									<h4>By Availbility:</h4>							 
									<label><input type="checkbox" id="exclude_prod" class="icheck" > Exclude Out of stock Products</label>
								<!-- END FILTER BY PRICE -->
							<!-- </div> -->
							<!-- END FILTERS -->
						</div>
					</div>
					<div class="col-md-9 ">
						<div class="row products_append">
							<?php $c=0; ?>
								@if($prod->count()>0)
									@foreach($prod as $prod)		
										@if($c++ < 8)
											<div class="col-lg-4 col-md-4 col-sm-6">
												<div class="product-grid">
													<div class="product-image">
														<a href="{{route('frontend.product.details',[$prod->id,$subcategory->id,$category->id])}}">
															<img class="pic-1" src="{{url('storage/products/'.$prod->image)}}" alt="product image">
															<img class="pic-2" src="{{url('storage/products/'.$prod->image)}}" alt="product image">
														</a>
														<ul class="social">
															<li><a  class="venobox" href="{{url('storage/products/'.$prod->image)}}" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
															@if($prod->quantity > 0)
																@if(\Auth::user() && (in_array($prod->id,$wished_prod)) )
																<li><a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="{{$prod->id}}" class="remove-wishlist"><i class="fa fa-minus-circle"></i></a></li>
																@else
																<li><a href="javascript:void(0)" data-tip="Add to Wishlist" class="add-wishlist" pid="{{$prod->id}}"><i class="fa fa-shopping-bag"></i></a></li>
																@endif
																@if(\Auth::user() && (in_array($prod->id,$cart_item)))
																	<li><a href="{{route('frontend.cart.show')}}"  prid="{{$prod->id}}" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a></li>
																	@else
																	<li class="a_replace"><a href="javascript:void(0)"  name="{{$prod->id}}" class="cart-btn" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
																@endif
															@endif
														</ul>
													</div>
													<ul class="rating">
													@for($i=1; $i <= $prod->rating;$i++)
												
														<li class="fa fa-star"></li>
													@endfor	
													</ul>
													<div class="product-content">
														<h3 class="title"><a href="#">{{$prod->product_name}}</a></h3>
														<div class="price">
															@if($prod->discouted_price != $prod->price)
																{{$prod->discouted_price}}
																<span>{{$prod->price}}</span>
															@else
																{{$prod->price}}
															@endif	
														</div>
														@if($prod->quantity >0)
															@if(\Auth::user() && (in_array($prod->id,$cart_item)))
																<a href="{{route('frontend.cart.show')}}"  prid="{{$prod->id}}" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>
															@else
																<a class="add-to-cart cart-btn"  name="{{$prod->id}}" href="javascript:void(0)">+ Add To Cart</a>
															@endif
														@endif
													</div>
												</div>
											</div><!-- End Col -->
										@endif	
									@endforeach	
								@else
									Sorry No product found!!
								@endif
						</div>
					</div>
					
				</div>
			</div>
		</section>
		<!-- End product Area -->			
@include('frontend_user.footer')

<script>
	
	$(document).ready(function(){
		$(document).on('change','.sort-select',function(){
			value= $('.sort-select :selected').val();
			subid=<?php  echo $subcategory->id; ?>;
			catid=<?php  echo $category->id; ?>;
			url1='{{route("frontend.products.sort.list",[1,2])}}';
			splitArr=url1.split('/');
			splitArr=splitArr.reverse();
			splitArr[0]=catid;
			splitArr[1]=subid;
			splitArr=splitArr.reverse();
			url=splitArr.join('/');

			$.ajax({
				url:url,
				method:'post',
				dataType:'json',
				data:{
					"_token": "{{ csrf_token() }}",
					"value":value,
					"subid":subid,
					},
				success:function(data)
				{
					prod="";
					product=data['data'];
					if(product.length > 0){
						$.each(product,function(k,v){

							imgroute="{{url('storage/products/')}}";
							route='{{route("frontend.cart.show")}}';
							prodid=v.id;
								aroute='{{route("frontend.product.details",[1,$subcategory->id,$category->id])}}';
								aroute_arr=aroute.split('/');
								aroute_arr = aroute_arr.reverse();
								aroute_arr[2]=prodid;
								aroute_arr=aroute_arr.reverse();
								aroute_arr=aroute_arr.join('/');
								aroute=aroute_arr;
							imgroute +='/'+v.image;
							prod+='<div class="col-lg-4 col-md-4 col-sm-6"><div class="product-grid"><div class="product-image"><a href="'+aroute+'"><img class="pic-1" src="'+imgroute+'" alt="product image"><img class="pic-2" src="'+imgroute+'" alt="product image"></a><ul class="social"><li><a class="venobox" href="'+imgroute+'" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>';
							if(v.quantity>0){
								if(data['wish '+v.id] ==true)
								{
									prod+='<li><a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'+v.id+'" class="remove-wishlist"><i class="fa fa-minus-circle"></i></a></li>';
								}
						
								else
								{
									prod+='<li><a href="javascript:void(0)" data-tip="Add to Wishlist" class="add-wishlist" pid="'+v.id+'"><i class="fa fa-shopping-bag"></i></a></li>';
								}
								
								if(data['cart '+v.id] ==true)
								{
									prod+='<li><a href="'+route+'"  prid="'+v.id+'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a></li>';
								}
								else
								{
									prod+='<li class="a_replace"><a href="javascript:void(0)"  name="'+v.id+'" class="cart-btn" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>';
								}
								
							}
							prod+='</ul></div><ul class="rating">';
							for(i=1;i<= v.rating;i++)
							{
								prod+='<li class="fa fa-star"></li> ';
							}
							prod+='</ul><div class="product-content"><h3 class="title"><a href="#">'+v.product_name+'</a></h3><div id="'+v.id+'"class="price">';
							
							if(v.discouted_price !=v.price){
								prod+=v.discouted_price+'<span>'+v.price+'</span>';
							}
							else
							{
								prod+=v.price;
							}
							prod+='</div>';
							if(v.quantity > 0){
								if(data['cart '+v.id] ==true)
								{
									prod+='<a href="{{route('frontend.cart.show')}}"  prid="'+v.id+'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';

								}
								else
								{
									prod+='<a class="add-to-cart cart-btn"  name="'+v.id+'" href="javascript:void(0)">+ Add To Cart</a>';		
								}
							}
							prod+='</div></div></div>';
							
						});
						$('.products_append').html(prod);

					}
					else
					{
						$('.products_append').html("Sorry No product found!!");
					}
					
					
				}
			});

		});
		$(document).on('click change','.icheck',function(){
			 varname=[];
			var exclude=$('#exclude_prod:checked').val();
				var rating=$(this).attr('rid');
				if(rating !=null)
				varname.push({name:'rating',value:rating});
				// alert(rating);	
			 if(exclude=="on")
			 {
				varname.push({name:"exclude",value:exclude});
			 }
			 if($(this).attr('btnid')=='range-btn')
			 {
				varname.push({name:'minRange',value:$('#minRange').val()});
				varname.push({name:'maxRange',value:$('#maxRange').val()});
				
			 }
            $.each($("input[vid]:checked"), function(){
				vid =$(this).attr('vid');
				vname=$(this).attr('name');
				varname.push({name:vname,value:vid});
            });
			
			console.log(varname);

			subid=<?php  echo $subcategory->id; ?>;
			catid=<?php  echo $category->id; ?>;
			url1='{{route("frontend.products.sort.list",[1,2])}}';
			splitArr=url1.split('/');
			splitArr=splitArr.reverse();
			splitArr[0]=catid;
			splitArr[1]=subid;
			splitArr=splitArr.reverse();
			url=splitArr.join('/');

			$.ajax({
			url:url,
				dataType:'json',
				method:'post',
				data:{
					"_token": "{{ csrf_token() }}",
					'varname':varname,
				},
				success:function(data)
				{
					prod="";
					product=data['data'];
					if(product.length > 0){
						$.each(product,function(k,v){

							imgroute="{{url('storage/products/')}}";
							route='{{route("frontend.cart.show")}}';
							prodid=v.id;
								aroute='{{route("frontend.product.details",[1,$subcategory->id,$category->id])}}';
								aroute_arr=aroute.split('/');
								aroute_arr = aroute_arr.reverse();
								aroute_arr[2]=prodid;
								aroute_arr=aroute_arr.reverse();
								aroute_arr=aroute_arr.join('/');
								aroute=aroute_arr;
							imgroute +='/'+v.image;
							prod+='<div class="col-lg-4 col-md-4 col-sm-6"><div class="product-grid"><div class="product-image"><a href="'+aroute+'"><img class="pic-1" src="'+imgroute+'" alt="product image"><img class="pic-2" src="'+imgroute+'" alt="product image"></a><ul class="social"><li><a class="venobox" href="'+imgroute+'" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>';
							if(v.quantity>0){
								if(data['wish '+v.id] ==true)
								{
									prod+='<li><a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="'+v.id+'" class="remove-wishlist"><i class="fa fa-minus-circle"></i></a></li>';
								}
						
								else
								{
									prod+='<li><a href="javascript:void(0)" data-tip="Add to Wishlist" class="add-wishlist" pid="'+v.id+'"><i class="fa fa-shopping-bag"></i></a></li>';
								}
								
								if(data['cart '+v.id] ==true)
								{
									prod+='<li><a href="'+route+'"  prid="'+v.id+'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a></li>';
								}
								else
								{
									prod+='<li class="a_replace"><a href="javascript:void(0)"  name="'+v.id+'" class="cart-btn" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>';
								}
								
							}
							prod+='</ul></div><ul class="rating">';
							for(i=1;i<= v.rating;i++)
							{
								prod+='<li class="fa fa-star"></li> ';
							}
							prod+='</ul><div class="product-content"><h3 class="title"><a href="#">'+v.product_name+'</a></h3><div id="'+v.id+'"class="price">';
							
							if(v.discouted_price !=v.price){
								prod+=v.discouted_price+'<span>'+v.price+'</span>';
							}
							else
							{
								prod+=v.price;
							}
							prod+='</div>';
							if(v.quantity > 0){
								if(data['cart '+v.id] ==true)
								{
									prod+='<a href="{{route('frontend.cart.show')}}"  prid="'+v.id+'" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>';

								}
								else
								{
									prod+='<a class="add-to-cart cart-btn"  name="'+v.id+'" href="javascript:void(0)">+ Add To Cart</a>';		
								}
							}
							prod+='</div></div></div>';
							
						});
						$('.products_append').html(prod);

					}
					else
					{
						$('.products_append').html("Sorry No product found!!");
					}
					
				}
			});

		});
	});
</script>
