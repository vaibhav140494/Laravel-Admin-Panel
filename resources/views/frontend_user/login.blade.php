@include('frontend_user.css')
<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Account</h3>
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="#">home</a></li>
							<li><span>Login</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
<div class="login_page_area">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						
                    </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <form action="{{url('frontend/login/store')}}" method="post">
                            @csrf
                            <div class="create_account_area">
                                <h2 class="caa_heading">Log In</h2>
                                <div class="caa_form_area">
                                    <div class="caa_form_group">
                                        <div class="login_email">
                                            <label>Email address</label>
                                            <div class="input-area"><input type="email"  name="email"/></div>
                                        </div>
                                        <div class="login_password">
                                            <label>Password</label>
                                            <div class="input-area"><input type="password" name="password" /></div>
                                        </div>
                                        <p class="remember_me" style="float:left; margin-right:90px;">
                                            <input type="checkbox" name="rememberme">Remember Me
                                        </p>
                                        <p class="forgot_password" style="float:right;">
                                            <a href="#" title="Recover your forgotten password" rel="">Forgot your password?</a>
                                        </p>
                                        <button type="submit" id="acc_Login" class="btn btn-default acc_btn"> 
                                            <span> <i class="fa fa-lock btn_icon"></i> Sign in </span> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
						
					</div>
				</div>
			</div>
		</div>	
    @include('frontend_user.script')