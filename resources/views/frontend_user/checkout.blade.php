@include('frontend_user.header');
			
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
							<li><span>Checkout</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
		
		

	<!-- Checkout Page -->
	<section class="checkout_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="title">
                            <h3>Billing Details</h3>
                        </div>
                        <form class="checkout_form" action="#" method="post">
							<div class="form-row">
								<div class="form-group col-md-6">
									<input name="first_name" placeholder="First name" class="form-control" type="text">
								</div>
								
								 <div class="form-group col-md-6">								
									<input name="last_name" placeholder="Last name" class="form-control" type="text">
								</div>
							</div>
							
                            <div class="form-group">      
                                  <input name="company_name" placeholder="Company name" class="form-control" type="text">                         
                            </div>
							
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="email" placeholder="Email address" class="form-control" type="email">
                                </div>
                           
      
                                <div class="form-group col-md-6">
                                    <input name="phone" placeholder="Phone number" class="form-control" type="text">
                                </div>
							</div>
								
                            <div class="form-group">  
								<label for="country">Country:</label>
								<div class="custom-select-wrapper" >
									<select id="country" class="custom-select" >
										<option value="canada">Canada *</option>
										<option value="american">American</option>
										<option value="australia">Australia</option>
									</select>
								</div>
                            </div>
							
							
                            <div class="form-group">
								<label for="address">Address:</label>    
								<textarea rows="3" name="street" id="address" placeholder="Street address. Apartment, suite, unit etc. (optional)" class="form-control"></textarea>
                            </div>
							
                             <div class="form-row">
                               <div class="form-group col-md-6">
                                    <input name="code" placeholder="Post code / Zip" class="form-control" type="text">
                                </div>
								
								 <div class="form-group col-md-6">
                                    <input name="city" placeholder="Town / City" class="form-control" type="text">
                                </div>								
                            </div>

                            <div class="form-group">
								<label for="address">Order note:</label>    
								<textarea rows="3" name="street" placeholder="Order note" class="form-control"></textarea>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="customCheck1">
									<label class="custom-control-label" for="customCheck1">SHIP TO A DIFFERENT ADDRESS?</label>
								</div>                             
                            </div>
                        </form>
                    </div>
					
					
                    <div class="col-md-6">
                        <div class="title">
                            <h3>your order</h3>
                        </div>
						
						<div class="your-order-table table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="product-name">Product Name</th>
										<th class="product-total">Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="product-name">Pack</td>
										<td class="product-total"><span>$20.00</span></td>
									</tr>
									<tr>
										<td class="product-name">Deluxe Pack</td>
										<td class="product-total"><span>$80.00</span></td>
									</tr>
									<tr>
										<td class="product-name">Anti Mask</td>
										<td class="product-total"><span>$40.00</span></td>
									</tr>
									<tr class="sub-total">
										<td class="product-name">Sub Total</td>
										<td class="product-total"><span>$140.00</span></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>Total</th>
										<td><span class="amount">$140.00</span></td>
									</tr>
								</tfoot>
							</table>
						</div>
						
                        <div class="payment_method">           
							<ul>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio1">Direct Bank Transfer</label>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed lobortis sem. Quisque at 
										sapien ut odio</p>
									</div>						
						
								</li>
								
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
										<label class="custom-control-label" for="customRadio2">PayPal</label>
									</div>	
								</li>
							</ul>     
                        </div>
						
                        <div class="qc-button">
                            <a href="#" class="btn border-btn" tabindex="0">Place Order</a>
                        </div>
                    </div>
					
                </div>
            </div>
        </section>


@include('frontend_user.footer');