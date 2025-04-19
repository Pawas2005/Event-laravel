<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\RSVP;
use Illuminate\Support\Facades\Session;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guests = Guest::latest()->paginate(10);
        return view('guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')
            ->with('success', 'Guest created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        $events = $guest->events()->paginate(10);
        return view('guests.show', compact('guest', 'events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')
            ->with('success', 'Guest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('guests.index')
            ->with('success', 'Guest deleted successfully.');
    }

    public function showLoginForm()
    {
        return view('auth.guest-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:guests,email',
        ]);

        $guest = Guest::where('email', $request->email)->first();
        
        if (!$guest) {
            return back()->withErrors([
                'email' => 'No RSVPs found for this email address.',
            ]);
        }

        // Store guest ID in session
        session(['guest_id' => $guest->id]);

        return redirect()->route('guest.dashboard');
    }

    public function dashboard()
    {
        if (!session()->has('guest_id')) {
            return redirect()->route('guest.login');
        }

        $guest = Guest::find(session('guest_id'));
        $rsvps = $guest->rsvps()->with('event')->latest()->get();

        return view('guest.dashboard', compact('rsvps'));
    }

    public function updateRsvp(Request $request, RSVP $rsvp)
    {
        if (!session()->has('guest_id') || $rsvp->guest_id != session('guest_id')) {
            return redirect()->route('guest.login');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,declined,maybe',
        ]);

        $rsvp->update($validated);

        return back()->with('success', 'RSVP status updated successfully.');
    }

    public function logout()
    {
        session()->forget('guest_id');
        return redirect()->route('guest.login');
    }
}
