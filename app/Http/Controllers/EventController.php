<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use App\Models\EventSubmission;

class EventController extends Controller
{
   public function index()
{
    // Fetch only approved events
    $approvedEvents = \App\Models\EventSubmission::where('status', 'approved')->get();

    // Group them
    $whatsNew = $approvedEvents->filter(function ($event) {
        return \Carbon\Carbon::parse($event->start_time)->isCurrentWeek();
    });

    $upcoming = $approvedEvents->filter(function ($event) {
        return \Carbon\Carbon::parse($event->start_time)->isFuture() &&
               !\Carbon\Carbon::parse($event->start_time)->isCurrentWeek();
    });

    return view('home', [
        'whatsNew' => $whatsNew,
        'upcoming' => $upcoming,
    ]);
}

    public function show($id)
    {
        $event = EventSubmission::findOrFail($id);
        return view('events.show', compact('event'));
    }
}
