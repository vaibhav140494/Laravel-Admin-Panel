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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js" integrity="sha256-vHsV98JlYVo7h9eo1BQrqWgGQDt6prGrUbKAlHfP+0Y=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" integrity="sha256-sfG8c9ILUB8EXQ5muswfjZsKICbRIJUG/kBogvvV5sY=" crossorigin="anonymous"></script>
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
				$(document).on('click','.remove-wishlist',function(){
					var uid = $(this).attr('pid');
					var el 	= this;

					$.ajax({
						url:'{{route("frontend.wishlist.remove")}}',
						type:'GET',
						dataType:'JSON',
						data:{id:uid},
						success:function(response){
							if(response){
								
        						var res = response;
								console.log(res);
								
								// $(el).replaceWith();
								var str='';
								//var tag = res['tag'];
								 $(el).replaceWith(res.tag);
								 console.log(res.wishlist);
								 var wlist = res.wishlist;
								 var count = wlist.length;
								 $('.wishlist_number').html(count);
								 $.each(wlist,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									str += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.price+'</p><a class="pro-del remove-wish"" href="javascript:void(0)" pid="'+value.product_id+'"><i class="fa fa-times-circle"></i></a></div></div>';
									});
								$('.mc-pro-list').html(str);
								if(count==0)
								{
											
									$('.mc-pro-list').append("<h5>NO PRODCUTS</h5>");							
								}
							};
							
						}
					});
				});
				$(document).on('click','.add-wishlist',function(){
					var uid=$(this).attr('pid');
					var el = this;

					$.ajax({
						url:'{{route("frontend.wishlist.add")}}',
						type:'GET',
						data:{id:uid},
						success:function(response){
							if(response){
								var res = JSON.parse(response);
								console.log(res.tag);
								
								
									if(res.msg=='fail')
									{	
										window. location. href="http://127.0.0.1:8000/user/login";
									}
								else{
									var str='';
								//var tag = res['tag'];
								 $(el).replaceWith(res.tag);
								 console.log(res.wishlist);
								 var wlist = res.wishlist;
								 var count = wlist.length;
								 $('.wishlist_number').html(count);
								 $.each(wlist,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									str += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.price+'</p><a class="pro-del remove-wish"" href="javascript:void(0)" pid="'+value.product_id+'"><i class="fa fa-times-circle"></i></a></div></div>';
									});
									$('.mc-pro-list').html(str);
								}
								
								 };
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
				// $('.cart_menu_area').click(function(){
				// 	$('.user-profile').css('visibility','visible');
				// });	
				// $('.close-button').click(function(){
				// 	// alert("hello");
				// 	$('.user-profile').css('visibility','hidden');
				// });	

				$('.cart-btn').click(function(){
					var value=$('#prod_qty').val();
					var id=$(this).attr('name');
					if(value==0)
					{
						alert("please select Quantity");
						return false;
					}	
					$.ajax({
						url:'{{route("frontend.cart.add")}}',
						method:'get',
						dataType:'json',
						data:{'value':value,'id':id},
						success:function(response)
						{
							if(response['login']==false)
							{
								var route="{{route('frontend.user.login')}}";
								window.location.replace(route);
							}
							if(response['message']=="success")
							{
								alert("product added to cart successfully");
								location.reload(true);	
								return false;
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
					var id=$(this).attr('name');
					$.ajax({
						url:'{{route("frontend.cart.remove")}}',
						method:'get',
						dataType:'json',
						data:{'pid':id},
						success:function(response)
						{
							if(response['message']=="success")
							{
								alert("product deleted to cart successfully");
								location.reload(true);
								return false;
							}
							if(response['message']=="fail")
							{
								alert("can not deleted from cart");
								return false;
							}
						}
					});
				});
				$(document).on('click','.remove-wish',function(){
					var uid=$(this).attr('pid');
					var el = this;
					

					bootbox.confirm("are you sure?", function(result){
					if(result){	
					$.ajax({
						url:'{{route("frontend.wishlist.remove")}}',
						type:'GET',
						dataType:'json',
						data:{id:uid},
						success:function(response){
							if(response){

        						var res = response;
								console.log(res);
							
								
								//var tag = res['tag'];
								 $("[pid="+uid+"]").replaceWith(res.tag);
								 console.log(res.wishlist);
								 var wlist = res.wishlist;
								 var str='';
								 var count = wlist.length;
								 $.each(wlist,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									str += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.price+'</p><a class="pro-del remove-wish"" href="javascript:void(0)" pid="'+value.product_id+'"><i class="fa fa-times-circle"></i></a></div></div>';
									});
									$('.mc-pro-list').html(str);
								 	$('.wishlist_number').html(count);
									 if(count==0)
								{
											
									$('.mc-pro-list').append("<h5>NO PRODCUTS</h5>");							
								}
							}
						}
					});
				  } 
				});
			});
			});
		</script>
	</body>
</html>