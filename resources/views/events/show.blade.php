<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $event->title }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('events.edit', $event) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit Event
                </a>
                <a href="{{ route('events.guests', $event) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Manage Guests
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Event Details</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Description</p>
                                    <p class="mt-1">{{ $event->description }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date & Time</p>
                                    <p class="mt-1">
                                        {{ $event->start_date->format('F j, Y g:i A') }} - 
                                        {{ $event->end_date->format('F j, Y g:i A') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="mt-1">{{ $event->location }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Maximum Guests</p>
                                    <p class="mt-1">{{ $event->max_guests ?? 'No limit' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <p class="mt-1">
                                        <span class="px-2 py-1 rounded-full text-xs 
                                            @if($event->status === 'upcoming') bg-blue-100 text-blue-800
                                            @elseif($event->status === 'ongoing') bg-green-100 text-green-800
                                            @elseif($event->status === 'completed') bg-gray-100 text-gray-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($event->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">RSVP Summary</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-green-100 p-4 rounded-lg">
                                        <p class="text-sm text-green-800">Accepted</p>
                                        <p class="text-2xl font-bold text-green-800">
                                            {{ $event->rsvps->where('status', 'accepted')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-red-100 p-4 rounded-lg">
                                        <p class="text-sm text-red-800">Declined</p>
                                        <p class="text-2xl font-bold text-red-800">
                                            {{ $event->rsvps->where('status', 'declined')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-yellow-100 p-4 rounded-lg">
                                        <p class="text-sm text-yellow-800">Pending</p>
                                        <p class="text-2xl font-bold text-yellow-800">
                                            {{ $event->rsvps->where('status', 'pending')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-blue-100 p-4 rounded-lg">
                                        <p class="text-sm text-blue-800">Maybe</p>
                                        <p class="text-2xl font-bold text-blue-800">
                                            {{ $event->rsvps->where('status', 'maybe')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-4">Recent RSVPs</h3>
                                <div class="space-y-2">
                                    @foreach($rsvps->take(5) as $rsvp)
                                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                            <div>
                                                <p class="font-medium">{{ $rsvp->guest->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $rsvp->guest->email }}</p>
                                            </div>
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                @if($rsvp->status === 'accepted') bg-green-100 text-green-800
                                                @elseif($rsvp->status === 'declined') bg-red-100 text-red-800
                                                @elseif($rsvp->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($rsvp->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                @if($rsvps->count() > 5)
                                    <div class="mt-4 text-center">
                                        <a href="{{ route('events.rsvps', $event) }}" class="text-blue-500 hover:text-blue-700">
                                            View All RSVPs
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 