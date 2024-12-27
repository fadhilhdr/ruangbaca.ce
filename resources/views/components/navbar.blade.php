// resources/views/components/navbar.blade.php
<nav class="bg-white shadow-sm fixed w-full top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <img src="{{ asset('images/S1-Teknik-Komputer.png') }}" alt="Logo" class="h-12">
            </div>
            <div class="flex items-center space-x-6">
                <a href="#" class="text-gray-700 hover:text-gray-900 transition">Beranda</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 transition">Informasi</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 transition">Bantuan</a>
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 transition">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>