<nav class="bg-gradient-to-r from-blue-800 to-blue-900 text-white shadow-lg">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between items-center">
            <!-- Left Side Navigation -->
            <div class="hidden sm:flex space-x-1">
                <a href="{{ url('/') }}" 
                   class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">
                    Beranda
                </a>
                
                <!-- Services Dropdown -->
                <div class="relative group">
                    <button class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center space-x-2 border-b-2 border-transparent group-hover:border-white">
                        <span>Layanan</span>
                        <svg class="h-5 w-5 transform group-hover:rotate-180 transition-transform duration-200" 
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="hidden group-hover:block absolute left-0 w-56 bg-white shadow-xl py-2 z-50">
                        <a href="{{ route('visitor.index') }}" 
                        class="block px-4 py-2.5 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                            Daftar Hadir
                        </a>
                        <a href="{{ route('public.books.index') }}" 
                        class="block px-4 py-2.5 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                            Koleksi Buku
                        </a>
                        <a href="{{ route('public.tugasakhirs.index') }}" 
                        class="block px-4 py-2.5 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                            Tugas Akhir
                        </a>
                        <a href="{{ route('public.capstones.index') }}" 
                        class="block px-4 py-2.5 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                            Capstone
                        </a>
                    </div>
                </div>
                
                <a href="#" 
                   class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">
                    Panduan
                </a>
                <a href="#" 
                   class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">
                    Informasi
                </a>
            </div>
            
            <!-- Right Side Navigation -->
            <div class="flex items-center">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-3 py-4 px-4 hover:bg-blue-700 transition-colors duration-200 group border-b-2 border-transparent group-hover:border-white">
                            <!-- User Name -->
                            <span class="hidden sm:block font-medium text-white group-hover:text-white">
                                {{ Auth::user()->name }}
                            </span>
                            <!-- Dropdown Arrow -->
                            <svg class="h-5 w-5 text-white transform group-hover:rotate-180 transition-transform duration-200" 
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <!-- User Dropdown Menu -->
                        <div class="hidden group-hover:block absolute right-0 w-48 bg-white shadow-xl py-2 z-50">
                            <a href="{{ url('/dashboard') }}" 
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                                Dashboard
                            </a>
                            <a href="{{ url('/profile') }}" 
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                                Profile
                            </a>
                            <div class="border-t-2 border-gray-200 my-2"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white transition-colors duration-200">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex space-x-1">
                        <a href="{{ route('login') }}" 
                           class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">
                                Register
                            </a>
                        @endif
                    </div>
                @endauth
                
                <!-- Mobile Menu Button -->
                <div class="sm:hidden">
                    <label for="mobile-menu-button" class="block p-4 hover:bg-blue-700 transition-colors duration-200 cursor-pointer">
                        <input type="checkbox" id="mobile-menu-button" class="hidden peer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="hidden sm:hidden peer-checked:block border-t border-blue-700">
            <a href="{{ url('/') }}" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Beranda
            </a>
            <a href="{{ route('visitor.index') }}" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Daftar Hadir
            </a>
            <a href="{{ route('public.books.index') }}" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Koleksi Buku
            </a>
            <a href="{{ route('public.tugasakhirs.index') }}" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Tugas Akhir
            </a>
            <a href="{{ route('public.capstones.index') }}" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Capstone
            </a>
            <a href="#" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Panduan
            </a>
            <a href="#" 
               class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                Informasi
            </a>
            
            @guest
                <div class="border-t border-blue-700 py-2">
                    <a href="{{ route('login') }}" 
                       class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" 
                           class="block py-3 px-4 text-white hover:bg-blue-700 transition-colors duration-200">
                            Register
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </div>
</nav>