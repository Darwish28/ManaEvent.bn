<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// ✅ Admin authentication check
Route::middleware('auth:admin')->get('/admin/me', function () {
    return response()->json([
        'authenticated' => true,
        'user' => Auth::guard('admin')->user(),
    ]);
});

// ✅ Fetch all users (no auth needed for now — you can secure later)
Route::get('/admin/users', function () {
    return response()->json(User::all());
});
