<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Register()
    {
        return view('auth.register');
    }
    public function doRegister(Request $request)
    {
        $request->validate([
            'name'=>'required|max:100|string|min:10',
            'email'=>'required|email|max:100|unique:users,email',
            'password'=>'required|min:6',
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'api_token'=>Str::random(64)

        ]);
        return redirect(route('Login_auth'));
    }
    public function Login()
    {
        return view('auth.login');
    }
    public function doLogin(Request $request)
    {
        $request->validate([
            'email'=>'required|email|max:100|exists:App\User,email',
            'password'=>'required|min:6'
        ]);
       Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            return redirect(route('all_books'));
        else
        {
            return redirect(route('Login_auth'))->withErrors([
                'error_key' => "Password isn't match Email"
            ]);
        }

    }
    public function Logout()
    {
        Auth::logout();
        return redirect(route('Login_auth'));
    }

}
