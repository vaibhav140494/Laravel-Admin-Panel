<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Auth\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('frontend_user.login');
    }
    public function store(Request $request)
    {
        // dd(\Auth::user());
        
        
        $email=$request->get('email');
        $password=$request->get('password');
        // dd($password);
        $users=User::where('email',$email)->first();
        if(($users!='') && ((Hash::check($password, $users->password))))
        {
            session(['username' => $users]);
            session()->get('username');
            return redirect('/front');
        }
        else
            dd("hello");
    }
    public function logout(Request $request)
    {
        // dd($request);
        $request->session()->flush();
        return redirect('/front');
    }

}
