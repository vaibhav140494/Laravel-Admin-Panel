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
        $credentials = $request->only(['email', 'password']);
        if (\Auth::attempt($credentials)) {
            if(\Auth::user()->role==2)
            return redirect('/');
            else
            return redirect()->route('admin.dashboard');
        }

        else
        {
            return view('frontend_user.login')->with('errors','Invalid Credentials');
        }
    }
    public function logout(Request $request)
    {
        app()->make(Auth::class)->flushTempSession();

        $request->session()->flush();
        return redirect('/');
    }

}
