<!-- resources/views/sections/services-section.blade.php -->
<div class="bg-gradient-to-b from-blue-200 to-white py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Enhanced Header Section -->
            <div class="text-center mb-16 relative">
                <!-- Decorative Elements -->
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 w-24 h-1 bg-blue-500/20 rounded-full"></div>
                
                <h1 class="text-3xl lg:text-5xl font-bold mb-8 leading-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-800">
                        Layanan Digital
                    </span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                    Akses sumber daya akademik untuk mendukung pembelajaran Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Koleksi Buku -->
                <div class="group">
                    <a href="{{ route('public.books.index') }}" class="block">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 relative">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-5 pointer-events-none">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <pattern id="books-pattern" patternUnits="userSpaceOnUse" width="20" height="20">
                                        <rect width="2" height="20" fill="currentColor" class="text-blue-900">
                                            <animate attributeName="height" values="20;15;20" dur="2s" repeatCount="indefinite"/>
                                        </rect>
                                    </pattern>
                                    <rect width="100" height="100" fill="url(#books-pattern)"/>
                                </svg>
                            </div>
                            
                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <!-- Enhanced Book Icon -->
                                        <div class="transform group-hover:scale-110 transition-transform duration-300">
                                            <div class="relative w-24 h-24">
                                                <svg class="absolute inset-0 w-full h-full text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                                <!-- Decorative circles -->
                                                <div class="absolute -top-2 -right-2 w-4 h-4 bg-blue-200 rounded-full group-hover:bg-blue-400 transition-colors duration-300"></div>
                                                <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-blue-200 rounded-full group-hover:bg-blue-400 transition-colors duration-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-8 relative">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 mb-3 transition-colors duration-300">
                                    Koleksi Buku
                                </h3>
                                <p class="text-gray-600">Akses berbagai koleksi buku akademik untuk mendukung pembelajaran Anda</p>
                                <!-- Enhanced Arrow -->
                                <div class="absolute bottom-6 right-6">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transform group-hover:translate-x-1 transition-all duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Tugas Akhir -->
                <div class="group">
                    <a href="{{ route('public.tugasakhirs.index') }}" class="block">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 relative">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-5 pointer-events-none">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <pattern id="thesis-pattern" patternUnits="userSpaceOnUse" width="20" height="20">
                                        <circle cx="10" cy="10" r="2" fill="currentColor" class="text-blue-900">
                                            <animate attributeName="r" values="2;3;2" dur="3s" repeatCount="indefinite"/>
                                        </circle>
                                    </pattern>
                                    <rect width="100" height="100" fill="url(#thesis-pattern)"/>
                                </svg>
                            </div>

                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <!-- Enhanced Thesis Icon -->
                                        <div class="transform group-hover:scale-110 transition-transform duration-300">
                                            <div class="relative w-24 h-24">
                                                <svg class="absolute inset-0 w-full h-full text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <!-- Decorative squares -->
                                                <div class="absolute -top-2 -right-2 w-4 h-4 bg-blue-200 rotate-45 group-hover:bg-blue-400 transition-colors duration-300"></div>
                                                <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-blue-200 rotate-45 group-hover:bg-blue-400 transition-colors duration-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 relative">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 mb-3 transition-colors duration-300">
                                    Tugas Akhir
                                </h3>
                                <p class="text-gray-600">Akses kumpulan tugas akhir mahasiswa sebagai referensi penelitian</p>
                                <!-- Enhanced Arrow -->
                                <div class="absolute bottom-6 right-6">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transform group-hover:translate-x-1 transition-all duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Capstone -->
                <div class="group">
                    <a href="{{ route('public.capstones.index') }}" class="block">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 relative">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-5 pointer-events-none">
                                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <pattern id="capstone-pattern" patternUnits="userSpaceOnUse" width="20" height="20">
                                        <path d="M0 0L10 10L20 0L10 -10Z" fill="currentColor" class="text-blue-900">
                                            <animateTransform attributeName="transform" type="rotate" from="0 10 10" to="360 10 10" dur="8s" repeatCount="indefinite"/>
                                        </path>
                                    </pattern>
                                    <rect width="100" height="100" fill="url(#capstone-pattern)"/>
                                </svg>
                            </div>

                            <div class="aspect-[4/3] relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white group-hover:from-blue-600 group-hover:to-blue-700 transition-all duration-300">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <!-- Enhanced Capstone Icon -->
                                        <div class="transform group-hover:scale-110 transition-transform duration-300">
                                            <div class="relative w-24 h-24">
                                                <svg class="absolute inset-0 w-full h-full text-blue-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                                <!-- Decorative triangles -->
                                                <div class="absolute -top-2 -right-2 w-4 h-4 bg-blue-200 transform rotate-45 group-hover:bg-blue-400 transition-colors duration-300"></div>
                                                <div class="absolute -bottom-2 -left-2 w-4 h-4 bg-blue-200 transform rotate-45 group-hover:bg-blue-400 transition-colors duration-300"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-8 relative">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-blue-600 mb-3 transition-colors duration-300">
                                    Capstone
                                </h3>
                                <p class="text-gray-600">Jelajahi proyek capstone mahasiswa untuk inspirasi</p>
                                <!-- Enhanced Arrow -->
                                <div class="absolute bottom-6 right-6">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 group-hover:bg-blue-600 flex items-center justify-center transition-all duration-300">
                                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transform group-hover:translate-x-1 transition-all duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
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