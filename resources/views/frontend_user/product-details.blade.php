@include('frontend_user.header')
		

	<!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Product Details</h3>
				</div>		

				<div class="col-sm-6 text-right">
					<ul class="p_items">
						<li><a href="#">home</a></li>
						<li><a href="{{route('frontend.category.list')}}">{{$category->category_name}}</a></li>
						<li><a href="{{route('frontend.subcategory.list',[$category->id])}}">{{$subcategory->subcategory_name}}</a></li>
						<li><span>{{$product->product_name}}</span></li>
					</ul>					
				</div>	
					
			
				
			</div>
		</div>
	</div>

	<!-- Product Details Area  -->
	<div class="prdct_dtls_page_area">
		<div class="container">
			<div class="row">
				<!-- Product Details Image -->
				<div class="col-md-6 col-xs-12">
					<div class="pd_img fix">
						<a class="venobox" href=" {{url('storage/products/'.$product->image)}}"><img src="{{url('storage/products/'.$product->image)}}" alt=""/></a>
					</div>
				</div>
				<!-- Product Details Content -->
				<div class="col-md-6 col-xs-12">
					<div class="prdct_dtls_content">
						<a class="pd_title" href="#">{{$product->product_name}}</a>
						<div class="pd_price_dtls fix">
							<!-- Product Price -->
							<div class="pd_price">
								<span class="new">&#x20b9; {{$product->price}}</span>
								@if($product->discouted_price !=$product->price)
								<span class="old">&#x20b9; {{$product->price}}</span>
								@endif
							</div>
							<!-- Product Ratting -->
							<div class="pd_ratng">
								<div class="rtngs">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</div>
							</div>
						</div>
						<div class="pd_text">
							<h4>overview:</h4>
							
							<p>{{$product->category_desc}}</p>
							@if(strlen($product->category_desc) > 100)
							<a class="btn btn-primary" href="#description"> Read more</a>
							@endif
						</div>
						@if($product->type==2)
							<div class="pd_img_size fix">
								<h4>size:</h4>
								<a href="#">s</a>
								<a href="#">m</a>
								<a href="#">l</a>
								<a href="#">xl</a>
								<a href="#">xxl</a>
							</div>
							@endif

							<div class="pd_clr_qntty_dtls fix">
							@if($product->type==2)
								<div class="pd_clr">
									<h4>color:</h4>
									<a href="#" class="active" style="background: #ffac9a;">color 1</a>
									<a href="#" style="background: #ddd;">color 2</a>
									<a href="#" style="background: #000000;">color 3</a>
								</div>
							@endif
								<div class="pd_qntty_area">
								@if($product->quantity > 0)
									<h4>quantity:</h4>
									<div class="pd_qty fix">
										<input value="0" name="qttybutton"  id="prod_qty"class="cart-plus-minus-box" type="number" min="0">
									</div>
									@endif
								</div>
							</div>
						<!-- Product Action -->
						<div class="pd_btn fix">
							@if($product->quantity > 0)
							<a class="btn btn-default acc_btn"  href="#" id="cart-btn">add to cart</a>
							@else
							<button class="btn btn-default acc_btn" disabled>out of stock</button>
							@endif
							<a class="btn btn-default acc_btn btn_icn"><i class="fa fa-heart"></i></a>
							<!-- <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a> -->
						</div>
						<div class="pd_share_area fix">
							<h4>share this on:</h4>
							<!-- <div class="pd_social_icon">
								<a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
								<a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
								<a class="vimeo" href="#"><i class="fa fa-vimeo"></i></a>
								<a class="google_plus" href="#"><i class="fa fa-google-plus"></i></a>
								<a class="tumblr" href="#"><i class="fa fa-tumblr"></i></a>
								<a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
							</div> -->
							<div id="demo1" data-url="http://sharrre.com" data-text="Make your sharing widget with Sharrre (jQuery Plugin)" data-title="share"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">					
					<div class="pd_tab_area fix">									
						<ul class="pd_tab_btn nav nav-tabs" role="tablist">
						  <li>
							<a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
						  </li>
						 
						  <li>
							<a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
						  </li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade show active" id="description">
								<p>{{$product->category_desc}}</p>
												  
							</div>

								<div role="tabpanel" class="tab-pane fade" id="reviews">
									<div class="pda_rtng_area fix">
										<h4>{{$avg}} <span> (Overall)</span></h4>
										<span>Based on {{$users_product_reviews->count()}} Comments</span>
									</div>
									<div class="rtng_cmnt_area fix">
									
										@foreach($users_product_reviews as $preview)
											<div class="single_rtng_cmnt">
												<div class="rtngs">
													@for($i=0;$i< $preview->rating;$i++)
													<i class="fa fa-star"></i>
													
													@endfor
												<span>({{$preview->rating}})</span>
												</div>
												<div class="rtng_author">
													<h3> {{ $preview->first_name}} {{ $preview->last_name}}</h3>
													<span>{{\Carbon\Carbon::parse($preview->review_date)->format('d-M-Y')}}</span>
													<span></span>
												</div>
												<p>{{$preview->review}}</p>
											</div>
										@endforeach									

									</div>
									<div class="col-md-6 rcf_pdnglft">
										<div class="rtng_cmnt_form_area fix">
											<h3>Add your Comments</h3>
											<div class="rtng_form">
												<form action="#">
													<div class="input-area"><input type="text" placeholder="Type your name" /></div>
													<div class="input-area"><input type="text" placeholder="Type your email address" /></div>
													<div class="input-area"><textarea name="message" placeholder="Write a review"></textarea></div>
													<input class="btn border-btn" type="submit" value="Add Review" />
												</form>
											</div>
										</div>
									</div>				  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	<!-- Related Product Area -->
	<div class="related_prdct_area text-center">
		<div class="container">		
				<!-- Section Title -->
				<div class="rp_title text-center"><h3>Related products</h3></div>
				
				<div class="row">
				
					@foreach($all_products as $prd)
					
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="product-grid">
							<div class="product-image">
								<a href="{{route('frontend.product.details',[$prd->product_id,$subcategory->id,$category->id])}}">
									<img class="pic-1" src="{{url('storage/products/'.$prd->image)}}" alt="Product Image">
									<img class="pic-2" src="{{url('storage/products/'.$prd->image)}}" alt="Product Image">
								</a>
								<ul class="social">
									<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
									<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
									<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
								</ul>
								<!-- <span class="product-new-label">Sale</span> -->
							</div>
							<ul class="rating">
								@for($i=0;$i<$prd->rating;$i++)
								<li class="fa fa-star"></li>
								@endfor
							</ul>
							<div class="product-content">
								<h3 class="title"><a href="#">{{$prd->product_name}}</a></h3>
								<div class="price">{{$prd->price}}
									@if($prd->discouted_price !=$prd->price)
										<span>{{$prd->disouted_price}}</span>
									@endif
								</div>
								<a class="add-to-cart" href="#">+ Add To Cart</a>
							</div>
						</div>
					</div><!-- End Col -->

					@endforeach	
									
			</div>
		</div>
	</div>
@include('frontend_user.footer')
<script>





</script>