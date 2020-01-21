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
							<li><a href="#">category</a></li>
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
								<th class="add-cart">add to cart</th>
								<th class="cpt_r">remove</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><span class="cart-number">1</span></td>
								<td><a href="#" class="cp_img"><img src=" {{url('frontend/img/cart-prdct/1.jpg')}}" alt="" /></a></td>
								<td><a href="#" class="cart-pro-title">This is Product Title</a></td>
								<td><p class="stock in-stock">Out of stock</p></td>
								<td><p class="cart-pro-price">$204.00</p></td>
								<td><a href="#" class="btn border-btn">add to cart</a></td>
								<td><a class="cp_remove"><i class="fa fa-trash"></i></a></td>
							</tr>
							<tr>
								<td><span class="cart-number">2</span></td>
								<td><a href="#" class="cp_img"><img src="{{url('frontend/img/cart-prdct/2.jpg')}}" alt="" /></a></td>
								<td><a href="#" class="cart-pro-title">This is Product Title</a></td>
								<td><p class="stock in-stock">in stock</p></td>
								<td><p class="cart-pro-price">$89.00</p></td>
								<td><a href="#" class="btn border-btn">add to cart</a></td>
								<td><a class="cp_remove"><i class="fa fa-trash"></i></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
@include('frontend_user.footer')