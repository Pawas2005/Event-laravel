<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Your RSVP Invitations</h2>
                        <form method="POST" action="{{ route('guest.logout') }}">
                            @csrf
                            <x-primary-button type="submit">
                                {{ __('Log Out') }}
                            </x-primary-button>
                        </form>
                    </div>

                    @if($rsvps->isEmpty())
                        <p class="text-gray-600">You don't have any RSVP invitations at the moment.</p>
                    @else
                        <div class="space-y-6">
                            @foreach($rsvps as $rsvp)
                                <div class="border rounded-lg p-6">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $rsvp->event->title }}</h3>
                                            <p class="text-gray-600">{{ $rsvp->event->description }}</p>
                                            <p class="text-sm text-gray-500 mt-2">
                                                <strong>Date:</strong> {{ $rsvp->event->start_date->format('F j, Y') }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                <strong>Location:</strong> {{ $rsvp->event->location }}
                                            </p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <form method="POST" action="{{ route('guest.rsvp.update', $rsvp) }}" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()" 
                                                    class="text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm
                                                    @if($rsvp->status === 'accepted') bg-green-100 text-green-800
                                                    @elseif($rsvp->status === 'declined') bg-red-100 text-red-800
                                                    @elseif($rsvp->status === 'maybe') bg-yellow-100 text-yellow-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    <option value="pending" {{ $rsvp->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="accepted" {{ $rsvp->status === 'accepted' ? 'selected' : '' }}>Accept</option>
                                                    <option value="declined" {{ $rsvp->status === 'declined' ? 'selected' : '' }}>Decline</option>
                                                    <option value="maybe" {{ $rsvp->status === 'maybe' ? 'selected' : '' }}>Maybe Later</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout> 