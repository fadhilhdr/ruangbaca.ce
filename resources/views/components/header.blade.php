<header class="w-full bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/S1-Teknik-Komputer.png') }}" alt="Logo" class="h-14 w-auto">
                </a>
            </div>
            
            <!-- Right Side Navigation -->
            <div class="flex items-center space-x-6">
                <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
                
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                <span class="font-medium">{{ Auth::user()->name }}</span>
                                <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link href="{{ url('/dashboard') }}">Dashboard</x-dropdown-link>
                            <x-dropdown-link href="{{ url('/profile') }}">Profile</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-6">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-200 font-medium">Register</a>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>