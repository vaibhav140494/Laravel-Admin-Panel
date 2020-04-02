@include('frontend_user.header')


		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Cart Details</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
							<!-- <li><a href="#">category</a></li> -->
							<li><span>Cart</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Cart Page -->
		<div class="cart_page_area">
			<div class="container cart-display-msg">
				@if($cart_product->count()>0)
					<div class="row">
						<div class="col-sm-12">
							
								<div class="cart_table_area table-responsive">
									<?php $total =0;?>
									<table class="table cart_prdct_table text-center">
										<thead>
											<tr>
												<th class="cpt_no">No.</th>
												<th class="cpt_img">image</th>
												<th class="cpt_pn">product name</th>
												<th class="cpt_q">quantity</th>
												<th class="cpt_p">price</th>
												<th class="cpt_t">total</th>
												<th class="cpt_r">remove</th>
											</tr>
										</thead>
										<tbody>
											@foreach($cart_product as $cp)
												<tr id="{{$cp->id}}">
													<td><span class="cp_no">{{$cp->id}}</span></td>
													<td><a href="{{url('storage/products/'.$cp->image)}}"  class="cp_img venobox"><img src=" {{url('storage/products/'.$cp->image)}}" alt="" /></a></td>
													<td><a href="javascript:void(0)"  class="cp_title">{{$cp->product_name}}</a></td>
													<td>										
														<div class="cp_quntty">			
																															
															<input name="quantity" prodid="{{$cp->product_id}}" class="cart_show_quantity" min=0 value="{{$cp->quantity}}" size="2" type="number">													
														</div>
													</td>
													<td><p class="cp_price">{{$cp->price}}</p></td>
													<td><p class="cpp_total" id="{{$cp->product_id}}">{{$cp->total_amount}}</p></td>
													<?php $total +=$cp->total_amount; ?>
													<td><a class="btn btn-default cp_remove" pid="{{$cp->id}}"><i class="fa fa-trash"></i></a></td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-8 col-xs-12 cart-actions cart-button-cuppon">
							<div class="row">
								<div class="col-sm-7">
									<div class="cart-action">
										<a href="#" class="btn border-btn">continiue shopping</a>
										<!-- <a href="#" class="btn border-btn">update shopping bag</a> -->
									</div>
								</div>
								
								<div class="col-sm-5">
									<div class="cuppon-wrap">
										<h4>Discount Code</h4>
										<p>Enter your coupon code if you have</p>
											<div class="row">
											<div class="col-sm-10">
											<input type="text" id="offer" name="offer"/>
											</div>
											<div class="col-sm-2" id="remove_offer" style="display:none">
											<button class="btn  rmv_offer fa fa-times" data-toggle="tooltip" data-placement="top" title="remove offer" id="remove-offer"></button>
											</div>
											</div>
											
											<h6 id='offer-invalid' style="margin-bottom:10px;"></h6>
											<button class="btn border-btn" id="offer-btn">apply coupon</button>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
							<div class="wrap">
								<p><span>Subtotal &#x20b9;</span><span id="subtotal" >{{$total}}</span></p>
								<p><span>Discount &#x20b9;</span><span id="discount" >0</span></p>
								<h4><span>Grand total &#x20b9;</span><span id="discounted_price" >{{$total}}</span></h4>
								<a href="{{route('frontend.checkout')}}" class="btn border-btn cbtn">process to checkout</a>
							</div>
						</div>
						
					</div>
					@else
					No Products in your cart!!
					@endif

			</div>
		</div>

    @include('frontend_user.footer')

<script>
	$(document).ready(function(){
		$('.cart_show_quantity').change(function(){
			var value=$(this).val();
			var id=$(this).attr('prodid');
			// alert(id);
			// return false;
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
					if(response['message']=="replace")
					{
						var count=0;
						var cart = response['cart'];
						$.each(cart,function(k,v){

							var total=v.total_amount;
							count+=total;
							$('#'+v.product_id).html(total);
						});
						$('#subtotal').html(count);
						var dis=$('#discount').text();
						$('#discounted_price').html(count - dis);
						
					}
					if(response['fail']=="fail")
					{

					}return false;
				}
			});
		});
		
		$('#offer-btn').click(function(){
                    var code=$('#offer').val();
					var total=$('#subtotal').html();
					console.log(code);
					console.log(total);
					$.ajax({
						url:'{{route("frontend.offer.ckeck")}}',
						method:'get',
						dataType:'json',
						data:{'code':code,'total':total},
						success:function(response){
							var res = response;
							var str='';
							var text = res.error;
							var success = res.success;
							var discount = res.discount;
							var discounted_price = res.discounted_price;
							console.log(text);
							str+='<h6 id="offer-invalid" style="color:red;margin-bottom:10px;"></h6>';
							console.log(str);
							if(text){	
							$('#offer-invalid').text(text);
							$("#offer-invalid").css("color", "red");
							}
							if(success){
							$('#offer-invalid').text(success);
							$("#offer-invalid").css("color", "green");
							$("#discount").html(discount);
							$("#discounted_price").html(discounted_price);
							$("#remove_offer").css("display","block");	
							}
						}
					});
	});
	$('#remove-offer').click(function(){
		var code=$('#offer').val();
		var total=$('#subtotal').html();
		$.ajax({
			url:'{{route("frontend.offer.remove")}}',
			method:'get',
			dataType:'json',
			success:function(response){
				var msg = response.message;
				
				if(msg == 'removed')
				{
					$('#offer').val("");
					$('#offer-invalid').text("offer removed");
					$("#offer-invalid").css("color", "red");
					$("#discount").html('0');
					$("#discounted_price").html(total);
					$("#remove_offer").css("display","none");
				}
			}
		});
	});
	// $('.cbtn').click(function(){
	// 	var total=$('#subtotal').html();
	// 	var discount=$('#discount').html();
	// 	var dprice=$('#discounted_price').html();
	// 	
	// 	window.location.href=url;
		
	// });
	});
</script>