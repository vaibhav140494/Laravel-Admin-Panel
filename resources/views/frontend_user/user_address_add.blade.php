@include('frontend_user.css')
<div id="page_item_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 text-left">
                <h3 class=""> Add Address</h3>
            </div>		

            <div class="col-sm-6 text-right">
                <ul class="p_items">
                    <li><a href="{{url('/')}}">home</a></li>
                    <li><a href="{{route('frontend.register.edit',[\Auth::user()->id])}}">Edit Profile</a></li>
                    <li><span>Add Address</span></li>
                </ul>					
            </div>	
        </div>
    </div>
</div>
@if(!isset($register))
<form action="{{route('frontend.user.address.store')}}" id="add-address-form" method="post">
    @csrf
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" value="{{url()->previous()}}" name="hiddenurl">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="form-group">
                    <input type="text" name="contact_person" placeholder="Enter Contact Person Name">
                    <!-- <span style="color:red;">{{$errors->register->first('contact_person') ?? ''}}</span> -->
                </div>
                <div class="form-group">
                    <input type="number" name="contact_person_no" placeholder="Enter Contact Person No" >
                    <!-- <span style="color:red;">{{$errors->register->first('last_name') ?? ''}}</span> -->
                </div>
                <div class="form-group">
                    <input type="text" name="country" placeholder="Enter Country" >
                    <span style="color:red;">{{$errors->register->first('country') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" name="state" placeholder="Enter State" >
                    <span style="color:red;">{{$errors->register->first('state') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" name="city" placeholder="Enter City" >
                    <span style="color:red;">{{$errors->register->first('city') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <textarea name="address" class="textarea" cols="10" rows="5" placeholder="Enter Address"></textarea>
                    <span style="color:red;">{{$errors->register->first('address') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="number" min=0 name="pincode" placeholder="Enter Pincode" >
                    <span style="color:red;">{{$errors->register->first('pincode') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <label class="label-control"> Make As default Address</label>
                    <input type="checkbox" name="mk_default_address_chkbx" >
                </div>
                
            </div>  
            <div class="col-md-2"></div>
    </div>
</div>
    <div class="container text-center"> 
        
        <button class="btn btn-default acc_btn " type="submit" id="acc_Create"> 
            <span> <i class="fa fa-user btn_icon"></i>Add Address </span> 
        </button>
   
    </div>
</form>
@endif
       
@include('frontend_user.script')
<script type="text/javascript">


$(document).ready(function(){


    var date = new Date();
    var currentMonth = date.getMonth();
    var currentDate = date.getDate();
    var currentYear = date.getFullYear();

    if(currentMonth.toString().length < 2){
    currentMonth='0'+currentMonth;
    }
    if(currentDate.toString().length < 2){
    currentDate='0'+currentDate;
    }
    var date1=currentYear+"-"+currentMonth+"-"+currentDate;
    console.log(date1);
    // alert(date->format('y-m-d'));
    $('#birthdate').attr('max',date1);
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
    $('#add-address-form').validate({
        rules:{
            
            city: {
                required:true
            },
            state: {
                required:true
            },
            country: {
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
