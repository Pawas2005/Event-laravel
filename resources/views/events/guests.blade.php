<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Guests for ') }} {{ $event->title }}
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
                        <h3 class="text-lg font-semibold mb-4">Filter Guests</h3>
                        <form method="GET" action="{{ route('events.guests', $event) }}" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="search" :value="__('Search Guests')" />
                                    <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" 
                                        :value="request('search')" placeholder="Search by name or email" />
                                </div>
                                <div>
                                    <x-input-label for="status" :value="__('RSVP Status')" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="">All Statuses</option>
                                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="declined" {{ request('status') === 'declined' ? 'selected' : '' }}>Declined</option>
                                        <option value="maybe" {{ request('status') === 'maybe' ? 'selected' : '' }}>Maybe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                <x-primary-button type="submit">{{ __('Apply Filters') }}</x-primary-button>
                                <a href="{{ route('events.guests', $event) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                    {{ __('Clear Filters') }}
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Invite New Guests</h3>
                        <form method="POST" action="{{ route('events.invite', $event) }}" class="space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="guest_ids" :value="__('Select Guests')" />
                                <select id="guest_ids" name="guest_ids[]" multiple class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    @foreach(App\Models\Guest::whereNotIn('id', $event->guests->pluck('id'))->get() as $guest)
                                        <option value="{{ $guest->id }}">{{ $guest->name }} ({{ $guest->email }})</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('guest_ids')" />
                            </div>
                            <div>
                                <x-primary-button>{{ __('Send Invitations') }}</x-primary-button>
                            </div>
                        </form>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Current Guests</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Number of Guests</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($guests as $guest)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $guest->name }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $guest->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 rounded-full text-xs 
                                                    @if($guest->pivot->status === 'accepted') bg-green-100 text-green-800
                                                    @elseif($guest->pivot->status === 'declined') bg-red-100 text-red-800
                                                    @elseif($guest->pivot->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-blue-100 text-blue-800 @endif">
                                                    {{ ucfirst($guest->pivot->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ $guest->pivot->number_of_guests }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @php
                                                    $rsvp = $guest->rsvps->where('event_id', $event->id)->first();
                                                @endphp
                                                @if($rsvp)
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
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $guests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 