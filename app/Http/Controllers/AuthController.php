<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //view sign in
    public function index(){
        return view('sign_in');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => "required|email:dns",
            'password' => "required|max:255"
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginFail', 'Login failed! Please check your username and password.')->withInput();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
