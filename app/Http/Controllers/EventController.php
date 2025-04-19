<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Guest;
use App\Models\RSVP;
use App\Mail\EventInvitation;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'max_guests' => 'nullable|integer|min:1',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $rsvps = $event->rsvps()->with('guest')->get();
        return view('events.show', compact('event', 'rsvps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'max_guests' => 'nullable|integer|min:1',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function guests(Event $event)
    {
        $query = $event->guests()->with('rsvps');
        
        // Apply status filter if provided
        if (request()->has('status')) {
            $status = request('status');
            $query->whereHas('rsvps', function($q) use ($event, $status) {
                $q->where('event_id', $event->id)
                  ->where('status', $status);
            });
        }

        // Apply search filter if provided
        if (request()->has('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $guests = $query->paginate(10);
        return view('events.guests', compact('event', 'guests'));
    }

    public function rsvps(Event $event)
    {
        $rsvps = $event->rsvps()->with('guest')->paginate(10);
        return view('events.rsvps', compact('event', 'rsvps'));
    }

    public function invite(Request $request, Event $event)
    {
        $validated = $request->validate([
            'guest_ids' => 'required|array',
            'guest_ids.*' => 'exists:guests,id'
        ]);

        foreach ($validated['guest_ids'] as $guestId) {
            $guest = Guest::find($guestId);
            
            // Create RSVP if it doesn't exist
            $rsvp = RSVP::firstOrCreate([
                'event_id' => $event->id,
                'guest_id' => $guestId,
            ], [
                'status' => 'pending'
            ]);

            // Send invitation email
            Mail::to($guest->email)->send(new EventInvitation($guest, $event));
        }

        return back()->with('success', 'Invitations sent successfully.');
    }
}
