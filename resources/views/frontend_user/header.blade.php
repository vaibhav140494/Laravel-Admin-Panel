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
		
		<div class="preloader">
			<div class="status-mes">
				<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
			</div>
		</div>
		<!-- End Preloader -->
		
		<!--  Start Header  -->
		<header id="header_area">
			<div class="header_top_area">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<div class="hdr_tp_left">
								<div class="call_area">
									<span class="single_con_add"><i class="ti-mobile"></i> +0123>456789</span>
									<span class="single_con_add"><i class="ti-email"></i> example@gmail.com</span>
								</div>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-6">
						<div class="form-group ">
										<input type="text" class="form-control header-search-bar" placeholder="Search for Products">
									</div>
							<ul class="hdr_tp_right text-right">
								<!-- <li>
									
								</li> -->
								<!-- <li class="account_area"><a href="#"><i class="ti-user"></i> My Account</a></li> -->
								
								@if (\Auth::user()!='')
								<li class="account_area"><a href="#"> My Orders</a></li>
								<li class="account_area"><a href="{{route('frontend.logout')}}"> SignOut</a></li>

								@else
								<li class="account_area"><a href="{{route('frontend.login')}}"> <i class="ti-user"></i>Log In</a></li>
								<li class="account_area"><a href="{{url('/register')}}"><i class="ti-user"></i> Sign Up</a></li>
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
											<li><a href="#">home</a>					
											</li>									
											
											<li><a href="#">Categories <i class="fa fa-angle-down"></i></a>
												
												<div class="mega-menu mm-3-column mm-left">
													<div class="mm-column mm-column-link float-left">
														<h3>Electronics</h3>
														<a href="#">Mobiles</a>
														<a href="#">Laptops</a>
														<a href="#">Speakers</a>
														<a href="#">Camera</a>
														<a href="#">Tablets</a>
													</div>
													
													<div class="mm-column mm-column-link float-left">
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
													</div>												
													<a  href="{{route('frontend.category.list')}}" class="btn btn-outline-danger pull-right header-category-btn">
														See All
													</a>
												</div>
											</li> 
											<li><a href="#">Products <i class="fa fa-angle-down"></i></a>
												
												<ul class="sub-menu">
													<li><a href="#">Laptops</a></li>
													<li><a href="#">Moiles</a></li>
													<li><a href="#">Shirts</a></li>
													<li><a href="#">Jeans</a></li>
													<li><a href="#">Washing Machine</a></li>
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

x										</ul>
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
										<div class="cart_menu_area">
											<div class="cart_icon">
												<a href="#"><i class="ti-shopping-cart-full" aria-hidden="true"></i></a>
												<span class="cart_number">2</span>
											</div>
											
											
											<!-- Mini Cart Wrapper -->
											<div class="mini-cart-wrapper">
												<!-- Product List -->
												<div class="mc-pro-list fix">
													<div class="mc-sin-pro fix">
														<a href="#" class="mc-pro-image float-left"><img src="{{url('/frontend/img/mini-cart/1.jpg')}}" alt="" /></a>
														<div class="mc-pro-details fix">
															<a href="#">This is Product Name</a>
															<span>1x$25.00</span>
															<a class="pro-del" href="#"><i class="fa fa-times-circle"></i></a>
														</div>
													</div>
													<div class="mc-sin-pro fix">
														<a href="#" class="mc-pro-image float-left"><img src="{{url('/frontend/img/mini-cart/2.jpg')}}" alt="" /></a>
														<div class="mc-pro-details fix">
															<a href="#">This is Product Name</a>
															<span>1x$25.00</span>
															<a class="pro-del" href="#"><i class="fa fa-times-circle"></i></a>
														</div>
													</div>
												</div>
												<!-- Sub Total -->
												<div class="mc-subtotal fix">
													<h4>Subtotal <span>$50.00</span></h4>												
												</div>
												<!-- Cart Button -->
												<div class="mc-button">
													<a href="#" class="checkout_btn">checkout</a>
												</div>
											</div>											
										</div>	
										
									</li>
									@endif
								</ul>
							</div>	
						</div><!--  End Col -->	
						
					</div>
				</div>
			</div>
		</header>
		<!--  End Header  -->