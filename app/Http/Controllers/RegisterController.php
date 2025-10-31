<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // ✅ Show registration form
    public function showForm()
    {
        return view('register');
    }

    // ✅ Handle registration form submission
    public function register(Request $request)
    {
        // Validate form fields
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted',
        ], [
            'terms.accepted' => 'You must accept the terms and privacy policy to continue.',
        ]);

        // ✅ Create and save the new user
        $user = new User();
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();

        // ✅ Redirect to login with success message
        return redirect()
            ->route('login.form')
            ->with('success', '🎉 Account created successfully! Please log in.');
    }
}
