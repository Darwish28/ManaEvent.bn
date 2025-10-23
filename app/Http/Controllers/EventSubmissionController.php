<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSubmission;

class EventSubmissionController extends Controller
{
    // Store new event submissions from the public form
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'event_name' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'location' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/events', 'public');
        }

        EventSubmission::create([
            ...$validated,
            'file_path' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Your event has been submitted successfully!');
    }

    // API endpoint for Admin React to get submissions
    public function index()
    {
        return response()->json(EventSubmission::latest()->get());
    }
}
