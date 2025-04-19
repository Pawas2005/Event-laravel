<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cpath d=\"M0 0h20v20H0z\" fill=\"none\"%2F%3E%3Cpath d=\"M12.5 10a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z\" fill=\"rgba(255,255,255,0.05)\"%2F%3E%3C%2Fsvg%3E')] opacity-20"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold text-gray mb-4">Welcome to Your Event Dashboard</h1>
            
            <!-- Feature Cards -->
            <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h2 class="text-2xl font-bold text-blue-800 mb-4">Events</h2>
                            <p class="text-gray-600 mb-4">Manage your events, create new ones, and track RSVPs.</p>
                            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                View Events
                            </a>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg">
                            <h2 class="text-2xl font-bold text-green-800 mb-4">Guests</h2>
                            <p class="text-gray-600 mb-4">Manage your guest list and track their event attendance.</p>
                            <a href="{{ route('guests.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                View Guests
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Event Stats -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Event Statistics</h3>
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Events</span>
                                <span class="text-2xl font-bold text-blue-600">{{ $eventStats['total'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Active Events</span>
                                <span class="text-2xl font-bold text-green-600">{{ $eventStats['active'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Upcoming Events</span>
                                <span class="text-2xl font-bold text-purple-600">{{ $eventStats['upcoming'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guest Stats -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Guest Statistics</h3>
                            <div class="p-2 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Guests</span>
                                <span class="text-2xl font-bold text-green-600">{{ $guestStats['total'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Pending RSVPs</span>
                                <span class="text-2xl font-bold text-yellow-600">{{ $guestStats['pending'] }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Confirmed RSVPs</span>
                                <span class="text-2xl font-bold text-green-600">{{ $guestStats['confirmed'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                            <div class="p-2 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <a href="{{ route('events.create') }}" class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Create New Event
                            </a>
                            <a href="{{ route('guests.create') }}" class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Add New Guest
                            </a>
                            <a href="{{ route('events.index') }}" class="block w-full text-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                View All Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Upcoming Events</h3>
                        <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-800">View All →</a>
                    </div>
                    @if($upcomingEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingEvents as $event)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-900">{{ $event->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $event->formatted_start_date }} at {{ $event->location }}</p>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-3 py-1 text-sm rounded-full {{ $event->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $event->status }}
                                        </span>
                                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:text-blue-800">
                                            View Details →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-gray-400" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">No upcoming events</h3>
                            <p class="mt-1 text-gray-500">Get started by creating a new event</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 