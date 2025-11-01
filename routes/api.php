<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth:admin')->get('/admin/me', function () {
    return response()->json([
        'authenticated' => true,
        'user' => Auth::guard('admin')->user(),
    ]);
});
