<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventSubmission;

class EventSubmissionController extends Controller
{
    /**
     * Display a listing of all submitted events.
     */
    public function index()
    {
        $events = EventSubmission::orderBy('created_at', 'desc')->get();
        return response()->json($events);
    }

    /**
     * Update the specified event (approve, reject, edit, etc.)
     */
    public function update(Request $request, $id)
    {
        $event = EventSubmission::findOrFail($id);

        $event->update([
            'event_name'  => $request->input('event_name', $event->event_name),
            'description' => $request->input('description', $event->description),
            'location'    => $request->input('location', $event->location),
            'status'      => $request->input('status', $event->status),
        ]);

        return response()->json([
            'message' => '✅ Event updated successfully',
            'event'   => $event
        ]);
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy($id)
    {
        $event = EventSubmission::findOrFail($id);
        $event->delete();

        return response()->json(['message' => '🗑️ Event deleted successfully']);
    }
}
