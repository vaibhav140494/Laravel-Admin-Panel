@include('frontend_user.css')
<div id="page_item_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h3 class="">Edit Profile</h3>
            </div>		

            <div class="col-sm-6 text-right">
                <ul class="p_items">
                    <li><a href="{{url('/')}}">home</a></li>
                    <li><span>Edit Profile</span></li>
                </ul>					
            </div>	
        </div>
    </div>
</div>
@if(!isset($register))
<form action="{{route('frontend.register.update',['id'=>$user->id])}}" id="register-form" method="post">

    @csrf
    <input type="hidden" value="{{url()->previous()}}" name="hiddenurl">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <input type="text" name="first_name" placeholder="Enter First Name" value="{{ $user->first_name }}">
                    <span style="color:red;">{{$errors->register->first('first_name') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" placeholder="Enter Last Name" value="{{  $user->last_name }}">
                    <span style="color:red;">{{$errors->register->first('last_name') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <textarea name="address" class="textarea" cols="10" rows="5" placeholder="Enter Address">{{  $user->address }}</textarea>
                    <span style="color:red;">{{$errors->register->first('address') ?? ''}}</span>
                </div>
                
            </div>
            <div class="col-6">
            <div class="form-group">
                    <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" value="{{  $user->pincode }}">
                    <span style="color:red;">{{$errors->register->first('pincode') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="enter Email" value="{{  $user->email }}">
                    <span style="color:red;">{{$errors->register->first('email') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter User Name" value="{{  $user->username }}">
                    <span style="color:red;">{{$errors->register->first('username') ?? ''}}</span>
                </div>
                
                <div class="form-group">
                    <input type="date" name="birthdate" placeholder="Enter Birthdate" value="{{  $user->birthdate }}">
                    <span style="color:red;">{{$errors->register->first('birthdate') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" id="phoneno" name="phone_no" placeholder="enter Phone no" value="{{  $user->phone_no }}">
                    <span style="color:red;">{{$errors->register->first('phone_no') ?? ''}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <button class="btn btn-default acc_btn " type="submit" id="acc_Create"> 
        <span> <i class="fa fa-user btn_icon"></i> Edit Profile </span> 
    </button>
   
    </div>
</form>
@endif
       
@include('frontend_user.script')
<script type="text/javascript">
$(document).ready(function(){
    $.validator.addMethod("passwordcheck", function(value, element) {
        if (value.length > 0) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);
        } else {
            return true;
        }
    });
    $.validator.addMethod("phonenocheck", function(value, element) {
        if (!(isNaN(value))) {
            return value;
        } else {
            return false;
        }
    });
    $('#register-form').validate({
        rules:{
            first_name: {
                required:true
            },
            last_name: {
                required:true
            },
            address: {
                required:true
            },
            pincode: {
                required:true,
                phonenocheck: function(element) {
                    return ($('#pincode').val());
              }          
            },
            email: {
                required: true,
                email:true
            },
            username: {
                required:true
            },
            birthdate: {
                required:true
            },
            phone_no: {
                required:true,
                phonenocheck: function(element) {
                    return ($('#phoneno').val());
                }, 
                minlength:10,
                maxlength:10
            }
        },
        messages:{
            phone_no:{
                phonenocheck:"please enter only digits",
                minlength:"please enter atleast 10 digits",
                maxlength:"please enter only 10 digits"
            },
                pincode:{
                    phonenocheck:"please enter only numeric value"
                }
            
        }
    });
});

</script>
