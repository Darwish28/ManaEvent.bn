<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.admin');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'admin_id' => 'required|string',
        'password' => 'required|string',
    ]);

    // Force axios requests to always return JSON
    if ($request->isJson() || $request->ajax()) {
        $expectsJson = true;
    } else {
        $expectsJson = $request->expectsJson();
    }

    if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        $user = Auth::guard('admin')->user();

        if ($expectsJson) {
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'admin_id' => $user->admin_id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
        }

        return redirect()->intended('/admin/dashboard');
    }

    if ($expectsJson) {
        return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
    }

    return back()->withErrors(['admin_id' => 'Invalid Admin ID or password.']);
}


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['success' => true]);
    }
}
