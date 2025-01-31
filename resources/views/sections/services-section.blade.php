<!-- resources/views/sections/services-section.blade.php -->
<div class="bg-gray-50/50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-2xl lg:text-4xl font-bold mb-8 leading-tight">
                    <span class="text-gray-800
                                 drop-shadow-[0_1px_1px_rgba(0,0,0,0.1)]">
                        Layanan Digital
                    </span>
                </h1>
                <p class="mt-4 text-lg text-gray-600">Akses sumber daya akademik untuk mendukung pembelajaran Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Koleksi Buku -->
                <div class="group">
                    <a href="{{ route('public.books.index') }}" class="block">
                        <div
                            class="bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:bg-blue-600 transition-all duration-300">
                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gray-100 group-hover:bg-blue-600">
                                    <div class="absolute inset-0 opacity-10">
                                        <div
                                            class="h-full w-full flex items-center justify-center text-4xl font-bold text-gray-300 group-hover:text-white">
                                            Buku
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="absolute inset-0 p-6 text-gray-700 group-hover:text-white flex flex-col justify-between">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="absolute bottom-6 right-6">
                                        <svg class="w-8 h-8 transform group-hover:translate-x-2 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 group-hover:text-white">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2">Koleksi Buku
                                </h3>
                                <p class="text-gray-600 group-hover:text-white/90">Akses berbagai koleksi buku akademik
                                    untuk mendukung pembelajaran Anda</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tugas Akhir -->
                <div class="group">
                    <a href="{{ route('public.tugasakhirs.index') }}" class="block">
                        <div
                            class="bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:bg-blue-600 transition-all duration-300">
                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gray-100 group-hover:bg-blue-600">
                                    <div class="absolute inset-0 opacity-10">
                                        <div
                                            class="h-full w-full flex items-center justify-center text-4xl font-bold text-gray-300 group-hover:text-white">
                                            Tugas Akhir
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="absolute inset-0 p-6 text-gray-700 group-hover:text-white flex flex-col justify-between">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div class="absolute bottom-6 right-6">
                                        <svg class="w-8 h-8 transform group-hover:translate-x-2 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 group-hover:text-white">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2">Tugas Akhir</h3>
                                <p class="text-gray-600 group-hover:text-white/90">Akses kumpulan tugas akhir mahasiswa
                                    sebagai referensi penelitian</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Capstone -->
                <div class="group">
                    <a href="{{ route('public.capstones.index') }}" class="block">
                        <div
                            class="bg-gray-50 rounded-2xl overflow-hidden shadow-md hover:bg-blue-600 transition-all duration-300">
                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gray-100 group-hover:bg-blue-600">
                                    <div class="absolute inset-0 opacity-10">
                                        <div
                                            class="h-full w-full flex items-center justify-center text-4xl font-bold text-gray-300 group-hover:text-white">
                                            Capstone
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="absolute inset-0 p-6 text-gray-700 group-hover:text-white flex flex-col justify-between">
                                    <div class="w-12 h-12 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <div class="absolute bottom-6 right-6">
                                        <svg class="w-8 h-8 transform group-hover:translate-x-2 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 group-hover:text-white">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-white mb-2">Capstone</h3>
                                <p class="text-gray-600 group-hover:text-white/90">Jelajahi proyek capstone mahasiswa
                                    untuk inspirasi</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
