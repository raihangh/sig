<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class AuthController extends Controller
{

    public function showLinkRequestForm()
    {
        return view('auth.passwords.forgot-password');
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with('status', trans($response));
    }

public function showForgotPasswordForm()
{
    return view('auth.passwords.email');
}

public function sendResetLinkEmail(Request $request)
{
    $this->validateEmail($request);

    $response = $this->broker()->sendResetLink(
        $request->only('email')
    );

    return $response == Password::RESET_LINK_SENT
        ? back()->with('status', trans($response))
        : back()->withErrors(['email' => trans($response)]);
}

public function showResetPasswordForm($token)
{
    return view('auth.passwords.reset', ['token' => $token]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:4',
    ]);

    $response = $this->broker()->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $response == Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', trans($response))
        : back()->withErrors(['email' => trans($response)]);
}

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
        $request->validate([
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ],
        [
            'email.unique' => 'Email sudah terdaftar',
            'name.alpha' => 'Nama harus huruf semua',
        ]);
        // 'email' => ['required', 'email', 'unique:users', 'regex:/^[A-Za-z0-9._%+-]+@(gmail|yahoo)\.(com|co.id)$/i'],
        
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect('/login');
    }
}
