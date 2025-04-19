<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $guest->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('guests.edit', $guest) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Edit Guest
                </a>
                <a href="{{ route('guests.index') }}" class="text-gray-600 hover:text-gray-900">
                    Back to Guests
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
                            <h3 class="text-lg font-semibold mb-4">Guest Information</h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="mt-1">{{ $guest->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="mt-1">{{ $guest->phone ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Notes</p>
                                    <p class="mt-1">{{ $guest->notes ?? 'No notes available' }}</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold mb-4">Event Attendance</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-green-100 p-4 rounded-lg">
                                        <p class="text-sm text-green-800">Accepted</p>
                                        <p class="text-2xl font-bold text-green-800">
                                            {{ $guest->events->where('pivot.status', 'accepted')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-red-100 p-4 rounded-lg">
                                        <p class="text-sm text-red-800">Declined</p>
                                        <p class="text-2xl font-bold text-red-800">
                                            {{ $guest->events->where('pivot.status', 'declined')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-yellow-100 p-4 rounded-lg">
                                        <p class="text-sm text-yellow-800">Pending</p>
                                        <p class="text-2xl font-bold text-yellow-800">
                                            {{ $guest->events->where('pivot.status', 'pending')->count() }}
                                        </p>
                                    </div>
                                    <div class="bg-blue-100 p-4 rounded-lg">
                                        <p class="text-sm text-blue-800">Maybe</p>
                                        <p class="text-2xl font-bold text-blue-800">
                                            {{ $guest->events->where('pivot.status', 'maybe')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-lg font-semibold mb-4">Recent Events</h3>
                                <div class="space-y-2">
                                    @foreach($events->take(5) as $event)
                                        <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                            <div>
                                                <p class="font-medium">{{ $event->title }}</p>
                                                <p class="text-sm text-gray-500">{{ $event->start_date->format('M d, Y') }}</p>
                                            </div>
                                            <span class="px-2 py-1 rounded-full text-xs 
                                                @if($event->pivot->status === 'accepted') bg-green-100 text-green-800
                                                @elseif($event->pivot->status === 'declined') bg-red-100 text-red-800
                                                @elseif($event->pivot->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-blue-100 text-blue-800 @endif">
                                                {{ ucfirst($event->pivot->status) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                                @if($events->count() > 5)
                                    <div class="mt-4 text-center">
                                        <a href="#" class="text-blue-500 hover:text-blue-700">
                                            View All Events
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