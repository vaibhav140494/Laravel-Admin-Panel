@include('frontend_user.header')


		<!-- Page item Area -->
		<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Shop Details</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
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
				<div class="row">
					<div class="col-sm-12">
						<div class="cart_table_area table-responsive">
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
									<tr>
										<td><span class="cp_no">1</span></td>
										<td><a href="#" class="cp_img"><img src=" {{url('frontend/img/cart-prdct/1.jpg')}}" alt="" /></a></td>
										<td><a href="#" class="cp_title">This is Product Title</a></td>
										<td>										
											<div class="cp_quntty">																			
												<input name="quantity" value="1" size="2" type="number">													
											</div>
										</td>
										<td><p class="cp_price">$104.99</p></td>
										<td><p class="cpp_total">$104.99</p></td>
										<td><a class="btn btn-default cp_remove"><i class="fa fa-trash"></i></a></td>
									</tr>
									
									<tr>
										<td><span class="cp_no">2</span></td>
										<td><a href="#" class="cp_img"><img src="{{url('frontend/img/cart-prdct/2.jpg')}}" alt="" /></a></td>
										<td><a href="#" class="cp_title">This is Product Title</a></td>
										<td>
											<div class="cp_quntty">																			
												<input name="quantity" value="1" size="2" type="number">													
											</div>
										</td>
										<td><p class="cp_price">$104.99</p></td>
										<td><p class="cpp_total">$104.99</p></td>
										<td><a class="btn btn-default cp_remove"><i class="fa fa-trash"></i></a></td>
									</tr>
									
									<tr>
										<td><span class="cp_no">3</span></td>
										<td><a href="#" class="cp_img"><img src="{{url('frontend/img/cart-prdct/3.jpg')}}" alt="" /></a></td>
										<td><a href="#" class="cp_title">This is Product Title</a></td>
										<td>
											<div class="cp_quntty">																			
												<input name="quantity" value="1" size="2" type="number">													
											</div>
										</td>
										<td><p class="cp_price">$104.99</p></td>
										<td><p class="cpp_total">$104.99</p></td>
										<td><a class="btn btn-default cp_remove"><i class="fa fa-trash"></i></a></td>
									</tr>
									
									<tr>
										<td><span class="cp_no">4</span></td>
										<td><a href="#" class="cp_img"><img src="{{url('frontend/img/cart-prdct/4.jpg')}}" alt="" /></a></td>
										<td><a href="#" class="cp_title">This is Product Title</a></td>
										<td>
											<div class="cp_quntty">																			
												<input name="quantity" value="1" size="2" type="number">													
											</div>
										</td>
										<td><p class="cp_price">$104.99</p></td>
										<td><p class="cpp_total">$104.99</p></td>
										<td><a class="btn btn-default cp_remove"><i class="fa fa-trash"></i></a></td>
									</tr>
									
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
									<a href="#" class="btn border-btn">update shopping bag</a>
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
							<p><span>Subtotal</span><span>$200.00</span></p>
							<h4><span>Grand total</span><span>$190.00</span></h4>
							<a href="checkout.html" class="btn border-btn">process to checkout</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>

    @include('frontend_user.footer')
