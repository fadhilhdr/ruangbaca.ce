<div class="hero-section relative min-h-screen">
    <!-- Video Background with Enhanced Gradient Overlay -->
    <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-black/70 to-blue-900/90"></div>

    <!-- Main Content -->
    <div class="relative">
        <!-- Stats Bar -->
        <div class="hidden lg:block absolute top-0 left-0 right-0 bg-white/10 backdrop-blur-md border-b border-white/10">
            <div class="container mx-auto">
                <div class="flex justify-center space-x-12 py-3 text-white/90 text-sm">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Buka: 08.00 - 16.00 WIB</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="animate-pulse">{{ rand(10, 30) }} Pengunjung Hari Ini</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>1000+ Koleksi Buku</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-4 pt-28 pb-20">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="text-center lg:text-left text-white mb-12 lg:mb-16">
                    <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-white to-blue-200">
                            Ruang Baca CE
                        </span>
                    </h1>
                    <p class="text-xl lg:text-2xl font-light text-blue-100/90 max-w-2xl lg:max-w-3xl mx-auto lg:mx-0">
                        Temukan referensi Anda butuhkan untuk mendukung perjalanan akademikmu!
                    </p>
                </div>

                <!-- Three Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <!-- Visitor Card -->
                    <a href="{{ route('visitor.index') }}" class="group">
                        <div class="collection-card bg-white/10 backdrop-blur-xl rounded-2xl p-8 hover:shadow-xl border border-white/20 transition duration-300 hover:shadow-blue-500/10 hover:border-blue-200/30 h-full">
                            <div class="flex justify-between items-start mb-6">
                                <h3 class="font-bold text-2xl text-white">Daftar Hadir</h3>
                                <span class="p-2 bg-blue-400/10 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">👥</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Pengunjung Hari Ini</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">📊</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Total Pengunjung</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Book Card -->
                    <a href="{{ route('public.books.index') }}" class="group">
                        <div class="collection-card bg-white/10 backdrop-blur-xl rounded-2xl p-8 hover:shadow-xl border border-white/20 transition duration-300 hover:shadow-blue-500/10 hover:border-blue-200/30 h-full">
                            <div class="flex justify-between items-start mb-6">
                                <h3 class="font-bold text-2xl text-white">Koleksi Buku</h3>
                                <span class="p-2 bg-blue-400/10 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">📚</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Total Judul</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">👁️</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Total Views</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Thesis Card -->
                    <a href="#" class="group">
                        <div class="collection-card bg-white/10 backdrop-blur-xl rounded-2xl p-8 hover:shadow-xl border border-white/20 transition duration-300 hover:shadow-blue-500/10 hover:border-blue-200/30 h-full">
                            <div class="flex justify-between items-start mb-6">
                                <h3 class="font-bold text-2xl text-white">Tugas Akhir</h3>
                                <span class="p-2 bg-blue-400/10 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                                </span>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">📚</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Total Dokumen</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <div class="p-3 bg-blue-400/10 rounded-lg">
                                        <span class="text-xl">👁️</span>
                                    </div>
                                    <div>
                                        <p class="text-2xl font-bold text-white"></p>
                                        <p class="text-sm text-blue-100/80">Total Views</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>