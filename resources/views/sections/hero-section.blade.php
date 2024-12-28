<div class="hero-section mt-20">
    <video autoplay loop muted playsinline class="hero-video">
        <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
    </video>
    
    <div class="container mx-auto px-4 py-20">
        <div class="text-center text-white mb-12 space-y-4">
            <h1 class="text-5xl font-bold mb-4 leading-tight">Selamat Datang di Ruang Baca CE</h1>
            <p class="text-xl font-light max-w-2xl mx-auto">Temukan referensi dan resource yang Anda butuhkan untuk mendukung perjalanan akademik Anda</p>
        </div>

        @if(session('error'))
        <div id="notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white py-2 px-4 rounded-md shadow-md z-50">
            {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
            <div id="notification" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-2 px-4 rounded-md shadow-md z-50">
                {{ session('success') }}
            </div>
        @endif

        <div class="search-container max-w-4xl mx-auto rounded-2xl shadow-xl p-8 bg-white bg-opacity-60 backdrop-blur-md">
            <div class="flex space-x-6 mb-8 border-b border-gray-200">
                <button 
                    id="checkin-button"
                    class="px-6 py-3 border-b-2 font-medium transition-all duration-200 focus:outline-none"
                    data-target="checkin-form">
                    Check-in Visitor
                </button>
                <button 
                    id="search-button"
                    class="px-6 py-3 border-b-2 font-medium transition-all duration-200 focus:outline-none"
                    data-target="search-form">
                    Cari Buku
                </button>
            </div>

            <form id="checkin-form" method="POST" action="{{ route('visitor.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="identifier" class="block text-sm font-medium text-gray-700">Nama atau NIM</label>
                    <input 
                        type="text" 
                        name="identifier" 
                        id="identifier" 
                        placeholder="Masukkan NIM atau Nama Anda" 
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" 
                        required>
                </div>
                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                    <input 
                        type="text" 
                        name="instansi" 
                        id="instansi" 
                        placeholder="Masukkan instansi Anda (Misal: Teknik Komputer)" 
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                    Check-in
                </button>
            </form>
            
            <form id="search-form" action="{{ route('public.books.index') }}" method="GET" class="hidden space-y-4">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari judul buku, penulis, atau topik"
                           class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" 
                           id="search-input">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                    Cari Buku
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const searchButton = document.getElementById('search-button');
    const checkinButton = document.getElementById('checkin-button');
    const searchForm = document.getElementById('search-form');
    const checkinForm = document.getElementById('checkin-form');

    // Fungsi untuk mengubah tampilan tombol dan form
    function switchForms(activeForm, inactiveForm, activeButton, inactiveButton) {
        // Menampilkan form aktif dan menyembunyikan form yang tidak aktif
        activeForm.classList.remove('hidden');
        inactiveForm.classList.add('hidden');
        
        // Mengatur gaya untuk tombol aktif
        activeButton.classList.add('text-blue-600', 'border-blue-600');
        activeButton.classList.remove('text-gray-500', 'border-transparent');
        
        // Mengatur gaya untuk tombol tidak aktif
        inactiveButton.classList.add('text-gray-500', 'border-transparent');
        inactiveButton.classList.remove('text-blue-600', 'border-blue-600');
    }

    // Inisialisasi tampilan awal
    document.addEventListener('DOMContentLoaded', () => {
        // Set awal tombol "Check-in Visitor" sebagai aktif
        switchForms(checkinForm, searchForm, checkinButton, searchButton);
    });

    // Menangani klik pada tombol "Cari Buku"
    searchButton.addEventListener('click', (e) => {
        e.preventDefault();
        switchForms(searchForm, checkinForm, searchButton, checkinButton);
    });

    // Menangani klik pada tombol "Check-in Visitor"
    checkinButton.addEventListener('click', (e) => {
        e.preventDefault();
        switchForms(checkinForm, searchForm, checkinButton, searchButton);
    });
</script>
