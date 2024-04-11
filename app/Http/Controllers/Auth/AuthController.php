<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Schedule;




class AuthController extends Controller
{
    // REGISTER PAGE
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.register');
    }
    // STORE NEW USER
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min: 6'
            ]
        );

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('verification.notice')->with('success', 'Registration successful! Please verify your email address. Check your email for the verification link.');
    }

    // LINK TO LOGIN PAGE
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }
    // LOGIN AUTHENTICATION
    public function authenticate()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'You are successfully logged in!');
        }

        if (!User::where('email', $credentials['email'])->exists()) {
            return redirect()->route('login')->withErrors(['email' => 'Email not registered!'])->withInput();
        }

        return back()->withErrors([
            'password' => 'Incorrect password!',
        ])->withInput();
    }

    // FORGOT PASSWORD PAGE
    function forgotPassword()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.forgot-password');
    }
    // RESET REQUEST
    function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        Schedule::command('auth:clear-resets')->everyFifteenMinutes();

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // SHOW RESET FORM
    function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // AFTER SUBMITTING THE RESET PASSWORD FORM
    function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill(
                    [
                        'password' => Hash::make($request->password)
                    ]
                )->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You are successfully logged out!');
    }
    public function postLogout()
    {
        return redirect()->route('dashboard');
    }
}
