<nav class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-lg">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-between">
            <div class="hidden sm:flex space-x-1">
                <a href="{{ url('/') }}" class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">Beranda</a>
                
                <div class="relative group">
                    <button class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 flex items-center border-b-2 border-transparent hover:border-white group-hover:bg-blue-700">
                        Layanan
                        <svg class="ml-2 h-4 w-4 transition-transform duration-200 group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute hidden group-hover:block w-56 bg-white shadow-xl rounded-b-lg py-2 z-50 animate-fade-in-down">
                        <a href="{{ route('visitor.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">Daftar Hadir</a>
                        <a href="{{ route('public.books.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">Koleksi Buku</a>
                        <a href="{{ route('public.tugasakhirs.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">Tugas Akhir</a>
                    </div>
                </div>
                
                <a href="#" class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">Informasi</a>
                <a href="#" class="py-4 px-4 hover:bg-blue-700 hover:text-white transition-colors duration-200 border-b-2 border-transparent hover:border-white">Bantuan</a>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="sm:hidden">
                <button @click="open = !open" class="p-4 hover:bg-blue-700 transition-colors duration-200">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden animate-fade-in">
        <a href="{{ url('/') }}" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Beranda</a>
        <a href="{{ route('visitor.index') }}" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Daftar Hadir</a>
        <a href="{{ route('public.books.index') }}" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Koleksi Buku</a>
        <a href="{{ route('public.tugasakhirs.index') }}" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Tugas Akhir</a>
        <a href="#" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Informasi</a>
        <a href="#" class="block py-3 px-4 hover:bg-blue-700 transition-colors duration-200">Bantuan</a>
    </div>
</nav>