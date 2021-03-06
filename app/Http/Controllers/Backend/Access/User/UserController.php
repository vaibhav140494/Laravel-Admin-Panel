<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\CreateUserRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\ShowUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
use App\Http\Responses\Backend\Access\User\CreateResponse;
use App\Http\Responses\Backend\Access\User\EditResponse;
use App\Http\Responses\Backend\Access\User\ShowResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Access\Permission\Permission;
use App\Models\Access\User\User;
use App\Models\Access\User\MultipleAddress;
use App\Repositories\Backend\Access\Role\RoleRepository;
use App\Repositories\Backend\Access\User\UserRepository;
use DB;
use Illuminate\Http\Request;
use Validator;
/**
 * Class UserController.
 */
class UserController extends Controller
{
    /**
     * @var \App\Repositories\Backend\Access\User\UserRepository
     */
    protected $users;

    /**
     * @var \App\Repositories\Backend\Access\Role\RoleRepository
     */
    protected $roles;

    /**
     * @param \App\Repositories\Backend\Access\User\UserRepository $users
     * @param \App\Repositories\Backend\Access\Role\RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    /**
     * @param \App\Http\Requests\Backend\Access\User\ManageUserRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageUserRequest $request)
    {
        return new ViewResponse('backend.access.users.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Access\User\CreateUserRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\User\CreateResponse
     */
    public function create(CreateUserRequest $request)
    {
        $roles = $this->roles->getAll();

        return new CreateResponse($roles);
    }

    /**
     * @param \App\Http\Requests\Backend\Access\User\StoreUserRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create($request);

        return new RedirectResponse(route('admin.access.user.index'), ['flash_success' => trans('alerts.backend.users.created')]);
    }

    /**
     * @param \App\Models\Access\User\User                           $user
     * @param \App\Http\Requests\Backend\Access\User\ShowUserRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\User\ShowResponse
     */
    public function show(User $user, ShowUserRequest $request)
    {
        return new ShowResponse($user);
    }

    /**
     * @param \App\Models\Access\User\User                           $user
     * @param \App\Http\Requests\Backend\Access\User\EditUserRequest $request
     *
     * @return \App\Http\Responses\Backend\Access\User\EditResponse
     */
    public function edit(User $user, EditUserRequest $request)
    {
        $uid=$user->id;
        // dd($uid);
        $user_addresses=MultipleAddress::where('user_id',$uid)->get();

        // dd($user_addresses);
        $roles = $this->roles->getAll();
        $permissions = Permission::getSelectData('display_name');

        return new EditResponse($user, $roles, $permissions,$user_addresses);
    }

    /**
     * @param \App\Models\Access\User\User                             $user
     * @param \App\Http\Requests\Backend\Access\User\UpdateUserRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        
        $user->default_address=$request->input('address');
        $this->users->update($user, $request);

        return new RedirectResponse(route('admin.access.user.index'), ['flash_success' => trans('alerts.backend.users.updated')]);
    }

    /**
     * @param \App\Models\Access\User\User                             $user
     * @param \App\Http\Requests\Backend\Access\User\DeleteUserRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(User $user, DeleteUserRequest $request)
    {
        $this->users->delete($user);

        return new RedirectResponse(route('admin.access.user.index'), ['flash_success' => trans('alerts.backend.users.deleted')]);
    }

    public function addAddress($id)
    {
        // dd($id);
        return view('backend.access.users.add_address',compact('id'));
    }

    public function storeAddress(Request $req,$id)
    {
        $input =$req->except("_token");
        $rules = array(
            'city'=> 'required|string',
            'pincode'=>'required|Numeric',
            'state'=>'required|string',
            'country'=>'required|string',
            'address'=>'required',
            
        );
        $param=$input;
        $validator = Validator::make($param,$rules);

       if($validator->fails())
       {
        return redirect()->route('admin.access.user.address.add',$id)->withErrors($validator, 'register');
        }
        else{
        
        // $id=\Auth::user()->id;
        $multiple_addr = new MultipleAddress;
        $multiple_addr->contact_person = $req->input('contact_person');
        $multiple_addr->contact_person_no = $req->input('contact_person_no');
            $multiple_addr->city = $req->input('city');
            $multiple_addr->state = $req->input('state');
            $multiple_addr->country = $req->input('country');
            $multiple_addr->address = $req->input('address');
            $multiple_addr->pincode = $req->input('pincode');
            $multiple_addr->user_id = $id;
            $multiple_addr->save();
            // dd($multiple_addr);
            if($req->input('mk_default_address_admin')=='on')
            {
                $user = User::find($id);
                $user->default_address = $multiple_addr->id;
                $ans=$user->save();
                if($ans)
                    {
                        // /    Session::put('success_msg','Address Added Successfully');
                        // dd("hello");
                    }
                // dd($user);
            }
            // dd($multiple_addr); 
            return new RedirectResponse(route('admin.access.user.edit',[$id]), ['flash_success' => " user address successfully Added"]);
           
        }
    }

    public function editAddress($id)
    {
        $multiple_adder=MultipleAddress::find($id);
        return view('backend.access.users.edit_address',compact('multiple_adder'));
    }

    public function updateAddress($id,Request $req)
    {
        $multiple_adder = MultipleAddress::find($id);
        $multiple_adder->contact_person = $req->input('contact_person');
        $multiple_adder->contact_person_no = $req->input('contact_person_no');
        $multiple_adder->city = $req->input('city');
        $multiple_adder->state = $req->input('state');
        $multiple_adder->address = $req->input('address');
        $multiple_adder->country = $req->input('country');
        $multiple_adder->pincode = $req->input('pincode');
        $ans = $multiple_adder->save();
        if($ans)
        {
            $msg="User address edited successfully";
        }
        else
        {
            $msg="error";
        }
        return new RedirectResponse(route('admin.access.user.edit',[$multiple_adder->user_id]), ['flash_success' => " user address successfully updated"]);
        // return redirect()->route('admin.access.user.edit',[$multiple_adder->user_id]);
    }
    public function deleteAddress(Request $req)
    {
        $id=$req->input('id');
        $uid=$req->input('uid');
        $multiple_addr=MultipleAddress::find($id);

        $msg=$multiple_addr->delete(); 

        if($msg)
        {
            $response['message'] = true;
            $address_data = MultipleAddress::where('user_id',$uid)->get();
            
            $user = User::find($uid);
            // echo $radio_id;
            if($req->input('radio_val') !=0){
                $radio_id = $req->input('radio_val');
                $user->default_address=$radio_id;
                $user->save();
            }
            $response['data'] = $address_data;
            $response['user'] = $user;            
        }
        else
        {
            $response['message']=false;
        }
        return json_encode($response);
    }
}
