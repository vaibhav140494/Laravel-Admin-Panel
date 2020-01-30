@include('frontend_user.header')
<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Sub category:{{--{{$prod->product_name}}--}}</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
                            <li><a href="{{route('frontend.category.list')}}">category</a></li>
                            <li><a href="#">Sub category</a></li>
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
							<div class="col-lg-3 col-md-4 col-sm-6 mix sale">
								<div class="product-grid">
									<div class="product-image">
										<a href="#">
											<img class="pic-1" src=" {{url('/frontend/img/product/1.jpg')}}" alt="product image">
											<img class="pic-2" src="{{url('/frontend/img/product/2.jpg')}}" alt="product image">
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
							</div><!-- End Col -->	
							
							<div class="col-lg-3 col-md-4 col-sm-6 mix ftrd">
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
							</div><!-- End Col -->	
									
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
							</div><!-- End Col -->	

							
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
							</div><!-- End Col -->			
							
							
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
							</div><!-- End Col -->			
							
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
							</div><!-- End Col -->		
							
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
							</div><!-- End Col -->	

							
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
							</div><!-- End Col -->			
		
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End product Area -->			
@include('frontend_user.footer')