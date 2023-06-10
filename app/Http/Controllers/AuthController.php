<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username'  => 'required',
            'password'  => 'required'
        ]);

        //cek apakah login valid
        if(Auth::attempt($credentials)){
            //cek apakah user status active atau tidak
            if(Auth::user()->status != 'active'){
                Auth::logout();
        
                $request->session()->invalidate();
            
                $request->session()->regenerateToken();
                
                return redirect('/login')->with('statusAccount', 'Your account not active yet, please contact Admin!');
            }

            if(Auth::user()->role_id == 1){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }else{
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function register()
    {
        return view('register',[
            'title' => 'Register',
        ]);
    }

    public function registerProcess(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users|max:255',
            'password' => 'required|min:5|max:255',
            'phone' => 'max:255',
            'address' => 'required',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        
        return redirect('/login')->with('success', 'Registration successfull! Please login');
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
