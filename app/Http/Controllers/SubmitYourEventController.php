<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSubmission;

class SubmitYourEventController extends Controller
{
    // Show the submit event page
    public function create()
    {
        return view('submit-event');
    }

    // Handle event submission (from form)
    public function store(Request $request)
    {
        // ✅ Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'start_time' => 'nullable|date',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // ✅ Handle image uploads
        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $paths[] = $file->store('events', 'public');
            }
        }

        // ✅ Create new event record
        EventSubmission::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'event_name' => $validated['event_name'],
            'description' => $validated['description'] ?? null,
            'location' => $validated['location'] ?? null,
            'start_time' => $validated['start_time'] ?? null,
            'image_path' => json_encode($paths),
            'status' => 'pending', // mark as pending by default
        ]);

        // ✅ Redirect back with success message
        return redirect()
            ->route('submit.event.form')
            ->with('success', 'Event submitted successfully! Pending admin approval.');
    }
}
