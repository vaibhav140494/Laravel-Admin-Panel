@include('frontend_user.header')


		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3> Your Orders </h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{route('frontend.index')}}">home</a></li>
							<li><span>Order</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		<!-- Cart Page -->
		<div class="cart_page_area">
			<div class="container cart-display-msg">
				@if($orders->count()>0)
					<div class="row">
						<div class="col-sm-12">
								<div class="cart_table_area table-responsive">
									<?php $total =0;?>
									<table class="table cart_prdct_table text-center">
										<thead>
											<tr>
												<th class="cpt_no">No.</th>
												<th class="cpt_pn">Order  Id</th>
                                                <th class="cpt_p">gross amount</th>
                                                <th class="cpt_p">tax amount</th>
                                                <th class="cpt_p">discount</th>
												<th class="cpt_t">total</th>
												<th class="cpt_r">view</th>
											</tr>
										</thead>
										<tbody>
                                            <?php $count=1; ?>
											@foreach($orders as $orderdet)
												<tr id="{{$orderdet->id}}">
													<td><span class="cp_no">{{$count++}}</span></td>
													<td><span class="cp_no">{{$orderdet->order_id}}</span></td>
                                                    <td><p class="cpp_total" >{{$orderdet->gross_amount}}</p></td>
                                                    <td><p class="cpp_total" >{{$orderdet->tax_amount}}</p></td>
                                                    <td><p class="cpp_total" >{{$orderdet->discount}}</p></td>
													<td><p class="cpp_total" >{{$orderdet->total_amount}}</p></td>
													<?php $total +=$orderdet->total_amount; ?>
													<td><a class="btn btn-default"  href="{{route('frontend.view.order.details',[$orderdet->id])}}" pid="{{$orderdet->id}}"><i class="fa fa-eye"></i></a></td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
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