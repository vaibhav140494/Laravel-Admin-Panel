	<!--  FOOTER START  -->
    <footer class="footer_area">
			<div class="footer-top">
				<div class="container">
					<div class="row">				
						<div class="col-lg-4 col-sm-6">
							<div class="single_ftr footer-contact-info">
								<h4 class="sf_title">Contacts</h4>
								<ul>
									<li><i class="ti-location-pin"></i> 4060 Reppert Coal Road Jackson,<br> MS 39201 USA</li>
									<li><i class="ti-mobile"></i> (+123) 685 78 <br> (+064) 987 245</li>
									<li><i class="ti-email"></i> contact@yoursite.com <br> support@yoursite.com</li>
								</ul>
							</div>
						</div> <!--  End Col -->
						<div class="  col-lg-4 col-sm-6">
							<div class="single_ftr" style="margin-left:100px;">
								<h4 class="sf_title">Information</h4>
								<ul>
									<!-- display when user logged in -->
									@if(\Auth::user()!='')
									<li><a href="#">My Orders</a></li>
									@endif
									<li><a href="#">About Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Terms & Conditions</a></li>
									<li><a href="#">Contact Us</a></li>
								</ul>
							</div>
						</div> <!--  End Col -->
						@if(isset($category_featured))
						<div class=" offset-lg-1 col-lg-3 col-sm-6">
							<div class="single_ftr" >
								<h4 class="sf_title">Featured Categories</h4>
								<ul> 
								@foreach($category_featured as $cat)
								<!-- print top 5 category of products which sold most frequently -->
									<li><a href="{{route('frontend.subcategory.list',[$cat->id])}}">{{$cat->category_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div> <!--  End Col -->	
						@endif
						<!-- <div class="col-lg-4 col-sm-6">
							<div class="single_ftr">
								<h4 class="sf_title">Join Us Newsletter</h4>
								<div class="newsletter_form">
									<p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Aenean lobortis  </p>
									<form method="post" action="#" class="form-inline">				
										<input name="EMAIL" id="email" placeholder="Enter Your Email" class="form-control" type="email">
										<button type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o"></i></button>
									</form>
								</div>
							</div>
						</div>  End Col -->
						
					</div>
				</div>
			</div>
		
		
			<div class="ftr_btm_area">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="ftr_social_icon">
								<ul>
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
						
						<div class="col-sm-6">
							<p class="copyright_text text-center">Copyright &copy; 2020 E-commerce,All rights Reserved.</p>
						</div>
						
						
					</div>
				</div>
			</div>
		</footer>
		<!--  FOOTER END  -->

	@include('frontend_user.script')
		<script>
			$(document).ready(function(){
				// alert($('.cart_icon').offset());
				$('.cart_menu_area').click(function(){
					$('.user-profile').css('visibility','visible');
				});	
				$('.close-button').click(function(){
					// alert("hello");
					$('.user-profile').css('visibility','hidden');
				});	
				$('#prod_qty').change(function(){
					var value=$(this).val();
					<?php $prod= $product->quantity;?>
					 if(<?php echo $prod; ?> < value)
					 {
						 $('#cart-btn').html("product Out of stock");
						 $('#cart-btn').attr('type','button');
						 $('#cart-btn').css('cursor','not-allowed');
					 }
					 else
					 {
						$('#cart-btn').html("Add to Cart");
						 $('#cart-btn').removeAttr('type','button');
						//  $('#cart-btn').attr('href');
						 $('#cart-btn').css('cursor','pointer');
					 }
				});	
				
			});
		</script>
	</body>

<!-- Mirrored from getmasum.com/html-preview/rapidshop/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jan 2020 16:06:13 GMT -->
</html>