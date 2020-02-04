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
				<div class="row">
				@if($category_featured->count()>0)
					<?php $i=0; ?>
					@foreach($category_featured as $cat)
						@if($i++<= 3)
							<div class="col-lg-4 col-md-6 col-sm-12">							
								<div class="single_promo">
									<img src=" {{url('/frontend/img/promo/1.jpg')}}" alt="promo image">
									<div class="box-content">
										<div class="promo-content">
											<h3 class="title">{{$cat->category_name}}</h3>
											<span class="post">2020 Collection</span>
											<p>{{$cat->category_desc}}</p>
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
											<p>{{$cat->category_desc}}</p>
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
				<div class="row">
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
							<li class=" active filter" data-filter="all">All</li>
							<li class="filter" data-filter=".sale">Sale</li>
							<li class="filter" data-filter=".bslr">Bestseller</li>
							<li class="filter" data-filter=".ftrd">Featured</li>
						</ul>
					</div>
					
					<div class="product_item">
						<div class="row">
						@if(isset($product))
							@foreach($product as $prod)					
								<div class="col-lg-3 col-md-4 col-sm-6 mix ">
									<div class="product-grid">
										<div class="product-image">
											<a href="#">
												<img class="pic-1" src=" {{url('storage/products/'.$prod->image)}}" alt="product image">
												<img class="pic-2" src="{{url('storage/products/'.$prod->image)}}" alt="product image">
											</a>
											<ul class="social">
												<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
												<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
												<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
											</ul>
											<!-- <span class="product-new-label">Sale</span> -->
										</div>
										
										<ul class="rating">
											@for($i=0;$i<$product_review->count();$i++)
												@if($product_review[$i]->product_id==$prod->id)
													@for($j=0;$j<$product_review[$i]->rating;$j++)
													<li class="fa fa-star"></li>
													@endfor
												@endif
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
											<a class="add-to-cart" href="#">+ Add To Cart</a>
										</div>
									</div>
								</div>
							@endforeach
						@endif
							
						
							<!-- <div class="col-lg-3 col-md-4 col-sm-6 mix ftrd">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/3.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/4.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">-20%</span>				
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>
									
							<div class="col-lg-3 col-md-4 col-sm-6 mix">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/5.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/6.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">Sale</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star disable"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>

							
							<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/7.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/8.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">New</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>			
							
							
							<div class="col-lg-3 col-md-4 col-sm-6 mix ftrd">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/5.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/6.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">Sale</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>			
							
							<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/1.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/2.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">-30%</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>		
							
							<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/7.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/8.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">Sale</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>	

							
							<div class="col-lg-3 col-md-4 col-sm-6 mix sale bslr">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src="{{url('/frontend/img/product/3.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/4.jpg')}}" alt="product image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<span class="product-new-label">-50%</span>
									</div>
									<ul class="rating">
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
										<li class="fa fa-star"></li>
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">Product Title</a></h3>
										<div class="price">$16.00
											<span>$20.00</span>
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div>			 -->
		
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End product Area -->

		<!-- Special Offer Area -->
		<div class="special_offer_area gray_section section_padding">
			<div class="container">
				<div class="row">
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
				<div class="row">
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
						@foreach($featured_prod as $fprod)		
							@if($c++ < 8)
								<div class="col-lg-3 col-md-4 col-sm-6">
									<div class="product-grid">
										<div class="product-image">
											<a href="#">
												<img class="pic-1" src="{{url('/frontend/img/product/3.jpg')}}" alt="product image">
												<img class="pic-2" src="{{url('/frontend/img/product/4.jpg')}}" alt="product image">
											</a>
											<ul class="social">
												<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
												<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
												<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
											</ul>
											<span class="product-new-label">-20%</span>				
										</div>
										<ul class="rating">
											<li class="fa fa-star"></li>
											<li class="fa fa-star"></li>
											<li class="fa fa-star"></li>
											<li class="fa fa-star"></li>
											<li class="fa fa-star"></li>
										</ul>
										<div class="product-content">
											<h3 class="title"><a href="#">{{$fprod->product_name}}</a></h3>
											<div class="price">
												@if($fprod->discouted_price != $fprod->price)
													{{$fprod->discouted_price}}
													<span>{{$fprod->price}}</span>
												@else
													{{$fprod->price}}
												@endif
											
												
											</div>
											<a class="add-to-cart" href="#">+ Add To Cart</a>
										</div>
									</div>
								</div><!-- End Col -->
							@endif	
						@endforeach	
					@endif
					<!-- <div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="{{url('/frontend/img/product/5.jpg')}}" alt="product image">
									<img class="pic-2" src="{{url('/frontend/img/product/6.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">Sale</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star disable"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>

					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="{{url('/frontend/img/product/7.jpg')}}" alt="product image">
									<img class="pic-2" src="{{url('/frontend/img/product/8.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">New</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>			
					
					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
                                    <img class="pic-2" src="{{url('/frontend/img/product/6.jpg')}}" alt="product image">
									<img class="pic-1" src="{{url('/frontend/img/product/5.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">Sale</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>			
					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="{{url('/frontend/img/product/1.jpg')}}" alt="product image">
									<img class="pic-2" src="{{url('/frontend/img/product/2.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">-30%</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>		
					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="{{url('/frontend/img/product/7.jpg')}}" alt="product image">
									<img class="pic-2" src="{{url('/frontend/img/product/8.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">Sale</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>	

					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="#">
									<img class="pic-1" src="{{url('/frontend/img/product/3.jpg')}}" alt="product image">
									<img class="pic-2" src="{{url('/frontend/img/product/4.jpg')}}" alt="product image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<span class="product-new-label">-50%</span>
							</div>
							<ul class="rating">
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
								<li class="fa fa-star"></li>
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">Product Title</a></h3>
								<div class="price">$16.00
									<span>$20.00</span>
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div>		 -->
				</div>
			</div>
		</section>
		<!-- End Featured Products Area -->

		<!-- Testimonials Area -->
		<section id="testimonials" class="testimonials_area" style="background: url( {{url('frontend/img/testimonial-bg.jpg')}}); background-size: cover; background-attachment: fixed;">
			<div class="container">
				<div class="row">
					<div class="col-md-8 center-block">
						<div id="testimonial-slider" class="owl-carousel text-center">
							@if(isset($product_review_random))
								@foreach($product_review_random as $p_review)
									<div class="testimonial">
										<div class="testimonial-content">
											<p class="description">
											{{$p_review->review}}
											</p>
											
											<div class="test-bottom text-center">
												<div class="test-des-area">
													<div class="pic">
														<img src="{{url('/frontend/img/testimonial/1.jpg')}}" alt="">
													</div>
													<h3 class="testimonial-title">
													{{$p_review-> fname}}  {{$p_review-> lname}}
													</h3>
													
													<small class="post">
													@for($i=0;$i< $p_review->rating;$i++)
														<li class="fa fa-star"></li>
														@endfor
													</small>
													
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
							<!-- <div class="testimonial">
								<div class="testimonial-content">
									<p class="description">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam risus felis, bibendum 
										eu nibh et, finibus semper sem. Nam at tincidunt leo. Nam sit amet mauris et lorem 
										varius lobortis eu a nisl.
									</p>
									<div class="test-bottom text-center">
										<div class="test-des-area">
											<div class="pic">
												<img src="{{url('/frontend/img/testimonial/2.jpg')}}" alt="">
											</div>
											<h3 class="testimonial-title">Susana</h3>
											<small class="post"> - Themesvila</small>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="testimonial">
								<div class="testimonial-content">
									<p class="description">
										Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam risus felis, bibendum 
										eu nibh et, finibus semper sem. Nam at tincidunt leo. Nam sit amet mauris et lorem 
										varius lobortis eu a nisl. 
									</p>
									<div class="test-bottom text-center">
										<div class="test-des-area">
											<div class="pic">
												<img src="{{url('/frontend/img/testimonial/3.jpg')}}" alt="">
											</div>
											<h3 class="testimonial-title">Michel</h3>
											<small class="post"> - Themesvila</small>
										</div>
									</div>
								</div>
							</div> -->
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
							@foreach($category as $cat)
							
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