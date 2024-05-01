<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() 
    {
        
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doLogin(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/users');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'Salah Password Bos'
        ])->onlyInput('email','password');
    }

    public function doRegis(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string']
        ]);

        $userNew = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
            'isAdmin' => false
        ]);

        Customer::create([
            'user_id' => $userNew->id,
            'phone' => $validator['phone'],
            'address' => $validator['address']
        ]);

        return redirect()->route('landingpage');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
