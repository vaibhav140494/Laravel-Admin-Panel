@include('frontend_user.header')


		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Order Details</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
                            <li><a href="{{route('frontend.view.order')}}">Order </a></li>
							<li><a href="{{route('frontend.download.pdf',[$order_details[0]->id])}}">Pdf</a></li>
                            <li><span>Order details</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Cart Page -->
		<div class="cart_page_area">
			<div class="container cart-display-msg">
				@if($order_details->count()>0)
					<div class="row">
						<div class="col-sm-12">
								<div class="cart_table_area table-responsive">
									<?php $total =0;?>
									<table class="table cart_prdct_table text-center">
										<thead>
											<tr>
												<th class="cpt_no">No.</th>
												<th class="cpt_pn">product name</th>
												<th class="cpt_q">quantity</th>
                                                <th class="cpt_p">price</th>
                                                <th class="cpt_p">gross amount</th>
                                                <th class="cpt_p">tax amount</th>
                                                <th class="cpt_p">discount</th>
												<th class="cpt_t">total</th>
											</tr>
										</thead>
										<tbody>
											<?php $count=1;?>
											@foreach($order_details as $orderdet)
												<tr id="{{$orderdet->id}}">
													<td><span class="cp_no">{{$count++}}</span></td>
													<td><a href="javascript:void(0)"  class="cp_title">{{$orderdet->product_name}}</a></td>
													<td>										
														<div class="cp_quntty">			
																															
															<input name="quantity" prodid="{{$orderdet->product_id}}" class="cart_show_quantity" min=0 value="{{$orderdet->quntity}}" size="2" type="number" disabled>	
														</div>
													</td>
                                                    <td><p class="cp_price">{{$orderdet->price}}</p></td>
                                                    <td><p class="cpp_total" >{{$orderdet->gross_amount}}</p></td>
                                                    <td><p class="cpp_total" >{{$orderdet->tax_amount}}</p></td>
                                                    <td><p class="cpp_total" >{{$orderdet->discount}}</p></td>
													<td><p class="cpp_total" >{{$orderdet->total_amount}}</p></td>
													<?php $total +=$orderdet->total_amount; ?>
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
								<div class="col-sm-5">
									<div class="cuppon-wrap">
										<h4>Offer Code</h4>
                                        <!-- <p>Enter your coupon code if you have</p> -->
                                        <?php  $value='No offer Applied' ; ?>
                                        @if($order_details[0]->offer_code !=null)
                                        <?php  $value= $order_details[0]->offer_code; ?>
                                        @endif
                                        <input type="text" id="offer" name="offer" value="{{$value}}" disabled>
											<h6 id='offer-invalid' style="margin-bottom:10px;"></h6>
											<!-- <button class="btn border-btn" id="offer-btn">apply coupon</button> -->
										
									</div>
                                </div>
                                <div class="col-sm-7">
									
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-xs-12 cart-checkout-process text-right">
							<div class="wrap">
								<p><span>Subtotal &#x20b9;</span><span id="subtotal" >{{$total}}</span></p>
								<p><span>Discount &#x20b9;</span><span id="discount" >{{$discount}}</span></p>
								<h4><span>Grand total &#x20b9;</span><span id="discounted_price" >{{$total-$discount}}</span></h4>
								<a href="{{route('frontend.checkout')}}" class="btn border-btn cbtn">process to checkout</a>
							</div>
						</div>
						
					</div>
					@else
					No Orders !!
					@endif

			</div>
		</div>

    @include('frontend_user.footer')

<script>

</script>