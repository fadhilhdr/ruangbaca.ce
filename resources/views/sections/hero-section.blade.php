<div class="hero-section mt-24">
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

        <div class="search-container max-w-4xl mx-auto rounded-2xl shadow-xl p-8">
            <div class="flex space-x-6 mb-8 border-b border-gray-200">
                <button class="px-6 py-3 text-blue-600 border-b-2 border-blue-600 font-medium transition-all duration-200 hover:text-blue-700">
                    Check-in Visitor
                </button>
                <button class="px-6 py-3 text-gray-500 hover:text-gray-700 transition-all duration-200">
                    Cari Buku
                </button>
            </div>

            <form method="POST" action="{{ route('visitor.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="identifier" class="block text-sm font-medium text-gray-700">Nama atau NIM</label>
                    <input 
                        type="text" 
                        name="identifier" 
                        id="identifier" 
                        placeholder="Masukkan Nama atau NIM Anda" 
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" 
                        required>
                </div>

                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                    <input 
                        type="text" 
                        name="instansi" 
                        id="instansi" 
                        placeholder="Masukkan instansi Anda (opsional)" 
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                    Check-in
                </button>
            </form>
            

            <form action="{{ route('public.books.index') }}" method="GET" class="hidden space-y-4">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari judul buku, penulis, atau kategori..." 
                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <svg class="w-6 h-6 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                    Cari Buku
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('button');
        const forms = document.querySelectorAll('form');
        
        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                    t.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                    t.classList.add('text-gray-500');
                });
                tab.classList.remove('text-gray-500');
                tab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                
                forms.forEach((form, formIndex) => {
                    if (formIndex === index) {
                        form.classList.remove('hidden');
                    } else {
                        form.classList.add('hidden');
                    }
                });
            });
        });
    });
</script>
@endpush