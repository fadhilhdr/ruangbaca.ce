<nav x-data="{ open: false }" class="bg-white shadow-sm fixed w-full top-0 z-50 border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/S1-Teknik-Komputer.png') }}" alt="Logo" class="h-12">
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-8 sm:flex sm:items-center sm:ms-10">
                    <a href="#" class="text-gray-700 hover:text-gray-900 transition">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 transition">Informasi</a>
                    <a href="#" class="text-gray-700 hover:text-gray-900 transition">Bantuan</a>
                </div>
            </div>

            <!-- Desktop Authentication Section -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="url('/dashboard')" class="py-2 px-4">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="py-2 px-4">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="space-x-4">
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 transition">Register</a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Beranda</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Informasi</a>
            <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Bantuan</a>
        </div>

        <!-- Mobile Authentication Links -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            @else
                <div class="px-4 py-2 space-y-1">
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:bg-gray-100 transition">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block text-gray-700 hover:bg-gray-100 transition">Register</a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
