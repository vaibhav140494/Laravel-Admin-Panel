@include('frontend_user.header')
		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Wishlist</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><span>Wishlist</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Wishlist Page -->
		<div class="wishlist-page">
			<div class="container">
				<div class="table-responsive">
					<table class="table cart-table cart_prdct_table text-center">
						<thead>
							<tr>
								<th class="cpt_no">#</th>
								<th class="cpt_img">image</th>
								<th class="cpt_pn">product name</th>
								<th class="stock">stock status</th>
								<th class="cpt_p">price</th>
								<th class="cpt_p">discounted price</th>
								<th class="add-cart">add to cart</th>
								<th class="cpt_r">remove</th>
							</tr>
						</thead>
						<tbody>
							@foreach($wished_products as $product)
							<tr class="disp" rmid="{{$product->id}}">
								<td><span class="cart-number">1</span></td>
								<td><a href="#" class="cp_img"><img src=" {{url('storage/products/'.$product->image)}}" alt="" /></a></td>
								<td><a href="#" class="cart-pro-title">{{$product->product_name}}</a></td>
								<td><p class="stock in-stock">Out of stock</p></td>
								<td><p class="cart-pro-price">{{$product->price}}</p></td>
								<td><p class="cart-disc-price">{{$product->discouted_price}}</p></td>
								<td><a href="#" class="btn border-btn">add to cart</a></td>
								<td><a class="rmv" pId="{{$product->id}}"><i class="fa fa-trash"></i></a></td>
							</tr>
							@endforeach
							<?php if(count($wished_products)>0) { $display = "none"; } else { $display = "block"; } ?>
							<tr class="no-wishlist" style="display:{{$display}}">
								<td colspan="8">No products in your Wishlist</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.js" integrity="sha256-vHsV98JlYVo7h9eo1BQrqWgGQDt6prGrUbKAlHfP+0Y=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js" integrity="sha256-sfG8c9ILUB8EXQ5muswfjZsKICbRIJUG/kBogvvV5sY=" crossorigin="anonymous"></script>
	<script>
	$(document).ready(function(){
		$(document).on('click','.rmv',function(){
					var uid=$(this).attr('pId');
					var el = this;

					bootbox.confirm("are you sure?", function(result){
					if(result){	
					$.ajax({
						url:'{{route("frontend.wishlist.remove")}}',
						type:'GET',
						data:{id:uid},
						success:function(response){
							if(response){
								var res = JSON.parse(response);
								console.log(res.tag);
								if(res.msg=='success')
									{	console.log(uid);
										//$('#'+uid).remove();
										$("[rmid="+uid+"]").remove();
										
									}
									var wlist = res.wishlist;
								 	var count = wlist.length;
									 var str='';
									$('.wishlist_number').html(count);
									$.each(wlist,function(key,value){
									var route ='{{url("storage/products/")}}';
									route +='/'+value.image;
									
									str += '<div class="mc-sin-pro fix"><a href="#" class="mc-pro-image float-left"><img src="'+route+'" width="80" height="80" style="margin-top:10px;" alt="" /></a><div class="mc-pro-details fix"><a href="#">'+value.product_name+'</a><p>'+value.price+'</p><a class="pro-del remove-wish"" href="javascript:void(0)" pid="'+value.product_id+'"><i class="fa fa-times-circle"></i></a></div></div>';
									});
									$('.mc-pro-list').html(str);
									if(!$("tr").hasClass("disp"))
										{
											$('.no-wishlist').css("display", "block");									
										}
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

@include('frontend_user.footer')
