@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.edit') }}</small>
    </h1>
@endsection
@section('content')
    {{ Form::model($user, ['route' => ['admin.access.user.update', $user], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH']) }}
        
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.access.users.edit') }}</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                {{-- First Name --}}
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.access.users.firstName'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('first_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.firstName'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Last Name --}}
                <div class="form-group">
                    {{ Form::label('name', trans('validation.attributes.backend.access.users.lastName'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('last_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.lastName'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Email --}}
                <div class="form-group">
                    {{ Form::label('email', trans('validation.attributes.backend.access.users.email'), ['class' => 'col-lg-2 control-label required']) }}

                    <div class="col-lg-10">
                        {{ Form::text('email', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                {{-- Status --}}
                @if ($user->id != 1)
                    <div class="form-group">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-1">
                                <div class="control-group">
                                    <label class="control control--checkbox">
                                         {{ Form::checkbox('status', '1', $user->status == 1) }}
                                    <div class="control__indicator"></div>
                                    </label>
                                </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    {{-- Confirmed --}}
                    <div class="form-group">
                        {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-1">
                            <div class="control-group">
                                <label class="control control--checkbox">
                                    {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                        </div><!--col-lg-1-->
                    </div><!--form control-->

                    {{-- Associated Roles --}}
                    <div class="form-group">
                        {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-lg-2 control-label']) }}

                        <div class="col-lg-8">
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <div>
                                    <label for="role-{{$role->id}}" class="control control--radio">
                                    <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" />  &nbsp;&nbsp;{!! $role->name !!}
                                    <div class="control__indicator"></div>
                                    <a href="#" data-role="role_{{$role->id}}" class="show-permissions small">
                                        (
                                            <span class="show-text">{{ trans('labels.general.show') }}</span>
                                            <span class="hide-text hidden">{{ trans('labels.general.hide') }}</span>
                                            {{ trans('labels.backend.access.users.permissions') }}
                                        )
                                    </a>
                                    </label>
                                    </div>
                                    <div class="permission-list hidden" data-role="role_{{$role->id}}">
                                        @if ($role->all)
                                            {{ trans('labels.backend.access.users.all_permissions') }}
                                        @else
                                            @if (count($role->permissions) > 0)
                                                <blockquote class="small">
                                                    @foreach ($role->permissions as $perm)
                                                        {{$perm->display_name}}<br/>
                                                    @endforeach
                                                </blockquote>
                                            @else
                                                {{ trans('labels.backend.access.users.no_permissions') }}<br/><br/>
                                            @endif
                                        @endif
                                    </div><!--permission list-->
                                @endforeach
                            @else
                                {{ trans('labels.backend.access.users.no_roles') }}
                            @endif
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                    {{-- Associated Permissions --}}
                    <div class="form-group">
                        {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-lg-2 control-label']) }}
                        <div class="col-lg-10">
                            <div id="available-permissions" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                                <div class="row">
                                    <div class="col-xs-12 get-available-permissions">
                                        @if ($permissions)

                                            @foreach ($permissions as $id => $display_name)
                                            <div class="control-group">
                                                <label class="control control--checkbox" for="perm_{{ $id }}">
                                                    <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label for="perm_{{ $id }}">{{ $display_name }}</label>
                                                    <div class="control__indicator"></div>
                                                </label>
                                            </div>
                                            @endforeach
                                        @else
                                            <p>There are no available permissions.</p>
                                        @endif
                                    </div><!--col-lg-6-->
                                </div><!--row-->
                            </div><!--available permissions-->
                        </div><!--col-lg-3-->
                    </div><!--form control-->

                    {{-- Multiple Address Field--}}
                    <div class="form-group"> 
                        <a href="{{route('admin.access.user.address.add',[$user->id])}}" class="btn btn-primary pull-right" style="margin-right:60px;">Add Address</a>
                    </div>
                    @if($multiple_address)
                        <?php $checked=false; ?>
                        <div class="address-container">
                            @foreach ($multiple_address as $mulAddr)
                                <div class="form-group">
                                    {{ Form::label('Multiple_address',"Multiple Address", ['class' => 'col-lg-2 control-label required']) }}
                                    <div class="address_display">
                                        <div class=" offset-md-3 col-md-1">
                                        
                                        <input type="radio" name="address" value="{{$mulAddr->id}}" id="{{$mulAddr->id}}" <?php echo ($user->default_address == $mulAddr->id) ? "checked": " " ;  ?>> 
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <span>{{$user->first_name}}</span>
                                            <span>{{$user->last_name}}</span>
                                            <p style="margin:0 auto;">{{$mulAddr->address}}</p>
                                            <p style="margin:0 auto;">{{$mulAddr->pincode}}</p> 
                                            <p style="margin:0 auto;">{{$mulAddr->city}}</p>
                                            <p style="margin:0 auto;">{{$mulAddr->state}}</p> 
                                            <p style="margin:0 auto;">{{$mulAddr->country}}</p>
                                        </div>
                                        <div class="col-md-2">
                                        <span><a href="{{route('admin.access.user.address.edit',[$mulAddr->id])}}" style="color:#000;" id="address_edit" name="{{$mulAddr->id}}"><i class="fa fa-pencil" style="font-size:18px;margin-right:10px;" ></i></a></span>
                                        <span><a href="javascript:void(0)" id="address_delete" name="{{$mulAddr->id}}"  uid="{{$user->id}}" style="color:#000;"><i class="fa fa-trash" style="font-size:18px;margin-right:10px;"></i></a></span></div>
                                    </div>
                                </div>
                            @endforeach 


                            {{-- Add form popupp--}}
                            <!-- Trigger/Open The Modal -->
                            <!-- <button id="myBtn">Open Modal</button> -->

                            
                        </div>
                    @endif
                @endif
                <div class="edit-form-btn">
                    {{ link_to_route('admin.access.user.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

        @if ($user->id == 1)
            {{ Form::hidden('status', 1) }}
            {{ Form::hidden('confirmed', 1) }}
            {{ Form::hidden('assignees_roles[]', 1) }}
        @endif

    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script type="text/javascript">
    
        Backend.Utils.documentReady(function(){
            csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            Backend.Users.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            Backend.Users.init("edit");
        });
        window.onload = function () {
            Backend.Users.windowloadhandler();
        };
 
        $(document).ready(function(){
           

            $(document).on('click','#address_delete',function(){
                var id=$(this).attr('name');
                var uid=$(this).attr('uid');

                var div='';
                 radio_val = $("input[name='address']:checked"). val();
                // alert(radio_val);
                 
                 if(radio_val == id)
                 {
                    bootbox.alert("please select default addres");
                    return false;
                }
                console.log($('.address-container').html());
                // var url='{{route("admin.access.user.address.delete",[$id])}}';
                // alert(url);
                
                bootbox.confirm("Do you really want to delete record?", function(result) {
                    if(result){
                        $.ajax({
                            url:'{{route("admin.access.user.address.delete")}}',
                            type:'post',
                            dataType:'json',
                            data:{'id':id,'uid':uid,'radio_val':radio_val},
                            success:function(data)
                            {
                                if(data['message']==true)
                                {
                                    user=data['user'];
                                    address=data['data'];
                                    checked=" ";
                                    checkid = " ";
                                    bootbox.alert(' addres deleted successfully');
                                    $.each(address,function(k,value){
                                        console.log(value.id);

                                        if(user.default_address==value.id){
                                            checked="checked";
                                            checkid=value.id;
                                        }   

                                        div+='<div class="form-group">{{ Form::label("Multiple_address","Multiple Address", ["class" => "col-lg-2 control-label required"]) }}<div class="address_display"><div class=" offset-md-3 col-md-1"><input type="radio" name="address" value="'+value.id+'" id="'+value.id+'"> </div><div class="col-md-6"><span>'+user.first_name+'</span> <span>'+user.last_name+'</span><p style="margin:0 auto;">'+value.address+'</p><p style="margin:0 auto;">'+value.pincode+'</p><p style="margin:0 auto;">'+value.city+'</p><p style="margin:0 auto;">'+value.state+'</p><p style="margin:0 auto;">'+value.country+'</p></div><div class="col-md-2"><span><a href="" style="color:#000;" id="address_edit" name="'+value.id+'"><i class="fa fa-pencil" style="font-size:18px;margin-right:10px;" ></i></a></span><span><a href="javascript:void(0)" id="address_delete" name="'+value.id+'" style="color:#000;"><i class="fa fa-trash" style="font-size:18px;margin-right:10px;"></i></a></span></div></div></div>';
                                    });
                                    $('.address-container').html(div);
                                    $("#"+checkid).prop("checked", true);

                                }
                                else
                                {
                                    bootbox.alert(' addres is not deleted deleted ');
                                }
                            }
                        });
                    }
                });
            });
    
        });

    </script>
@endsection
