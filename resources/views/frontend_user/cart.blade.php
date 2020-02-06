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
							<li><a href="#">category</a></li>
							<li><span>Cart</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Cart Page -->
		<div class="cart_page_area">
			<div class="container">
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
												<tr>
													<td><span class="cp_no">{{$cp->id}}</span></td>
													<td><a href="{{url('storage/products/'.$cp->image)}}"  class="cp_img venobox"><img src=" {{url('storage/products/'.$cp->image)}}" alt="" /></a></td>
													<td><a href="javascript:void(0)"  class="cp_title">{{$cp->product_name}}</a></td>
													<td>										
														<div class="cp_quntty">			
																															
															<input name="quantity" prodid="{{$cp->product_id}}" class="cart_show_quantity" min=0 value="{{$cp->quantity}}" size="2" type="number">													
														</div>
													</td>
													<td><p class="cp_price">{{$cp->price}}</p></td>
													<td><p class="cpp_total">{{$cp->total_amount}}</p></td>
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
										<form action="#" class="cuppon-form">
											<input type="text" />
											<button class="btn border-btn">apply coupon</button>
										</form>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
							<div class="wrap">
								<p><span>Subtotal</span><span> &#x20b9; {{$total}}</span></p>
								<p><span>Discount</span><span> &#x20b9; 0</span></p>
								<h4><span>Grand total</span><span> &#x20b9;{{$total}}</span></h4>
								<a href="#" class="btn border-btn">process to checkout</a>
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
					if(response['message']=="success")
					{
						alert("product added to cart successfully");
						location.reload(1)
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
			var id=$(this).attr('pid');

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
	});
</script>