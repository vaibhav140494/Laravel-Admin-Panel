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
    <form action="{{route('frontend.user.changepassword')}}" id="change-pass" method="post">
    @csrf
       
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-group">
                    <input type="password" name="oldpass" id="oldpass" placeholder="Enter Old Password">
                    <span style="color:red;">{{$errors->chpass->first('oldpass') ?? ''}}</span>
                    @if(isset($unauthorized))
                     <span style="color:red">{{ $unauthorized }}</span> 
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" name="newpass" id="newpass" placeholder="Enter new Password">
                    <span style="color:red;">{{$errors->chpass->first('newpass') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="password" name="conpass" id="conpass" placeholder="Enter Confirm Password">
                    <span style="color:red;">{{$errors->chpass->first('conpass') ?? ''}}</span>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <button class="btn btn-default acc_btn " type="submit" > 
                    <span> <i class="fa fa-user btn_icon"></i> Change Password </span> 
                </button>
            </div>
            <div class="col-3"></div>
        </div>
    
    </div>
</form>
		</div>	
    @include('frontend_user.script')
    <script type="text/javascript">
    $(document).ready(function(){
        
        $.validator.addMethod("passwordcheck", function(value, element) {
            if (value.length > 0) {
                alert("hello");
                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);
            } else {
                return true;
            }

            $('#change-pass').validate({
                rules:{
                    oldpass:{
                        required:true,
                    },
                    newpass:{
                        required:true,
                        minlength:8,
                        passwordcheck:function(event){
                            return($('#newpass').val());
                        }
                    },
                    conpass:{
                        required:true,
                        equalTo:'#newpass'
                    }
                },
                messages:{
                      oldpass:{
                            required:"Old pass is required"
                      },
                      newpass:{
                          requied:"New password ids required",
                          passwordcheck: "password must contain atleast capital small digit and special character"
                      },
                      conpass:{
                          required:"Confirm password is required",
                          equalTo:"Confirm password must be same as new password "
                      }  
                }
            });
        });

    });
    </script>