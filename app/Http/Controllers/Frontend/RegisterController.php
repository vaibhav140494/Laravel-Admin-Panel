<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use Illuminate\Validation\Validator;
use Validator;
use App\Models\Access\User\User;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
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
                return redirect()->route('frontend.login');
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
        $user=User::find($id);
        return view('frontend_user.user_edit',compact('user'));
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
        $user=User::find($id);
        $input =$request->except("_token");
        $rules = array(
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email'=> 'required|email',
            'pincode'=>'required',
            'phone_no'=>'required|numeric',
            'address'=>'required',
            'username'=>'required',
            'birthdate'=>'required|date',
            
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
            $user->first_name=$input['first_name'];
            $user->last_name=$input['last_name'];
            $user->address=$input['address'];
            $user->pincode=$input['pincode'];
            $user->email=$input['email'];
            $user->username=$input['username'];
            $user->phone_no=$input['phone_no'];
            $user->birthdate=$input['birthdate'];
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
