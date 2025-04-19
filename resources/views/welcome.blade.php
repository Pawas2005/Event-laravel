<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Event Management System') }}</title>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .hero-pattern {
                background-color: #1a365d;
                background-image: linear-gradient(135deg, rgba(49, 46, 129, 0.7) 0%, rgba(17, 24, 39, 0.8) 100%),
                    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.12'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-24">
                        <div class="flex items-center">
                            <div class="flex items-center space-x-4">
                                <x-application-logo size="large" class="h-16 w-16" />
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900">Event Management</h1>
                                    <p class="text-sm text-gray-600">Plan and Manage Your Events</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                                <a href="{{ route('guest.login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Guest Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section with Background -->
            <div class="hero-pattern relative h-[500px]">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-purple-900/90"></div>
                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="text-white max-w-3xl">
                        <h1 class="text-4xl md:text-6xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-blue-200 to-purple-200">
                            Create Unforgettable Events
                        </h1>
                        <p class="text-xl md:text-2xl mb-8 text-blue-100">Your all-in-one solution for planning and managing spectacular events</p>
                        <div class="flex space-x-4">
                            <a href="{{ route('register') }}" 
                               class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-lg font-semibold hover:from-blue-600 hover:to-purple-700 transition duration-300 transform hover:scale-105 shadow-lg">
                                Get Started
                            </a>
                            <a href="#features" 
                               class="bg-white/10 backdrop-blur-sm border border-white/20 text-white px-8 py-4 rounded-lg font-semibold hover:bg-white/20 transition duration-300 transform hover:scale-105">
                                Learn More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section with Lottie -->
            <div id="features" class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Choose Our Platform?</h2>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-semibold">Easy Event Creation</h3>
                                        <p class="text-gray-600">Create and customize events in minutes with our intuitive interface.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-users text-blue-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-semibold">Guest Management</h3>
                                        <p class="text-gray-600">Effortlessly manage guest lists and track RSVPs in real-time.</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-calendar-check text-purple-500 text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-semibold">Smart Planning Tools</h3>
                                        <p class="text-gray-600">Access powerful tools to streamline your event planning process.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <lottie-player
                                src="https://assets2.lottiefiles.com/packages/lf20_UgZWvP.json"
                                background="transparent"
                                speed="1"
                                style="width: 400px; height: 400px;"
                                loop
                                autoplay>
                            </lottie-player>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-blue-50 p-6 rounded-lg">
                                        <h2 class="text-2xl font-bold text-blue-800 mb-4">Events</h2>
                                        <p class="text-gray-600 mb-4">Manage your events, create new ones, and track RSVPs.</p>
                                        @auth
                                            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                                View Events
                                            </a>
                                        @else
                                            <p class="text-sm text-gray-500">Please log in to manage events</p>
                                        @endauth
                                    </div>

                                    <div class="bg-green-50 p-6 rounded-lg">
                                        <h2 class="text-2xl font-bold text-green-800 mb-4">Guests</h2>
                                        <p class="text-gray-600 mb-4">Manage your guest list and track their event attendance.</p>
                                        @auth
                                            <a href="{{ route('guests.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                                View Guests
                                            </a>
                                        @else
                                            <p class="text-sm text-gray-500">Please log in to manage guests</p>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-gray-400">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div>
                            <h3 class="text-xl font-bold mb-4">About Us</h3>
                            <p class="text-gray-400">We help you create and manage memorable events with our comprehensive event management platform.</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-gray-400 hover:text-white transition">About</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition">FAQs</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-white transition">Terms</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                            <ul class="space-y-2 text-gray-400">
                                <li><i class="fas fa-envelope mr-2"></i> aamirhasan2929@gmail.com</li>
                                <li><i class="fas fa-phone mr-2"></i> +91 9798527832</li>
                                <li><i class="fas fa-map-marker-alt mr-2"></i> Phagwara, Punjab</li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-white transition">
                                    <i class="fab fa-facebook-f text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-white transition">
                                    <i class="fab fa-twitter text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-white transition">
                                    <i class="fab fa-instagram text-2xl"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-white transition">
                                    <i class="fab fa-linkedin-in text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                        <p>&copy; {{ date('Y') }} Event Management System. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
