@include('frontend_user.header')
		

	<!-- Page item Area -->
	<div id="page_item_area">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 text-left">
					<h3>Product Details</h3>
				</div>		

				<div class="col-sm-6 text-right">
					<ul class="p_items">
						<li><a href="#">home</a></li>
						<li><a href="{{route('frontend.category.list')}}">{{$category->category_name}}</a></li>
						<li><a href="{{route('frontend.subcategory.list',[$category->id])}}">{{$subcategory->subcategory_name}}</a></li>
						<li><span>{{$product->product_name}}</span></li>
					</ul>					
				</div>	
					
			
				
			</div>
		</div>
	</div>

	<!-- Product Details Area  -->
	<div class="prdct_dtls_page_area">
		<div class="container">
			<div class="row">
				<!-- Product Details Image -->
				<div class="col-md-6 col-xs-12">
					<div class="pd_img fix">
						<a class="venobox" href=" {{url('storage/products/'.$product->image)}}"><img src="{{url('storage/products/'.$product->image)}}" alt=""/></a>
					</div>
				</div>
				<!-- Product Details Content -->
				<div class="col-md-6 col-xs-12">
					<div class="prdct_dtls_content">
						<a class="pd_title" href="#">{{$product->product_name}}</a>
						<div class="pd_price_dtls fix">
							<!-- Product Price -->
							<div class="pd_price">
								<span class="new"> &#x20b9; {{$product->price}}</span>
								@if($product->discouted_price !=$product->price)
								<span class="old">&#x20b9; {{$product->discouted_price}}</span>
								@endif
							</div>
							<!-- Product Ratting -->
							

							
							<div class="pd_ratng">
								<div class="rtngs">
									<?php $i=0?>
									@for($i=0;$i< $product->avg_rating ;$i++)
										
									<i class="fa fa-star"></i>
									
									@endfor
									@for($j=$i;$j <$product->rating;$j++)
										<i class="fa fa-star-o"></i>
									@endfor
								</div>
							</div>
						</div>
						<div class="pd_text">
							<h4>overview:</h4>
							
							<p>{{$product->specification}}</p>
							@if(strlen($product->specification) > 100)
							<a class="btn btn-primary" href="#description"> Read more</a>
							@endif
						</div>
						@if($product ->type==2)
							<div class="pd_img_size fix">
								<h4>size:</h4>
								<a href="#">s</a>
								<a href="#">m</a>
								<a href="#">l</a>
								<a href="#">xl</a>
								<a href="#">xxl</a>
							</div>
							@endif

							<div class="pd_clr_qntty_dtls fix">
							@if($product ->type==2)
								<div class="pd_clr">
									<h4>color:</h4>
									<a href="#" class="active" style="background: #ffac9a;">color 1</a>
									<a href="#" style="background: #ddd;">color 2</a>
									<a href="#" style="background: #000000;">color 3</a>
								</div>
							@endif
							<div class="pd_qntty_area">
								@if($product ->quantity > 0)
									<h4>quantity:</h4>
									<form action="" >
									<div class="pd_qty fix">
										<input value="0" name="qttybutton"  id="prod_qty"class="cart-plus-minus-box" type="number" min="0">
									</div>
									</form>
								@endif
							</div>
						</div>
						<!-- Product Action -->
						<div class="pd_btn fix">
							@if($product ->quantity > 0)
							<a class="btn btn-default acc_btn cart-btn" name="{{$product->id}}"  href="javascript:void(0)" id="cart-btn">add to cart</a>
							@else
							<button class="btn btn-default acc_btn" disabled>out of stock</button>
							@endif
							@if(\Auth::user() && (in_array($product->id,$wished_prod)) )
							<a href="javascript:void(0)" data-tip="Remove from Wishlist" pid="{{$product->id}}" class="remove-wishlist m-t-8 btn"><i class="fa fa-minus-circle"></i></a>
							@else
							<a href="javascript:void(0)" data-tip="Add to Wishlist" class="add-wishlist m-t-8 btn" pid="{{$product->id}}"><i class="fa fa-shopping-bag"></i></a>
							@endif
							<!-- <a class="btn btn-default acc_btn btn_icn"><i class="fa fa-refresh"></i></a> -->
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">					
					<div class="pd_tab_area fix">									
						<ul class="pd_tab_btn nav nav-tabs" role="tablist">
						  <li>
							<a class="active" href="#description" role="tab" data-toggle="tab">Description</a>
						  </li>
						 
						  <li>
							<a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
						  </li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade show active" id="description">
								<p>{{$product->specification}}</p>
												  
							</div>

								<div role="tabpanel" class="tab-pane fade" id="reviews">
									@if($users_product_reviews->count()>0)
										<div class="pda_rtng_area fix">
											<h4>{{$product ->avg_rating}} <span> (Overall)</span></h4>
											<span>Based on {{$count_reviews[0]['count']}} Comments</span>
										</div>
										<div class="rtng_cmnt_area fix">
											@if(isset($users_product_reviews))
												@foreach($users_product_reviews as $preview)
													<div class="single_rtng_cmnt">
														<div class="rtngs">
															@for($i=0;$i< $preview->rating;$i++)
															<i class="fa fa-star"></i>
															
															@endfor
														<span>({{$preview->rating}})</span>
														</div>
														<div class="rtng_author">
															<h3> {{ $preview->first_name}} {{ $preview->last_name}}</h3>
															<span>{{\Carbon\Carbon::parse($preview->review_date)->format('d-M-Y')}}</span>
															<span></span>
														</div>
														<p>{{$preview->review}}</p>
													</div>
												@endforeach									
											@endif
										</div>
									@else
										No reviews for this product!!
									@endif
									@if(\Auth::user()!=null)
									<div class="col-md-12 rcf_pdnglft">
										<div class="rtng_cmnt_form_area fix">
											<h3 class="comment_message">Add your Comments</h3>
											<div class="rtng_form">
												<!-- <form action=""> -->
													<div class="input-area">
														<textarea name="message" placeholder="Write a review" id="message"></textarea>
													</div>
													<div class='rating-stars text-center'>
														<ul id='stars' name="">
														<li class='star' title='Poor' data-value='1'>
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Fair' data-value='2'>
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Good' data-value='3'>
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='Excellent' data-value='4'>
															<i class='fa fa-star fa-fw'></i>
														</li>
														<li class='star' title='WOW!!!' data-value='5'>
															<i class='fa fa-star fa-fw'></i>
														</li>
														</ul>
													</div>
													<input class="btn border-btn" id="review_btn" type="button" value="Add Review" />
												<!-- </form> -->
											</div>
										</div>
									</div>
									@endif				  
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	<!-- Related Product Area -->
	<div class="related_prdct_area text-center">
		<div class="container">		
				<!-- Section Title -->
				<div class="rp_title text-center"><h3>Related products</h3></div>
				
				<div class="row">
					@if(isset($all_products))
						@foreach($all_products as $prd)
						
							<div class="col-lg-3 col-md-4 col-sm-6">
								<div class="product-grid">
									<div class="product-image">
										<a href="{{route('frontend.product.details',[$prd->id,$subcategory->id,$category->id])}}">
											<img class="pic-1" src="{{url('storage/products/'.$prd->image)}}" alt="Product Image">
											<img class="pic-2" src="{{url('storage/products/'.$prd->image)}}" alt="Product Image">
										</a>
										<ul class="social">
											<li><a href="#" data-tip="Quick View"><i class="ti-zoom-in"></i></a></li>
											<li><a href="#" data-tip="Add to Wishlist"><i class="ti-bag"></i></a></li>
											<li><a href="#" data-tip="Add to Cart"><i class="ti-shopping-cart"></i></a></li>
										</ul>
										<!-- <span class="product-new-label">Sale</span> -->
									</div>
									<ul class="rating">
										@for($i=0;$i<$prd->rating;$i++)
										<li class="fa fa-star"></li>
										@endfor
									</ul>
									<div class="product-content">
										<h3 class="title"><a href="#">{{$prd->product_name}}</a></h3>
										<div class="price">{{$prd->price}}
											@if($prd->discouted_price !=$prd->price)
												<span>{{$prd->discouted_price}}</span>
											@endif
										</div>
										<a class="add-to-cart" href="#">+ Add To Cart</a>
									</div>
								</div>
							</div><!-- End Col -->

						@endforeach	
					@else
						No Product Found!!
					@endif
									
			</div>
		</div>
	</div>
