<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('RSVPs for ') }} {{ $event->title }}
            </h2>
            <a href="{{ route('events.show', $event) }}" class="text-gray-600 hover:text-gray-900">
                Back to Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">RSVP Summary</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
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

                    <div>
                        <h3 class="text-lg font-semibold mb-4">All RSVPs</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guest</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number of Guests</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Special Requests</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($rsvps as $rsvp)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $rsvp->guest->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $rsvp->guest->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 rounded-full text-xs 
                                                    @if($rsvp->status === 'accepted') bg-green-100 text-green-800
                                                    @elseif($rsvp->status === 'declined') bg-red-100 text-red-800
                                                    @elseif($rsvp->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-blue-100 text-blue-800 @endif">
                                                    {{ ucfirst($rsvp->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $rsvp->number_of_guests }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-500">{{ $rsvp->special_requests ?? 'None' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('rsvps.update-status', ['rsvp' => $rsvp->id]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="status" onchange="this.form.submit()" class="text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                        <option value="pending" {{ $rsvp->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="accepted" {{ $rsvp->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                                        <option value="declined" {{ $rsvp->status === 'declined' ? 'selected' : '' }}>Declined</option>
                                                        <option value="maybe" {{ $rsvp->status === 'maybe' ? 'selected' : '' }}>Maybe</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $rsvps->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 