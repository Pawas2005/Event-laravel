<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Events') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Event
            </a>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                        <h3 class="text-lg font-semibold mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-600 mb-2">{{ Str::limit($event->description, 100) }}</p>
                        <div class="text-sm text-gray-500 mb-2">
                            <p><strong>Date:</strong> {{ $event->start_date->format('M d, Y') }}</p>
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Status:</strong> 
                                <span class="px-2 py-1 rounded-full text-xs 
                                    @if($event->status === 'upcoming') bg-blue-100 text-blue-800
                                    @elseif($event->status === 'ongoing') bg-green-100 text-green-800
                                    @elseif($event->status === 'completed') bg-gray-100 text-gray-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="flex justify-between mt-4">
                            <a href="{{ route('events.show', $event) }}" class="text-blue-500 hover:text-blue-700">View Details</a>
                            <div class="space-x-2">
                                <a href="{{ route('events.edit', $event) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 