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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <textarea name="address" class="textarea" cols="10" rows="5" placeholder="Enter Address"></textarea>
                    <span style="color:red;">{{$errors->register->first('address') ?? ''}}</span>
                </div>
                <div class="from-group">
                    <a href="{{route('frontend.user.changepasswordform')}}" class="btn btn-primary">Change Password</a>
                </div>
            </div>  
            <div class="col-6">
            <div class="form-group">
                    <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode" value="{{  $user->pincode }}">
                    <span style="color:red;">{{$errors->register->first('pincode') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="enter Email" value="{{  $user->email }}" disabled>
                    <span style="color:red;">{{$errors->register->first('email') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter User Name" value="{{  $user->username }}">
                    <span style="color:red;">{{$errors->register->first('username') ?? ''}}</span>
                </div>
                
                <div class="form-group">
                    <input type="date" name="birthdate" id="birthdate"placeholder="Enter Birthdate" value="{{  $user->birthdate }}" max="">
                    <span style="color:red;">{{$errors->register->first('birthdate') ?? ''}}</span>
                </div>
                <div class="form-group">
                    <input type="text" id="phoneno" name="phone_no" placeholder="enter Phone no" value="{{  $user->phone_no }}">
                    <span style="color:red;">{{$errors->register->first('phone_no') ?? ''}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center" style=" text-align:center;"> Address List</h3>
                <a  href="{{route('frontend.user.register.user.address.add')}}" class="btn btn-primary pull-right">Add Address</a>
            </div>
        </div>
        <div class="address-container-user">
            @foreach ($multiple_address as $mulAddr)
                <div class="row">
                    <div class="offset-md-2 col-md-1">
                        <input type="radio" name="address" value="{{$mulAddr->id}}" id="{{$mulAddr->id}}" <?php echo ($user->default_address == $mulAddr->id) ? "checked": " " ;  ?>> 
                    </div>
                    <div class="col-md-5">
                        <span>{{$user->first_name}}</span>
                        <span>{{$user->last_name}}</span>
                        <p style="margin:0 auto;">{{$mulAddr->address}}</p>
                        <p style="margin:0 auto;">{{$mulAddr->pincode}}</p> 
                        <p style="margin:0 auto;">{{$mulAddr->city}}</p>
                        <p style="margin:0 auto;">{{$mulAddr->state}}</p> 
                        <p style="margin:0 auto;">{{$mulAddr->country}}</p>
                    </div>
                    <div class="col-md-4">
                        <span><a href="{{route('frontend.user.address.edit',[$mulAddr->id])}}" style="color:#000;" id="address_edit" name="{{$mulAddr->id}}"><i class="fa fa-pencil" style="font-size:18px;margin-right:10px;" ></i></a></span>
                        <span><a href="javascript:void(0)" id="address_delete_user" name="{{$mulAddr->id}}"  uid="{{$user->id}}" style="color:#000;"><i class="fa fa-trash" style="font-size:18px;margin-right:10px;"></i></a></span>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>

    <div class="container text-center">
        
        <button class="btn btn-default acc_btn " type="submit" id="acc_Create"> 
            <span> <i class="fa fa-user btn_icon"></i> Edit Profile </span> 
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
