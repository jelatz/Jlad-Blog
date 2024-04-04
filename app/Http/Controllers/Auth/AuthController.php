<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // LINK TO REGISTER PAGE
    public function register()
    {
        return view('auth.register');
    }
    // STORE NEW USER
    public function store()
    {
        //validate
        //create the user
        //login
        //redirect
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:40',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8'
            ]
        );

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password'])
            ]
        );

        return redirect()->route('dashboard')->with('success', 'User created successfully');
    }

    // LINK TO LOGIN PAGE
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if(auth()->attempt($validated)){

            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'You are successfully logged in!');
        }

        return redirect()->route('login')->withErrors(
            [
                'email' => 'Email Incorrect',
                'password' => 'Incorrect Password'
            ]);
        
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'logged out successfully');
    }
}