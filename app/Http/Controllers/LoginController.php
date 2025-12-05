<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // For initial view
    public function __invoke()
    {
        return view('login');
    }

    // To process login request
    public function authenticate(Request $request)
    {
        $field = filter_var($request->input('username-email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $field => $request->input('username-email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'username-email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username-email'));
    }

    // For logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}