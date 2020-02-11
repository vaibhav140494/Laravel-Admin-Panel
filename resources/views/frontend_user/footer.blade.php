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
				$("#success-alert-add-cart").hide();
				$("#success-alert-remove-cart").hide();
				// alert($('.cart_icon').offset());
				$('.cart_menu_area').click(function(){
					$('.user-profile').css('visibility','visible');
				});	
				$('.close-button').click(function(){
					// alert("hello");
					$('.user-profile').css('visibility','hidden');
				});	
				$(document).on('click','.remove',function(){
					var uid = $(this).attr('pid');
					var el 	= this;

					$.ajax({
						url:'{{route("frontend.wishlist.remove")}}',
						type:'GET',
						data:{id:uid},
						success:function(response){
							if(response){
								$(el).replaceWith(response);
							}
							
						}
					});
				});
				$(document).on('click','.add',function(){
					var uid=$(this).attr('pid');
					var el = this;

					$.ajax({
						url:'{{route("frontend.wishlist.add")}}',
						type:'GET',
						data:{id:uid},
						success:function(response){
							if(response){
								$(el).replaceWith(response);
							}
						}
					});
				});
				// $('#prod_qty').change(function(){
				// 	var value=$(this).val();
				// 	<?php //if($product->count() > 0){
				// 			$prod= $product->quantity;
				// 	}
				// 	else{

				// 	$prod=0;
						
				// 	?>	
					
				// 	 if(<?php // echo $prod; ?> < value)
				// 	 {
				// 		 $('#cart-btn').html("product Out of stock");
				// 		 $('#cart-btn').attr('type','button');
				// 		 $('#cart-btn').css('cursor','not-allowed');
				// 	 }
				// 	 else
				// 	 {
				// 		$('#cart-btn').html("Add to Cart");
				// 		 $('#cart-btn').removeAttr('type','button');
				// 		//  $('#cart-btn').attr('href');
				// 		 $('#cart-btn').css('cursor','pointer');

				// 	 }
				// 	 <?php
				// 	}
				// 	 ?>
					$('.cart_menu_area').click(function(){
						$('.user-profile').css('visibility','visible');
					});	
					$('.close-button').click(function(){
						$('.user-profile').css('visibility','hidden');
					});	

				$(document).on('click','.cart-btn',function(){
					var value=$('#prod_qty').val();
					var pid=$(this).attr('name');
					// $(this).attr('id',pid);
					
					if(value==0)
					{
						alert("please select Quantity");
						return false;
					}	
					$.ajax({
						url:'{{route("frontend.cart.add")}}',
						method:'get',
						dataType:'json',
						data:{'value':value,'id':pid},
						success:function(response)
						{
							if(response['login']==false)
							{
								var route="{{route('frontend.user.login')}}";
								window.location.replace(route);
							}
							if(response['message']=='replace')
							{
								//console.log(response['data_replace']);
								// console.log($(this).parent().html());
								// $(this).html(response['data_replace']);
								//   console.log($(this).html());
								// $(this).attr('data-tip','view-cart');
								//   return true;
								
								$(this).parent().html(response['data_replace']);
								console.log($(this).html());

							}
							if(response['message']=="success")
							{
								$(this).html(response['data_replace']);

								$("#success-alert-add-cart").fadeTo(1000, 500).slideUp(500, function() {
      							$("#success-alert-add-cart").slideUp(500);
								});
								// $('#'+pid).html(response['data_replace']);
								// console.log($(response['data_replace']));
								// console.log('#'+pid);

								$('#cart-count').text(response['cart'].length);
								var cart=response['cart'];
								var div='';
								var total=0;
								
								$.each(cart,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									// console.log(route);
									var prodname= value.product_name;
									 div += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.quantity+'x &#x20b9;'+value.gross_amount+'</p><a class="pro-del cp_remove" href="javascript:void(0)" pid="'+value.id+'"><i class="fa fa-times-circle"></i></a></div></div>';

									 total+=value.quantity * value.gross_amount;
								});
								$('.mc-pro-list').html(div);
								$('#cart-subtotal').text(total);
								if(response['cart'].length==0)
								{
									// console.log("null");
									$('.mc-subtotal').hide();
									$('.mc-button').hide();
									$('.mc-pro-list').text('No products in your cart!!!');
								}
								else
								{
									$('.mc-subtotal').show();
									$('.mc-button').show();
									// console.log("hello");
								}
								

							}
							if(response['fail']=="fail")
							{
								alert("can not added to cart");
								return false;
							}
						}
					});
				});	

				$(document).on('click','.cp_remove',function(){
					var id=$(this).attr('pid');
					// $(this).parent().html("hello");
					// console.log($(this).parent().html());
					// return false;
					$.ajax({
						url:'{{route("frontend.cart.remove")}}',
						method:'get',
						dataType:'json',
						data:{'pid':id},
						success:function(response)
						{
							if(response['message']=="success")
							{
								$("#success-alert-remove-cart").fadeTo(1000, 500).slideUp(500, function() {
									$("#success-alert-remove-cart").slideUp(500);
									$('#'+id).remove();
								});
								$('#cart-count').text(response['cart'].length);
								
								var cart=response['cart'];
								var div='';
								total=0;
								$.each(cart,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									// console.log(route);
									// var prodname= values.product_name;
									 div += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.quantity+'x &#x20b9;'+value.gross_amount+'</p><a class="pro-del cp_remove" href="javascript:void(0)" pid="'+value.id+'"><i class="fa fa-times-circle"></i></a></div></div>';
									//  console.log(div);
									total+=value.quantity * value.gross_amount;
								});

								$('.mc-pro-list').html(div);
								$('#cart-subtotal').text(total);
								if(response['cart'].length==0)
								{
									$('.mc-subtotal').hide();
									$('.mc-button').hide();
									$('.mc-pro-list').text('No products in your cart!!!');
								}
								else
								{
									$('.mc-subtotal').show();
									$('.mc-button').show();
								}

									
								return true;
							}
							if(response['message']=="fail")
							{
								alert("can not deleted from cart");
								return false;
							}
						}
					});
	
				});
			
		</script>
	</body>
</html>