<?php //print_r($errors); exit; ?>
@include('frontend_user.css')
<div id="page_item_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 text-left">
						<h3>Account</h3>
                        
					</div>		

					<div class="col-sm-6 text-right">
						<ul class="p_items">
							<li><a href="{{url('frontend_user.index')}}">home</a></li>
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
                        @if($errors !='[]')
                            <div class="alert alert-danger alert-dismissible fade show" id="login-err" role="alert">
                                <strong>{{$errors}}</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div> 
                            @endif
                            <form action="{{route('frontend.login.store')}}" method="post" id="login-form" name="login-form">
                            @csrf
                                <div class="create_account_area">
                                    <h2 class="caa_heading">Log In</h2>
                                    <div class="caa_form_area">
                                        <div class="caa_form_group">
                                            <div class="login_email">
                                                <label  >Email address</label>
                                                <div class="input-area"><input type="email" id="email" name="email"/></div>
                                                <span for="Email"class="label label-danger" style="display:block;" id="email-err"></span>

                                            </div>

                                            <div class="login_password">
                                                <label >Password</label>
                                                <div class="input-area"><input type="password"  id="password" name="password" /></div>
                                                <!-- <span  class="label label-danger" style="display:block;" id="password-err"></span> -->
                                            </div>
                                            <p class="remember_me" style="float:left; margin-right:90px;">
                                                <input type="checkbox" name="rememberme">Remember Me
                                            </p>
                                            <p class="forgot_password" style="float:right;">
                                                <a href="#" title="Recover your forgotten password" rel="">Forgot your password?</a>
                                            </p>
                                            <button type="submit" id="acc_Login" class="btn btn-default acc_btn" > 
                                                <span> <i class="fa fa-lock btn_icon"></i> Sign in </span> 
                                            </button>
                                            <a class="login-link" href="{{url('/register')}}"> 
                                                New User? Sign Up 
                                            </a>
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
    
    <!-- <script>
    $(document).ready(function(){
       
       
        $('#emailid').blur(function(){
            var email =$(this).val();
            if(email=='')
            {
                $('#email-err').html('email can not be blank');
                // $('#email-err').addClass('label-danger');
            }
            else
            {
                $('#email-err').html('');
            }


        });
        $('#password').blur(function(){
            var pass =$(this).val();
            var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            if(pass=='')
            {
                $('#password-err').html('password can not be blank');
                // $('#email-err').addClass('label-danger');
            }
            else if(!(pass.match(strongRegex)))
            {
                $('#password-err').html('Please Write ateast one small letter capital letter one digit and one special letter');

            }
            else if(pass.length <8)
            {
                $('#password-err').html('password must atleast 8 characters');

            }
            else
            {
                $('#password-err').html('');
            }
           
        });
        $('#login-form').submit(function(){
        if (($('#email-err').val() =='')&&($('#password-err').val() ==''))
            {
                $('#acc_Login').prop('disabled',false);
            } 
        });
    });
    </script> -->
    <script type="text/javascript">
    $(document).ready(function(){
        
        $.validator.addMethod("passwordcheck", function(value, element) {
            if (value.length > 0) {
                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);
            } else {
                return true;
            }
        });
        // $("#login-form").validate({
        //     rules:{
        //         email: {
        //             required: true,
        //             email:true
        //         },
        //         password: {
        //             required:true,
        //             minlength: 8,
        //             // maxlength: 20,
        //             passwordcheck: function(element) {
        //                 return ($('#password').val());
        //             },
        //         }    
        //     },
        //     messages:{
        //         password:{
        //             required: "password is required",
        //             passwordcheck:"password must contain atleast capital small digit and special character"
        //         }
        //     }

        //     // errorPlacement: function(error, element) {
        //     //     $(error).appendTo($(element).parent());
        //     // },
        //     // submitHandler: function (form) {
        //     //     form.submit();
        //     // }
        // });

        // $('#login-form').on('submit', function(e) {
        //     // e.preventDefault();
        //     $(".page-loader-wrapper").show();
        //     if (!$('#add_account_form').valid()) {
        //         $(".page-loader-wrapper").hide();
        //         return false;
        //     }
        //     $(".page-loader-wrapper").hide();
        //     return true;
        // });
        
    });
    </script>