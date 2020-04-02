@include('frontend_user.header')

		<!-- Start Slider Area -->
		<section id="slider_area" class="text-center">
			<div class="slider_active owl-carousel">
				<div class="single_slide" style="background-image: url({{url('frontend/img/slider/1.jpg')}}); background-size: cover; background-position: center;">
					<div class="container">	
						<div class="single-slide-item-table">
							<div class="single-slide-item-tablecell">
								<div class="slider_content text-left slider-animated-1">						
									<p class="animated">New Year 2019</p>
									<h1 class="animated">best shopping</h1>
									<h4 class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam <br> vitae posuere est Sed placerat ligula </h4>
									<!-- <a href="#" class="btn main_btn animated">Shop Now</a> -->
									<a href="{{route('frontend.category.list')}}" class="btn main_btn coll_btn animated">Collection</a>
								</div>
							</div>

						</div>						
					</div>
				</div>
				
				<div class="single_slide" style="background-image: url({{url('frontend/img/slider/2.jpg')}}); background-size: cover; background-position: center ;">
					<div class="container">		
						<div class="single-slide-item-table">
							<div class="single-slide-item-tablecell">
								<div class="slider_content text-center slider-animated-2">						
									<p class="animated">Women fashion</p>
									<h1 class="animated">New Collection</h1>
									<h4 class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam <br> vitae posuere est Sed placerat ligula </h4>
									<!-- <a href="#" class="btn main_btn animated">Shop Now</a> -->
									<a href="{{route('frontend.category.list')}}" class="btn main_btn coll_btn animated">Collection</a>
								</div>
							</div>
						</div>	
					</div>
				</div>
				
				<div class="single_slide" style="background-image: url({{url('frontend/img/slider/3.jpg')}}); background-size: cover; background-position: center ;">
					<div class="container">
						<div class="single-slide-item-table">
							<div class="single-slide-item-tablecell">
								<div class="slider_content text-right slider-animated-3">						
									<p class="animated">Men Collection</p>
									<h1 class="animated">New Collection</h1>
									<h4 class="animated">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam <br> vitae posuere est Sed placerat ligula </h4>
									<!-- <a href="#" class="btn main_btn animated">Shop Now</a> -->
									<a href="{{route('frontend.category.list')}}" class="btn main_btn coll_btn animated">Collection</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Slider Area -->		
	
		<!--  Promo ITEM STRAT  -->
		<section id="promo_area" class="section_padding">
		
			<div class="container">
			<div class="row">
					<div class="col-md-12 text-center">
						<div class="section_title">	
							<!-- <span class="sub-title">Check Our All Products</span> -->
							<h2>Featured Categories</h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>
				<div class="row row-flex">
				@if($category_featured->count()>0)
					<?php $i=0; ?>
					@foreach($category_featured as $cat)
						@if($i++<= 3)
							<div class="col-lg-4 col-md-6 col-sm-12">							
								<div class="single_promo">
									<img src=" {{url('storage/category/',$cat->category_image)}}" alt="promo image">
									<div class="box-content">
										<div class="promo-content">
											<h3 class="title">{{$cat->category_name}}</h3>
											<span class="post">2020 Collection</span>
											<p>{{\Illuminate\Support\Str::limit($cat->category_desc, 80, $end='...') }}</p>
										
											<a class="shop_now_btn" href="{{route('frontend.subcategory.list',['id'=>$cat->id])}}">Shop Now</a>
										</div>
									</div>
								</div>													
							</div><!--  End Col -->	
						@endif					
					
					@endforeach
				@else
				<?php $i=0; ?>
				
					@foreach($category as $cat)
						@if($i++<= 3)
							<div class="col-lg-4 col-md-6 col-sm-12">							
								<div class="single_promo">
									<img src=" {{url('storage/category/'.$cat->category_image)}}" alt="promo image">
									<div class="box-content">
										<div class="promo-content">
											<h3 class="title">{{$cat->category_name}}</h3>
											<!-- <span class="post">2020 Collection</span> -->
											<p>{{\Illuminate\Support\Str::limit($cat->category_desc, 100, $end='...') }}</p>
											
											
											<a class="shop_now_btn" href="{{route('frontend.subcategory.list',['id'=>$cat->id])}}">Shop Now</a>
										</div>
									</div>
								</div>													
							</div><!--  End Col -->	
						@endif					
					
					@endforeach
				@endif
					
				</div>			
			</div>		
		</section>
		<!--  Promo ITEM END -->	
		 

		<!-- Start product Area -->
		<section id="product_area" class="section_padding">
			<div class="container">		
				<div class="row row-flex">
					<div class="col-md-12 text-center">
						<div class="section_title">	
							<span class="sub-title">Check Our All Products</span>
							<h2>Our Products</h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>
			
				<div class="text-center">
					<div class="product_filter">
						<ul>
							<li class=" active filter"  data-filter="all">All</li>
							@foreach($category_featured as $cat_fet)
							<li class="filter"   id="{{$cat_fet->id}}"name=" {{$cat_fet->category_name}}" data-filter=".{{$cat_fet->category_name}}">{{$cat_fet->category_name}}</li>
							@endforeach
							<!-- <li class="filter" data-filter=".bslr">Bestseller</li>
							<li class="filter" data-filter=".ftrd">Featured</li> -->
						</ul>
					</div>
					
					<div class="product_item">
						<div class="row row-flex filter-products">
							@foreach($product as $prod)					
								<div class="col-lg-3 col-md-4 col-sm-6 mix ">
									<div class="product-grid">
										<div class="product-image">
											<a href="{{route('frontend.product.details',[$prod->id,$prod->subcategory_id,$prod->category_id])}}">
												<img class="pic-1" src=" {{url('storage/products/'.$prod->image)}}" alt="product image">
												@if(isset($prod->other[0]))
												<img class="pic-2" src="{{url('storage/productimages/'.$prod->other[0] )}}" alt="product image">
												@else
												<img class="pic-2" src=" {{url('storage/products/'.$prod->image)}}" alt="product image">
												@endif
											</a>
											<ul class="social">
											
												<li><a href="{{url('storage/products/'.$prod->image)}}" class="venobox" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
												@if($prod->quantity > 0)
													@if(\Auth::user() && (in_array($prod->id,$wished_prod)) )
														<li><a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="{{$prod->id}}" class="remove-wishlist" ><i class="fa fa-minus-circle"></i></a></li>
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
											@if($prod->quantity > 0)
												@if(\Auth::user() && (in_array($prod->id,$cart_item)))
													<a href="{{route('frontend.cart.show')}}"  prid="{{$prod->id}}" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>
												@else
													<a class="add-to-cart cart-btn"  name="{{$prod->id}}" href="javascript:void(0)">+ Add To Cart</a>
												@endif
											@else
												<a class="add-to-cart"> Out of Stocks</a>
											@endif
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End product Area -->

		<!-- Special Offer Area -->
		<div class="special_offer_area gray_section section_padding">
			<div class="container">
				<div class="row row-flex">
					<div class="col-md-6">
						<div class="special_img_wrap text-center">						
							<div class="special_img">
								<img src=" {{url('/frontend/img/special.png')}}" width="370" alt="Offer Image" class="img-responsive">
								<span class="off_baudge text-center">40% <br /> Off</span>						
							</div>
						</div>
					</div>			

					<div class="col-md-6 text-left">
						<div class="special_info">			
							<span>Hurry Up! Offer Ends In</span>
							<h3>Winter Flash Sale <br>End Soon</h3>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy Lorem Ipsum</p>																		
							<div id="countdown" class="text-center"></div>	
							<div class="clearfix"></div>
							<a href="#" class="btn main_btn">Shop Now</a>					
						</div>
					</div>
				</div>

			</div>
		</div> <!-- End Special Offer Area -->

		<!-- Start Featured product Area -->
		<section id="featured_product" class="featured_product_area section_padding">
			<div class="container">		
				<div class="row row-flex">
					<div class="col-md-12 text-center">
						<div class="section_title">	
							<span class="sub-title">Check Our Featured Products</span>
							<h2>Featured Products</h2>
							<div class="divider"></div>							
						</div>
					</div>
				</div>

				<div class="row text-center">
					@if(isset($featured_prod))
						<?php $c=0; ?>
						@foreach($featured_prod as $prod)		
							@if($c++ < 8)
								<div class="col-lg-3 col-md-4 col-sm-6">
									<div class="product-grid">
										<div class="product-image">
											<a href="{{route('frontend.product.details',[$prod->id,$prod->subcategory_id,$prod->category_id])}}">
												<img class="pic-1" src="{{url('storage/products/'.$prod->image)}}" alt="product image">
												@if(isset($prod->other[0]))
												<img class="pic-2" src="{{url('storage/productimages/'.$prod->other[0] )}}" alt="product image">
												@else
												<img class="pic-2" src=" {{url('storage/products/'.$prod->image)}}" alt="product image">
												@endif
											</a>
											<ul class="social">
												<li><a  class="venobox" href="{{url('storage/products/'.$prod->image)}}" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
												@if($prod->quantity > 0)
													@if(\Auth::user() && (in_array($prod->id,$wished_prod)) )
														<li><a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="{{$prod->id}}" class="remove-wishlist" ><i class="fa fa-minus-circle"></i></a></li>
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
											@if($prod->quantity > 0)
												@if(\Auth::user() && (in_array($prod->id,$cart_item)))
													<a href="{{route('frontend.cart.show')}}"  prid="{{$prod->id}}" class="cart-btn" data-tip="view Cart"><i class="ti-shopping-cart"></i></a>
												@else
													<a class="add-to-cart cart-btn"  name="{{$prod->id}}" href="javascript:void(0)">+ Add To Cart</a>
												@endif
											@else
												<a class="add-to-cart"> Out of Stocks</a>
											@endif
										</div>
									</div>
								</div><!-- End Col -->
							@endif	
						@endforeach	
					@endif
						 
				</div>
			</div> 
		</section>
		<!-- End Featured Products Area -->

		<!-- Testimonials Area -->
		<section id="testimonials" class="testimonials_area" style="background: url( {{url('frontend/img/testimonial-bg.jpg')}}); background-size: cover; background-attachment: fixed;">
			<div class="container">
				<div class="row row-flex">
					<div class="col-md-8 center-block">
						<div id="testimonial-slider" class="owl-carousel text-center">
							@if(isset($product_review_random))
								@foreach($product_review_random as $p_review)
									<div class="testimonial">
										<div class="testimonial-content">
											<p class="description">
											{{$p_review->review}}
											</p>
											<small class="post">
													@for($i=0;$i< $p_review->rating;$i++)
														<li class="fa fa-star"></li>
														@endfor
													</small>
											
											<div class="test-bottom text-center">
												<div class="test-des-area">
													<div class="pic">
														<img src="{{url('/frontend/img/testimonial/1.jpg')}}" alt="">
													</div>
													<h3 class="testimonial-title">
													{{$p_review-> fname}}  {{$p_review-> lname}}
													</h3>	
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@else
								no reviews
							@endif

							
						</div>
					</div>
				</div>
			</div>
		</section> <!-- End STestimonials Area -->		
		
        <!--  Brand -->
		<section id="brand_area" class="text-center">
			<div class="container">					
				<div class="row">
					<div class="col-sm-12">
						<div class="brand_slide owl-carousel">
							@foreach($all_category as $cat)
								<div class="item text-center" style="padding: 0 10px;"> <a href="{{route('frontend.subcategory.list',[$cat->id])}}"><img src="{{url('storage/category/'.$cat->category_image)}}" alt="" class="img-thumbnail" width="70" height="70"/></a> </div>
							@endforeach
							
						</div>
					</div>
				</div>
			</div>        
		</section>        
        <!--   Brand end  -->	
		
        <!--  Process -->
		<section class="process_area section_padding">
			<div class="container">
				<div class="row text-center">		
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-process">
							<!-- process Icon -->
							<div class="picon"><i class="ti-truck"></i></div>
							<!-- process Content -->
							<div class="process_content">
								<h3>Free Shipping</h3>
								<p>Best Shipping Service</p>
							</div>
						</div>	
					</div>	<!-- End Col -->				

					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-process">
							<!-- process Icon -->
							<div class="picon"><i class="ti-credit-card"></i></div>
							<!-- process Content -->
							<div class="process_content">
								<h3>Cash On Delivery</h3>
								<p>Fast Delivery Method</p>
							</div>
						</div>	
					</div>	<!-- End Col -->				

					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-process">
							<!-- process Icon -->
							<div class="picon"><i class="ti-headphone-alt"></i></div>
							<!-- process Content -->
							<div class="process_content">
								<h3>Support 24/7</h3>
								<p>24 Hours a Day</p>
							</div>
						</div>	
					</div>	<!-- End Col -->				

					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="single-process">
							<!-- process Icon -->
							<div class="picon"><i class="ti-alarm-clock"></i></div>
							<!-- process Content -->
							<div class="process_content">
								<h3>30 Days Return</h3>
								<p>Simply Return 30 Days</p>
							</div>
						</div>	
					</div>	<!-- End Col -->
					
				</div>
			</div>
		</section>
        <!--  End Process -->
		
	@include('frontend_user.footer')
	<script>
		$(document).ready(function(){
			$('.filter').click(function(){
				name=$(this).attr('name');
				id=$(this).attr('id');
				$.ajax({
					url:'{{route("frontend.index.ajax")}}',
					dataType:'json',
					method:'post',
					data:{
						'_token':"{{ csrf_token() }}",
						'id':id},
					success:function(data)
					{
						product=data['data'];
						prod="";
						$.each(product,function(k,v){
						imgroute= "{{url('storage/products/')}}";
							prodid=v.id;
							aroute='{{route("frontend.product.details",[1,2,3])}}';
							aroute_arr=aroute.split('/');
							aroute_arr = aroute_arr.reverse();
							aroute_arr[2] = prodid;
							aroute_arr=aroute_arr.reverse();
							aroute_arr=aroute_arr.join('/');
							aroute=aroute_arr;
							imgroute +='/'+v.image;
						
							prod+='<div class="col-lg-3 col-md-4 col-sm-6 mix Electronics"><div class="product-grid"><div class="product-image"><a href="'+aroute+'"><img class="pic-1" src="'+imgroute+'" alt="product image"><img class="pic-2" src="'+imgroute+'" alt="product image"></a><ul class="social"><li><a class="venobox" href="'+imgroute+'" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>';
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
							else
							{
								prod+='<a class="add-to-cart"> Out of Stocks</a>';
							}
							prod+='</div></div></div>';
							console.log('\n');
						console.log(prod);
						});
						$('.filter-products').html(prod);
					}
				});
			});
		});
		</script>