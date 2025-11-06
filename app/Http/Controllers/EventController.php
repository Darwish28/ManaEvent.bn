<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        // Fetch only approved upcoming events
        $upcoming = Event::where('is_approved', true)
            ->where('start_time', '>=', now('Asia/Brunei'))
            ->orderBy('start_time', 'asc')
            ->take(6)
            ->get();

        // Pass it to the Blade view
        return view('home', compact('upcoming'));
    }
}
