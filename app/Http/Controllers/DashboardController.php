<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Guest;
use App\Models\RSVP;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get upcoming events (next 30 days)
        $upcomingEvents = Event::where('start_date', '>=', Carbon::now())
            ->where('start_date', '<=', Carbon::now()->addDays(30))
            ->orderBy('start_date')
            ->take(5)
            ->get();

        // Get logistics summary
        $totalEvents = Event::count();
        $activeEvents = Event::where('start_date', '>=', Carbon::now())->count();
        $totalGuests = Guest::count();
        $pendingRSVPs = RSVP::where('status', 'pending')->count();
        $confirmedRSVPs = RSVP::where('status', 'accepted')->count();

        // Calculate event statistics
        $eventStats = [
            'total' => $totalEvents,
            'active' => $activeEvents,
            'upcoming' => $upcomingEvents->count(),
        ];

        // Calculate guest statistics
        $guestStats = [
            'total' => $totalGuests,
            'pending' => $pendingRSVPs,
            'confirmed' => $confirmedRSVPs,
        ];

        return view('dashboard', compact(
            'upcomingEvents',
            'eventStats',
            'guestStats'
        ));
    }
} 