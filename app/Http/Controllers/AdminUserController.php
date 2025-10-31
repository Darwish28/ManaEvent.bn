<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Return all users as JSON (you can filter later)
        $users = User::select('id', 'name', 'email', 'created_at', 'updated_at')->get();
        return response()->json($users);
    }
}
