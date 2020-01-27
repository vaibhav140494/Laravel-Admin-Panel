@include('frontend_user.css')
<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Account</h3>
                        
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{url('front')}}">home</a></li>
							<li><span>Login</span></li>
						</ul>					
					</div>	
				</div>
			</div>
		</div>
<div class="login_page_area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="create_account_area caa_pdngbtm">
                    <h2 class="caa_heading">Create an account</h2>
                    <div class="caa_form_area">
                        <p>Please enter your email address to create an account.</p>
                        <div class="caa_form_group">
                            <div class="caf_form">
                                <label>Email address</label>
                                <div class="input-area"><input type="email" /></div>
                            </div>
                            <button class="btn btn-default acc_btn" type="submit" id="acc_Create"> 
                                <span> <i class="fa fa-user btn_icon"></i> Create an account </span> 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="create_account_area">
                    <h2 class="caa_heading">Already registered?</h2>
                    <div class="caa_form_area">
                        <div class="caa_form_group">
                            <div class="login_email">
                                <label>Email address</label>
                                <div class="input-area"><input type="email" /></div>
                            </div>
                            <div class="login_password">
                                <label>Password</label>
                                <div class="input-area"><input type="password" /></div>
                            </div>
                            <p class="forgot_password">
                                <a href="#" title="Recover your forgotten password" rel="">Forgot your password?</a>
                            </p>
                            <button type="submit" id="acc_Login" class="btn btn-default acc_btn"> 
                                <span> <i class="fa fa-lock btn_icon"></i> Sign in </span> 
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>	
@include('frontend_user.script')
