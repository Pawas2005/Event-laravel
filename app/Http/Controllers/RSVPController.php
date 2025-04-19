<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RSVP;

class RSVPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsvps = RSVP::with(['event', 'guest'])->latest()->paginate(10);
        return view('rsvps.index', compact('rsvps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RSVP $rsvp)
    {
        return view('rsvps.show', compact('rsvp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RSVP $rsvp)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,declined,maybe',
            'number_of_guests' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $rsvp->update($validated);

        return redirect()->route('rsvps.show', $rsvp)
            ->with('success', 'RSVP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function updateStatus(Request $request, RSVP $rsvp)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,declined,maybe',
        ]);

        $rsvp->update($validated);

        return redirect()->back()
            ->with('success', 'RSVP status updated successfully.');
    }
}
