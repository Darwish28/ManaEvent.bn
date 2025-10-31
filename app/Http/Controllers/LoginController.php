<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // ✅ Show the login page
    public function showLoginForm()
    {
        return view('login');
    }

    // ✅ Handle the login logic
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',   // email or username
            'password' => 'required|string',
        ]);

        $loginValue = $request->input('email'); // field can be email or username
        $password = $request->input('password');

        // detect if input is email or username
        $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // attempt login with either email or username
        if (Auth::attempt([$fieldType => $loginValue, 'password' => $password], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // redirect after login
        }

        return back()->withErrors([
            'email' => 'Invalid username/email or password.',
        ])->onlyInput('email');
    }

    // ✅ Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
