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
	<meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="title">
							<h3>Address List</h3>
							
                        </div>
							<div class="address-container-user">
								@foreach ($address as $addr)
									<div class="row">
										<div class="offset-md-2 col-md-1">
											<input type="radio" name="address" value="{{$addr->id}}" id="{{$addr->id}}" <?php echo (\Auth::user()->default_address == $addr->id) ? "checked": " " ;  ?>> 
										</div>
										<div class="col-md-5">
											<span>{{\Auth::user()->first_name}}</span>
											<span>{{\Auth::user()->last_name}}</span>
											<p style="margin:0 auto;">{{$addr->address}}</p>
											<p style="margin:0 auto;">{{$addr->pincode}}</p> 
											<p style="margin:0 auto;">{{$addr->city}}</p>
											<p style="margin:0 auto;">{{$addr->state}}</p> 
											<p style="margin:0 auto;">{{$addr->country}}</p>
										</div>
										<div class="col-md-4">
											<span><a href="{{route('frontend.user.address.edit',[$addr->id])}}" style="color:#000;" id="address_edit" name="{{$addr->id}}"><i class="fa fa-pencil" style="font-size:18px;margin-right:10px;" ></i></a></span>
											<span><a href="javascript:void(0)" id="address_delete_user" name="{{$addr->id}}"  uid="{{\Auth::user()->id}}" style="color:#000;"><i class="fa fa-trash" style="font-size:18px;margin-right:10px;"></i></a></span>
										</div>
									</div>
								@endforeach 
								<a  href="{{route('frontend.user.register.user.address.add')}}" class="btn btn-primary pull-right">Add Address</a>
							</div>
                    </div>
					
					
                    <div class="col-md-8">
                        <div class="title">
                            <h3>your order</h3>
                        </div>
						
						<div class="your-order-table table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th class="product-name">Product Name</th>
										<th class="product-total">Quantity</th>
										<th class="product-total">Price</th>
										<th class="product-total">Total</th>
									</tr>
								</thead>
								<tbody>
									@foreach($checkout_prod as $product)
									<tr>
										<td class="product-name">{{$product->product_name}}</td>
										<td class="product-total">{{$product->quantity}}</td>
										<td class="product-total">{{$product->price}}</td>
										<td class="product-total"><span>{{$product->total}}</span></td>
									</tr>
									@endforeach	
								</tbody>
								<tfoot>
									<tr>
										<th>Total</th>
										<td colspan="3"><span class="amount">{{$total}}</span></td>
									</tr>
									<tr>
									<th>Discount</th>
									<td colspan="3"><span class="amount">{{$discount}}</span></td>
									</tr>
									<tr>
									<th>Disconted Price</th>
									<td colspan="3"><span class="amount">{{$discounted_price}}</span></td>
									</tr>
								</tfoot>
							</table>
						</div>
						
                        <div class="payment_method">           
							<ul>
								<li>
									<div class="custom-control custom-radio">
										<input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" required>
										<label class="custom-control-label" for="customRadio2">Paytm</label>
									</div>	
								</li>
							</ul>     
                        </div>
						
                        <div class="qc-button">
                            <a href="{{route('frontend.placeorder')}}" class="btn border-btn" tabindex="0">Place Order</a>
                        </div>
                    </div>
					
                </div>
            </div>
        </section>
<script>
$(document).ready(function(){
	$(document).on('click','#address_delete_user',function(){
        var id=$(this).attr('name');
        var uid=$(this).attr('uid');
        var div='';
        // alert(uid);
        // alert(radio);
            radio_val = $("input[name='address']:checked"). val();
            // alert(radio_val);
            if(radio_val == id)
            {
            bootbox.alert("please select default addres");
            return false;
        }
        // console.log($('.address-container-user').html());
        // alert(url);
        
        bootbox.confirm("Do you really want to delete record?", function(result) {
            if(result){
                $.ajax({
                    url:'{{route("frontend.user.register.user.delete.address")}}',
                    method:'post',
                    dataType:'json',
                    data:{'id':id,'uid':uid,'radio_val':radio_val},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success:function(data)
                    {      
                        
                        if(data['message']==true)
                        {
                            user=data['user'];
                            address=data['data'];
                            console.log(user);
                            console.log(data);
                            // return false;
                            checked=" ";
                            checkid = " ";
                            bootbox.alert(' address deleted successfully');
                            $.each(address,function(k,value){
                                console.log(value.id);
                                var route='{{route("admin.access.user.address.edit",[1])}}';
                                console.log(route);
                                if(user.default_address==value.id){
                                    checked="checked";
                                    checkid=value.id;
                                }                                            


                                div+='<div class="row"><div class="offset-md-2 col-md-1"><input type="radio" name="address" value="'+value.id+'" id="'+value.id+'"> </div><div class="col-md-5"><span>'+user.first_name+'</span>  <span>'+user.last_name+'</span><p style="margin:0 auto;">'+value.address+'</p><p style="margin:0 auto;">'+value.pincode+'</p> <p style="margin:0 auto;">'+value.city+'</p><p style="margin:0 auto;">'+value.state+'</p> <p style="margin:0 auto;">'+value.country+'</p></div><div class="col-md-4"><span><a href="" style="color:#000;" id="address_edit" name="'+value.id+'"><i class="fa fa-pencil" style="font-size:18px;margin-right:10px;" ></i></a></span><span><a href="javascript:void(0)" id="address_delete_user" name="'+value.id+'"  uid="'+user.id+'" style="color:#000;"><i class="fa fa-trash" style="font-size:18px;margin-right:10px;"></i></a></span></div></div>';
                            });
                            console.log(checked);
                            $('.address-container-user').html(div);
                            $("#"+checkid).prop("checked", true);

                        }
                        else
                        {
                            bootbox.alert('addres is not deleted deleted ');
                        } 
                    }
                });
            }
        });
    });

});
</script>

@include('frontend_user.footer');