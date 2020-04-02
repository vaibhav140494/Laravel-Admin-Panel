@include('frontend_user.header')

        <div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Support</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><span>Support</span></li>
						</ul>					
					</div>	
				</div>
			</div>
        </div>
     
        <div class="contact_page_area fix">
			<div class="container">					
				<div class="row">
					<div class="contact_frm_area text-left col-lg-6 col-md-12 col-xs-12">
						<h3>Get in Touch</h3>
						<form action="{{route('frontend.support.ticket.store')}}" method="post">
                            @csrf
							<div class="form-row">
								<div class="form-group col-sm-6"><input type="text" class="form-control" placeholder="Name*" value="{{\Auth::user()->first_name}}" name="Name" id="Name"/></div>
								<div class="form-group col-sm-6"><input type="text" class="form-control" placeholder="Email*" value="{{\Auth::user()->email}}" name="Email" id="Email"/></div>
							</div>
                            <div class="form-group">
                            {{ Form::label('orders','Your Orders', ['class' => 'col-sm-6 control-label required']) }}

                            <div>
                                <select name="orders" id="orders" class="form-control box-size">
                                    @if(isset($orders))
                                    @foreach($orders as $order)
                                    <option value="{{$order->id}}" class="dropdown-item">{{$order->order_id}}</option>
                                    @endforeach
                                    @endif
                                    <option value="other" class="dropdown-item"> Other </option>
                                </select>
                            </div>
                            </div>
							<div class="form-group">
                                
                                {{ Form::label('subject','select subject', ['class' => 'col-sm-6 control-label required']) }}

                            <div>
                                <select name="subject" id="subject" class="form-control box-size">
                                    @if(isset($topics))
                                    @foreach($topics as $topic)
                                    <option value="{{$topic->id}}" class="dropdown-item">{{$topic->topic}}</option>
                                    @endforeach
                                    @endif
                                    
                                </select>
                            </div>
							</div>
				
							<div class="form-group">
								<textarea name="message" class="form-control" placeholder="Message"></textarea>
							</div>
							
							<div class="input-area submit-area"><button class="btn border-btn" type="submit" >Generate Ticket</button></div>
							
						</form>		
					</div>	
				
					<div class="contact_info col-lg-6 col-md-12 col-xs-12">
						<h3>Your Tickets</h3>
						<div class="table-responsive">
                            <table class="table cart-table cart_prdct_table text-center">
                            <thead>
                                <tr>
                                    <th class="cpt_no">#</th>
                                    <th class="cpt_p">topic name</th>
                                    <th class="cpt_p">order id</th>
                                    <th class="cpt_p">status</th>
                                </tr>
                            </thead>
                            <?php $count=1; ?>
                            <tbody>
                                @if(isset($tickets))
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td><p class="cart-pro-title">{{$ticket->topic}}</p></td>
                                        <td><p class="cart-pro-title">{{$ticket->order_id}}</p></td>
                                        <td><p class="cart-pro-title">{{$ticket->status}}</p></td>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>
                            </table>
                        </div>
						
					</div>
				</div>
			</div>
		
							
			
				
        </div>        
        
        @include('frontend_user.footer')

<script>

</script>