@include('frontend_user.footer')

<script>

$(document).ready(function(){
	$("body").floatingSocialShare({
		buttons: [
		"facebook", "linkedin", "pinterest", 
		"telegram", "viber", "twitter", "whatsapp"
		],
		text: "share with: ",
		url: "{{route('frontend.product.details',[$product ->id,$subcategory->id,$category->id])}}"
  	});
	//   $('#cart-btn').click(function(){
	// 	var value=$('#prod_qty').val();
	// 	var id=$(this).attr('name');

	// 	if(value==0)
	// 	{
	// 		alert("please select Quantity");
	// 		return false;
	// 	}	
	// 	// alert(id);
	// 	$.ajax({
	// 		url:'{{route("frontend.cart.add")}}',
	// 		method:'get',
	// 		dataType:'json',
	// 		data:{'value':value,'id':id},
	// 		success:function(response)
	// 		{
	// 			if(response['login']==false)
	// 			{
	// 				var route="{{route('frontend.user.login')}}";
	// 				window.location.replace(route);
	// 			}
	// 			if(response['message']=="success")
	// 			{
	// 				alert("product added to cart successfully");
	// 				return false;
	// 			}
	// 			if(response['fail']=="fail")
	// 			{
	// 				alert("can not added to cart");
	// 				return false;
	// 			}
	// 		}
	// 	});
	// });	
  
	$('#prod_qty').change(function(){
		// alert("hello");
		var value=$(this).val();
		var id=<?php echo $product ->id;?>;
		<?php 
			if(isset($product))
			{
				$prod= $product ->quantity;
		?>
		if(<?php echo $prod; ?> < value)
		{
			$('#cart-btn').html("product Out of stock");
			$('#cart-btn').attr('type','button');
			$('#cart-btn').css('cursor','not-allowed');
		}
		else
		{
		$('#cart-btn').html("Add to Cart");
			$('#cart-btn').removeAttr('type','button');
		//  $('#cart-btn').attr('href');
			$('#cart-btn').css('cursor','pointer');
		}

	 	<?php
	}
		 ?>
	
});
		

	//Rating jquery

	$('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
   
    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	$('#stars').attr('name',ratingValue);
    
  });
  $('#review_btn').click(function(){
	  var review=$('#message').val();
	  var rating=$('#stars').attr('name');
	  var pid=<?php echo $product->id;?>;
	//   alert(pid);
	  $.ajax({
		  url:'{{route("frontend.product.details.reviews.store")}}',
		  method:'get',
		  data:{'review':review,'rating':rating,'pid':pid},
		  success:function(data)
		  {
			if(data=="success"){
					$('.rtng_form').css('display','none');
					$('.comment_message').html('Your reviews added successfully');
				}
				else
				{
					$('.comment_message').html('please try again');	
				}
			}
	  });
  });
  

});



</script>