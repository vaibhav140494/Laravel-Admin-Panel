<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Http\Request;
use App\Models\Access\User\MultipleAddress;
use App\Models\Access\User\User;
use Validator;


/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(UpdateProfileRequest $request)
    {
        $output = $this->user->updateProfile(access()->id(), $request->all());

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            access()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(trans('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }

    public function addAddress()
    {
        return view('frontend_user.user_address_add');
    }

    public function storeAddress(Request $req)
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
        return redirect()->route('frontend.user.register.user.address.add')->withErrors($validator, 'register');
        }
        else
        {
            $path=$req->input('hiddenurl');

            $user=\Auth::user();
            $multiple_addr= new MultipleAddress;
            $multiple_addr->contact_person=$req->input('contact_person');
            $multiple_addr->contact_person_no=$req->input('contact_person_no');
            $multiple_addr->city=$req->input('city');
            $multiple_addr->state=$req->input('state');
            $multiple_addr->country=$req->input('country');
            $multiple_addr->address=$req->input('address');
            $multiple_addr->pincode=$req->input('pincode');
            $multiple_addr->user_id=$user->id;
           
            $multiple_addr->save();
            if($req->input('mk_default_address_chkbx')=='on')
            {
                $user->default_address =   $multiple_addr->id;
            }
            // dd($user);
            $user->save();
            // dd($multiple_addr);
            
            return redirect($path);
        }
    }

    public function editAddress($id)
    {
        $multiple_addr =MultipleAddress::find($id);
        return view('frontend_user.user_address_edit',compact('multiple_addr'));
    }

        public function updateAddress(Request $req, $id)
        {
            $path=$req->input('hiddenurl');
            $user=\Auth::user();
            $multiple_addr=MultipleAddress::find($id);
            $multiple_addr->contact_person=$req->input('contact_person');
            $multiple_addr->contact_person_no=$req->input('contact_person_no');
            $multiple_addr->city=$req->input('city');
            $multiple_addr->state=$req->input('state');
            $multiple_addr->country=$req->input('country');
            $multiple_addr->address=$req->input('address');
            $multiple_addr->pincode=$req->input('pincode');
            $multiple_addr->user_id=$user->id;
            
            $multiple_addr->save();
            return redirect($path);
        }

    public function deleteAddress(Request $req)
    {
        if($req->ajax())
        {
            $id=$req->input('id');
            $uid=$req->input('uid');
            $radioid=$req->input('radio_val');
            // dd($radioid);    
            $multiple_addr=MultipleAddress::find($id);
             $msg = $multiple_addr->delete();
             if($msg)
             {
                $response['message']=true;
                $address_data = MultipleAddress::where('user_id',$uid)->get();
                // dd($address_data);
                $user=User::find($uid);
                $user->default_address=$radioid;
                $user->save();
                $response['data']=$address_data;
                $response['user']=$user;
             }
             else
             {
                 $response['message']=false;
             }
        }
        return json_encode($response);


    }
}
