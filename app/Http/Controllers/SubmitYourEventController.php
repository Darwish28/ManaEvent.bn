<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSubmission;
use Illuminate\Support\Facades\Http;

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
            // ✅ Step 1: Validate form data
            $validated = $request->validate([
                'username'    => 'required|string|max:255',
                'email'       => 'required|email',
                'phone'       => 'nullable|string|max:20',
                'event_name'  => 'required|string|max:255',
                'description' => 'nullable|string',
                'location'    => 'nullable|string',
                'start_time'  => 'nullable|date|after:now',
                'end_time'    => 'nullable|date|after:start_time',
                'images'      => 'nullable|array',
                'images.*'    => 'file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:8192',
                'g-recaptcha-response' => 'required',
            ]);

            // ✅ Step 2: Verify reCAPTCHA
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
            ]);

            $result = $response->json();
            if (empty($result['success']) || $result['success'] !== true) {
                return back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.'])->withInput();
            }

            // ✅ Step 3: Handle file upload
            $filePath = null;
            if ($request->hasFile('images')) {
                $file = $request->file('images')[0]; // only take the first image
                if ($file && $file->isValid()) {
                    $fileName = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                    $filePath = $file->storeAs('events', $fileName, 'public');
                } else {
                    return back()->withErrors(['images' => 'Image failed to upload.'])->withInput();
                }
            }

            // ✅ Step 4: Save the event submission
            EventSubmission::create([
                'name'        => $validated['username'],
                'email'       => $validated['email'],
                'phone'       => $validated['phone'] ?? null,
                'event_name'  => $validated['event_name'],
                'description' => $validated['description'] ?? null,
                'location'    => $validated['location'] ?? null,
                'start_time'  => $validated['start_time'] ?? null,
                'end_time'    => $validated['end_time'] ?? null,
                // store plain string instead of JSON
                'file_path'   => $filePath,
                'status'      => 'pending',
            ]);

            return redirect()
                ->route('submit-event')
                ->with('success', '✅ Event submitted successfully! Pending admin approval.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $e) {
            return back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
        }
    }
}
