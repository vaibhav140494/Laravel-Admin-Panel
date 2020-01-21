@include('frontend_user.header')
		
		

		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Shop</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><a href="#">category</a></li>
							<li><span>Shop</span></li>
						</ul>					
					</div>	

				</div>
			</div>
		</div>
		
		
		<!-- Shop Product Area -->
		<div class="shop_page_area">
			<div class="container">
				<div class="shop_bar_tp fix">
					<div class="row">
						<div class="col-sm-6 col-xs-12 short_by_area">
							<div class="short_by_inner">
								<label>short by:</label>
								<select class="sort-select">
									<option>Name Descending</option>
									<option>Date Descending</option>
									<option>Price Descending</option>
								</select>
							</div>
						</div>

						<div class="col-sm-6 col-xs-12 show_area">
							<div class="show_inner">
								<label>show:</label>
								<select class="show-select">
									<option>8</option>
									<option>12</option>
									<option>30</option>
									<option>ALL</option>
								</select>
							</div>
						</div>
					</div>
				</div>	
					
				<div class="shop_details text-center">
					<div class="row">				
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src=" {{url('frontend/img/product/1.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/2.jpg')}}"  alt="Product Image">
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
						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/3.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/4.jpg')}}"  alt="Product Image">
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
								
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/5.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/6.jpg')}}"  alt="Product Image">
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

						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/7.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/8.jpg')}}"  alt="Product Image">
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
						
						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/5.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/6.jpg')}}"  alt="Product Image">
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
						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/1.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/2.jpg')}}"  alt="Product Image">
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
						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
										<img class="pic-1" src="{{url('frontend/img/product/7.jpg')}}"  alt="Product Image">
										<img class="pic-2" src="{{url('frontend/img/product/8.jpg')}}"  alt="Product Image">
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

						
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="product-grid">
								<div class="product-image">
									<a href="#">
                                        <img class="pic-2" src="{{url('frontend/img/product/4.jpg')}}"  alt="Product Image">
										<img class="pic-1" src="{{url('frontend/img/product/3.jpg')}}"  alt="Product Image">
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
					
				<!-- Blog Pagination -->
				<div class="col-xs-12">
					<div class="blog_pagination pgntn_mrgntp fix">
						<div class="pagination text-center">
							<ul>
								<li><a href="#"><i class="fa fa-angle-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#" class="active">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
					</div>
				</div>	
			</div>
		</div>

@include('frontend_user.footer')