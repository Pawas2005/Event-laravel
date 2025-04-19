<!-- Modern Footer -->
<footer class="bg-white relative">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Top Section with Logo and Social -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0">
            <!-- Logo Section -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-black rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-star text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-black text-xl font-bold">Event Management</h3>
                    <p class="text-gray-600 text-sm">Create Memorable Moments</p>
                </div>
            </div>

            <!-- Social Links -->
            <div class="flex items-center space-x-4">
                <a href="#" class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center transition-all duration-300 hover:bg-gray-800">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center transition-all duration-300 hover:bg-gray-800">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center transition-all duration-300 hover:bg-gray-800">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center transition-all duration-300 hover:bg-gray-800">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>

        <!-- Main Grid Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Quick Links -->
            <div>
                <h4 class="text-black font-semibold text-lg mb-4">Quick Links</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-black">Events</a>
                    </li>
                    <li>
                        <a href="{{ route('guests.index') }}" class="text-gray-600 hover:text-black">Guests</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-black">About Us</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-black">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-black font-semibold text-lg mb-4">Contact Info</h4>
                <ul class="space-y-3">
                    <li class="text-gray-600">
                        <i class="fas fa-envelope text-black mr-2"></i>
                        info@events.com
                    </li>
                    <li class="text-gray-600">
                        <i class="fas fa-phone text-black mr-2"></i>
                        (555) 123-4567
                    </li>
                    <li class="text-gray-600">
                        <i class="fas fa-map-marker-alt text-black mr-2"></i>
                        123 Event Street, City
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="lg:col-span-2">
                <h4 class="text-black font-semibold text-lg mb-4">Subscribe to Our Newsletter</h4>
                <p class="text-gray-600 mb-4">Stay updated with our latest events and features.</p>
                <form class="flex space-x-2">
                    <input 
                        type="email" 
                        placeholder="Enter your email" 
                        class="flex-1 bg-white text-black rounded-lg px-4 py-2 border border-gray-300 focus:outline-none focus:border-black focus:ring-1 focus:ring-black/50"
                    >
                    <button 
                        type="submit" 
                        class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-all duration-300"
                    >
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-200 pt-8 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <p class="text-gray-600 text-sm">
                &copy; {{ date('Y') }} Event Management. All rights reserved.
            </p>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-600 hover:text-black text-sm">Privacy Policy</a>
                <a href="#" class="text-gray-600 hover:text-black text-sm">Terms of Service</a>
                <a href="#" class="text-gray-600 hover:text-black text-sm">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer> 