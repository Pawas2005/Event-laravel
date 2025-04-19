<x-guest-layout>
    <div>
        <div class="w-full sm:max-w-md mt-6 px-8 py-6 bg-white shadow-2xl border border-gray-200 rounded-2xl transition-all duration-300 hover:shadow-3xl">
            <h2 class="text-2xl font-bold text-center text-purple-700 mb-6">Welcome to Event Portal</h2>

            <div class="mb-4 text-sm text-gray-600 text-center">
                {{ __('Enter your email address to access your RSVP invitations.') }}
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('guest.login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-400 shadow-sm" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition ease-in-out duration-300">
                        {{ __('Access RSVPs') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
