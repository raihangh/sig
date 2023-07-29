<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth/login");
    }
    public function aksiLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed ketika login
            $user = Auth::user();
            Session::put('user_id', $user->id);
            Session::put('username', $user->name);
            Session::put('email', $user->email);
            return redirect()->intended('/dashboardAwal');
        } else {
            // Authentication failed, redirect back with error message
            return redirect()->back()->withInput()->withErrors([
                'email' => 'Invalid email or password',
            ]);
        }
    }
    public function register()
    {
        return view("auth/register");
    }
    public function aksiRegister(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        // Create a new user
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        // Alihkan/redirect ke url
        return redirect('/login');
    }
}
