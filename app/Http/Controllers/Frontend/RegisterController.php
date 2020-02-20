<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use Illuminate\Validation\Validator;
use Validator;
use App\Models\Access\User\User;
use App\Models\Access\User\MultipleAddress;
use Illuminate\Http\Request;
use DB;

class RegisterController extends Controller
{
    public function __construct()
    {      
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend_user.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =$request->except("_token");
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email'=> 'required|email',
            'pincode'=>'required',
            'password'=>'required|min:8',
            'phone_no'=>'required|numeric',
            'address'=>'required',
            'username'=>'required',
            'birthdate'=>'required|date',
            'confirmpassword'=>'required|same:password|min:8',
            
        );
        $param=$input;
        $validator = Validator::make($param,$rules);

       if($validator->fails())
       {
        return redirect('/register')->withErrors($validator, 'register');
    }
       else
       {
            $user= new User;
            $password=bcrypt($input['password']);
            // dd($password);
            $user->first_name=$input['first_name'];
            $user->last_name=$input['last_name'];
            $user->address=$input['address'];
            $user->pincode=$input['pincode'];
            $user->email=$input['email'];
            $user->username=$input['username'];
            $user->password=$password;
            $user->phone_no=$input['phone_no'];
            $user->birthdate=$input['birthdate'];
            if($user->save())
            {
                return redirect()->route('frontend.user.login');
            }


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user=User::find($id);
        // return view('frontend_user.user_edit',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $multiple_address=MultipleAddress::where('user_id',$id)->get();
        $user=User::find($id);
        // $user=DB::table('users')
        // ->where('users.id',$id)
        // ->join('multiple_address','users.id','=','multiple_address.user_id')
        // ->select('users.*','multiple_address.address','multiple_address.id as address_id' )
        // ->get();
        $muladdrdefault=MultipleAddress::where('id',$user->default_address)->get()->first();
        // dd($muladdrdefault);
        return view('frontend_user.user_edit',compact('user','multiple_address','muladdrdefault'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $user=User::find($id);
        $input =$request->except("_token");
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'pincode'=>'required',
            'phone_no'=>'required|numeric',
            'address'=>'required',
            'username'=>'required',
            'birthdate'=>'required|date',
            'address' =>'required',
            
        );
        $param=$input;
        $validator = Validator::make($param,$rules);

       if($validator->fails())
       {
        return redirect()->route('frontend.register.edit',[$id])->withErrors($validator, 'register');
    }
       else
       {
        $returnpath=$request->input('hiddenurl');
        // dd($returnpath);
            $user->first_name=$input['first_name'];
            $user->last_name=$input['last_name'];
            $user->address=$input['address'];
            $user->pincode=$input['pincode'];
            $user->username=$input['username'];
            $user->phone_no=$input['phone_no'];
            $user->birthdate=$input['birthdate'];
            $user->default_address=$input['address'];
            // dd($user->default_address);
            if($user->save())
            {
                return redirect($returnpath);
            }


        }
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
