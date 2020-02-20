<!DOCTYPE HTML>
<html lang="en-US">
	
<!-- Mirrored from getmasum.com/html-preview/rapidshop/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jan 2020 15:59:51 GMT -->
<head>
    
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> E-commerce </title>
        
        @include('frontend_user.css')
		
    </head>	
    <body>

	
		<!--  Start Preloader  -->
		
		<!-- <div class="preloader">
			<div class="status-mes">
				<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			</div>
		</div> -->
		<!-- End Preloader -->
		
		<!--  Start Header  -->
		<header id="header_area">
			<div class="header_top_area">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div>
								<div class="call_area">
									<div class="form-group ">
										<input type="text" class="form-control header-search-bar" placeholder="Search for Products">
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-6">
						
							<ul class="hdr_tp_right text-right">
								<!-- <li>
									
								</li> -->
								<!-- <li class="account_area"><a href="#"><i class="ti-user"></i> My Account</a></li> -->
								
								@if (\Auth::user()!='')
								
								<li class="account_area"><a href="{{route('frontend.view.order')}}"> My Orders</a></li>
								<!-- <li class="account_area"><a href="{{route('frontend.logout')}}">Sign Out</a></li> -->
								<li>
									<div class="user_profile_area">
										<div class="">
											<span>Profile</span>
										</div>
										
										<div class="user-profile" style="display:none;">
											<div class="close-button">
												<span>
												<a href="" class="close-btn">	<i class="fa fa-times-circle " aria-hidden="true" ></i></a>
												</span>
											</div>
											<div class="user-header">
												<h3>Welcome {{\Auth::user()->first_name}}</h3>
											</div>
											<div class="user_footer">
												<div class="pull-left">
													<a href="{{route('frontend.register.edit',['id'=>\Auth::user()->id])}}" class="btn btn-primary">Edit Profile</a>
												</div>
												<div class="pull-right">
													<a href="{{route('frontend.logout')}}" class="btn btn-danger">Sign out</a>
												</div>
											</div>
										</div>											
									</div>	 
										
								</li>


								@else
								<li class="account_area"><a href="{{route('frontend.user.login')}}"> <i class="ti-user"></i>Log In</a></li>
								<li class="account_area"><a href="{{route('frontend.register.show')}}"><i class="ti-user"></i> Sign Up</a></li>
								@endif
							</ul>
							
						</div>
					</div>
				</div>
			</div> <!--  HEADER START  -->
			<div class="header_btm_area">
				<div class="container">
					<div class="row">		
						<div class="col-xs-12 col-sm-12 col-md-3"> 
							<a class="logo" href="{{route('frontend.index')}}"> <img alt="" src="{{url('/frontend/img/logo.png')}}"></a> 
						</div><!--  End Col -->
						
						<div class="col-xs-12 col-sm-12 col-md-7 text-center">
							<div class="menu_wrap">
								<div class="main-menu">
									<nav>
										<ul>
											<li><a href="{{route('frontend.index')}}">home</a>					
											</li>									
											
											<li><a href="#">Categories <i class="fa fa-angle-down"></i></a>
											
												<div class="mega-menu mm-3-column mm-left">
														@if(isset($all_category) && isset($all_subcategory))
														@foreach($all_category as $cat)
															<div class="mm-column mm-column-link float-left">
																<h3>{{$cat->category_name}}</h3>
																@foreach($all_subcategory[$cat->id] as $sub)
																	<a href="{{route('frontend.products.list',[$sub->id,$cat->id])}}">{{$sub->subcategory_name}}</a>
																	<!-- <a href="#">Laptops</a>
																	<a href="#">Speakers</a>
																	<a href="#">Camera</a>
																	<a href="#">Tablets</a> -->
																@endforeach
															</div>
														@endforeach
													@endif
													<!-- <div class="mm-column mm-column-link float-left">
														<h3>Fashion</h3>
														<a href="#">Jackets</a>
														<a href="#">Shirts</a>
														<a href="#">T-Shirts</a>
														<a href="#">jens pant’s</a>
														<a href="#">sports shoes</a>	
													</div>					

													<div class="mm-column mm-column-link float-left">
														<h3>Jackets</h3>
														<a href="#">Blazers</a>
														<a href="#">Jackets</a>
														<a href="#">Collections</a>
														<a href="#">T-Shirts</a>
														<a href="#">sports shoes</a>	
													</div>												 -->
													<a  href="{{route('frontend.category.list')}}" class="btn btn-outline-danger pull-right header-category-btn">
														See All
													</a>
												</div>
											</li> 
											<li><a href="#">Products <i class="fa fa-angle-down"></i></a>
												<ul class="sub-menu">
												
												@foreach($all_products as $prod)
													<li><a href="{{route('frontend.product.details',[$prod->id,$prod->subcategory_id,$prod->category_id])}}">{{$prod->product_name}}</a></li>
												@endforeach	
												</ul>
											</li>
											<!-- <li><a href="#">pages <i class="fa fa-angle-down"></i></a>
												
												<ul class="sub-menu">
													<li><a href="#">Left Sidebar Blog</a></li>
													<li><a href="#">Right Sidebar Blog</a></li>
													<li><a href="#">Full Width Blog</a></li>
													<li><a href="#">Blog Details</a></li>
													<li><a href="#">About Us</a></li>
													<li><a href="#">Contact Us</a></li>
												</ul>
											</li> -->
											<li><a href="#">contact</a></li>
											<li><a href="#">about</a></li>

										</ul>
									</nav>
								</div> <!--  End Main Menu -->					

								<div class="mobile-menu text-right ">
									<nav>
										<ul>
											<li><a href="#">home</a></li>																		
											<li><a href="#">Shop</a>
												<!-- Sub Menu -->
												<ul>
													<li><a href="#">Product Details</a></li>
													<li><a href="#">Cart</a></li>
													<li><a href="#">Checkout</a></li>
													<li><a href="#">Wishlist</a></li>
												</ul>
											</li>
											<li><a href="#">Men</a>																		
												<ul>
													<li><a href="#">Blazers</a></li>
													<li><a href="#">Jackets</a></li>
													<li><a href="#">Collections</a></li>
													<li><a href="#">T-Shirts</a></li>
													<li><a href="#">jens pant’s</a></li>
													<li><a href="#">sports shoes</a></li>
												</ul>																				
											</li>
											
											<li><a href="#">Women</a>
												<ul>
													<li><a href="#">gagets</a></li>
													<li><a href="#">laptop</a></li>
													<li><a href="#">mobile</a></li>
													<li><a href="#">lifestyle</a></li>
													<li><a href="#">jens pant’s</a></li>
													<li><a href="#">sports items</a></li>
												</ul>
											</li>
										
											<!-- <li><a href="#">pages</a>											
												<ul>
													<li><a href="#">Blog</a></li>
													<li><a href="#">Blog Details</a></li>
													<li><a href="#">About Us</a></li>
													<li><a href="#">Contact Us</a></li>
												</ul>
											</li> -->
											<li><a href="#">contact</a></li>
											<li><a href="#">about</a></li>

										</ul>
									</nav>
								</div> <!--  End mobile-menu -->						
							</div>
						</div><!--  End Col -->		

						<div class="col-xs-12 col-sm-12 col-md-2">
							<div class="right_menu pull-right">
								<ul class="nav">
									<!-- <li>
										<div class="search_icon">
											<a href="#modal" data-remodal-target="modal"><i class="ti-search search_btn"></i></a>
											
											<div class="search-box remodal" data-remodal-id="modal">
												<button data-remodal-action="close" class="remodal-close"></button>
												<form action="#" method="Post">
													<div class="input-group">
														<input type="text" class="form-control"  placeholder="enter keyword"/>				
														<button type="submit" class="btn btn-default"><i class="ti-search"></i></button>			
													</div>
												</form>
											</div>
										</div>
									</li> -->
									@if(\Auth::user())
									
									<li>
										@if(isset($wishlist))
									
										<div class="wishlist_manu_area" style="align:center">
											<div class="wishlist_icon">
												<a href="{{route('frontend.wishlist.list',[\Auth::user()->id])}}"><i class="fa fa-heart" aria-hidden="true"></i></a>
												<span class="wishlist_number">{{$wishlist->count()}}</span>
											</div>

											<!-- Mini Wishlist Wrapper -->
											
											 <div class="mini-wishlist-wrapper">
											 <div class="mc-pro-list fix">
														@foreach($wishlist as $wproduct)
															<div class="nowish mc-sin-pro fix" id="{{$wproduct->product_id}}">
																<a href="#" class="mc-pro-image float-left"><img src="{{url('storage/products/'.$wproduct->image)}}" width="80" height="80" style="margin-top:10px;" alt="" /></a>
																<div class="mc-pro-details fix">
																	<a href="#">{{$wproduct->product_name}}</a>
																	<p>{{$wproduct->price}}</p>
																	<a class="pro-del remove-wish" href="javascript:void(0)" pid="{{$wproduct->product_id}}"><i class="fa fa-times-circle"></i></a>
																</div>
															</div>
														@endforeach
														<?php if(count($wishlist)>0) { $display = "none"; } else { $display = "block"; } ?>
														<div class="no-wish-bg" style="display:{{$display}}">
															<h5>NO PRODUCTS</h5>
														</div>
											 </div>
											</div> 
											</div>
										@endif
									</li>
									<li>
										@if(isset($all_cart))
											<?php //print_r($all_cart); exit;?>
											<?php $total=0;?>
											<div class="cart_menu_area">
												<div class="cart_icon">
													<a href="{{route('frontend.cart.show')}}"><i class="ti-shopping-cart-full" aria-hidden="true"></i></a>
													<span class="cart_number" id="cart-count">   @if($all_cart) {{$all_cart->count()}} @else 0 @endif</span>
												</div>
												<!-- Mini Cart Wrapper -->
												
												<div class="mini-cart-wrapper">
													<!-- Product List -->
													
														@if($all_cart)
															@if($all_cart->count()>0)
																<div class="mc-pro-list fix">
																	@foreach($all_cart as $allcrt)																
																		<div class="mc-sin-pro fix">
																			<a href="#" class="mc-pro-image float-left"><img src="{{url('storage/products/'.$allcrt->image)}}" width="80" height="80" style="margin-top:10px;" alt="" /></a>
																			<div class="mc-pro-details fix">
																				<a href="#">{{$allcrt->product_name}}</a>
																		
																				<p>{{$allcrt->quantity}} x &#x20b9;{{$allcrt->price}}</p>
																				<?php $total+=$allcrt->total_amount;?>	
																																
																				<a class="pro-del cp_remove" href="javascript:void(0)"  prodid="{{$allcrt->product_id}}" pid="{{$allcrt->id}}"><i class="fa fa-times-circle"></i></a>
																			</div>
																		</div>
																@endforeach
															</div>

															<!-- Sub Total -->
															<div class="mc-subtotal fix">
																<h4>Subtotal &#x20b9;<span id="cart-subtotal">  {{$total}}</span></h4>
															</div>
															<!-- Cart Button -->
															<div class="mc-button">
																<a href="#" class="checkout_btn">checkout</a>
															</div>
													
														@else
															<span id="empty cart">No products in your cart!!!</span>
														@endif		
													@endif
												</div>
											</div>
										@endif 
										</li>
									@endif

								</ul>
							</div>	
						</div><!--  End Col -->	
					</div>
				</div>
			</div>
		</header>
		<div class="alert alert-success text-center" id="success-alert-add-cart" style="position:fixed;top:5%;z-index:10;left:0; right:0;display:none;">
			<!-- <button	 type="button" class="close text-center" data-dismiss="alert" >x</button> -->
			<strong> Product is added to your Cart.</strong>
		</div>
		<div class="alert alert-success text-center" id="success-alert-remove-cart" style="position:fixed;top:5%;z-index:10;left:0; right:0;display:none;">
			<!-- <button	 type="button" class="close text-center" data-dismiss="alert">x</button> -->
			<strong> Product is removed from your Cart.</strong>
		</div>
		<!--  End Header  -->
