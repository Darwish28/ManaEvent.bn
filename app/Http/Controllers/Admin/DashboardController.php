<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventSubmission;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'totalSubmissions' => EventSubmission::count(),
            'pendingApprovals' => EventSubmission::where('status', 'pending')->count(),
            'publishedEvents'  => EventSubmission::where('status', 'approved')->count(),
            'registeredUsers'  => User::count(),
            'recentSubmissions' => EventSubmission::latest()->take(5)->get(),
        ]);
    }
}

