<div class="relative min-h-[60vh] flex items-center">
    <!-- Video Background with Enhanced Gradient Overlay -->
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-black/70 to-blue-900/90"></div>

    <!-- Main Content -->
    <div class="relative container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl lg:text-7xl font-bold mb-8 leading-tight">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-grey to-blue-300">
                    Ruang Baca Teknik Komputer
                </span>
            </h1>
            
            <!-- Search Bar -->
            <div class="relative max-w-2xl mx-auto">
                <div class="backdrop-blur-md bg-white/10 p-1 flex">
                    <input type="text" 
                           placeholder="Cari referensi yang dibutuhkan disini" 
                           class="w-full bg-transparent text-white placeholder-white/60 px-4 py-3 focus:outline-none">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
