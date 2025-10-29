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
    try {
        // NOTE: raise per-file limit to 8 MB to avoid silent fails on bigger images
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'nullable|string|max:20',
            'event_name'  => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string',
            'start_time'  => 'nullable|date',
            'end_time'    => 'nullable|date',
            'images'      => 'nullable', // presence of array is ok
            'images.*'    => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:8192', // 8MB per file
        ]);

        // Multiple file upload (optional)
        $paths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file && $file->isValid()) {
                    $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $paths[] = $file->storeAs('events', $fileName, 'public');
                }
            }
        }

        // Save data
        EventSubmission::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'] ?? null,
            'event_name'  => $validated['event_name'],
            'description' => $validated['description'] ?? null,
            'location'    => $validated['location'] ?? null,
            'start_time'  => $validated['start_time'] ?? null,
            'end_time'    => $validated['end_time'] ?? null,
            'file_path'   => !empty($paths) ? json_encode($paths) : null,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('submit.event.form')
            ->with('success', 'Event submitted successfully! Pending admin approval.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Send validation messages back to the form
        return back()->withErrors($e->validator)->withInput();
    } catch (\Throwable $e) {
        // Any unexpected error: show a generic message on the page
        return back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
    }
}
} 