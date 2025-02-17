<!-- resources/views/sections/visitor-section.blade.php -->
<div class="bg-gradient-to-b  from-white py-24 to-blue-200">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h4 class="text-2xl lg:text-4xl font-bold mb-8 leading-tight">
                    <span class="text-gray-800
                                 drop-shadow-[0_1px_1px_rgba(0,0,0,0.1)]">
                                 {{ now()->format('l, d M Y') }}
                    </span>
                </h4>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                
                <!-- Library Info with improved layout -->
                <div class="p-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-6 md:space-y-0">
                        <div class="space-y-4">
                            <div>
                                <h3 class="font-bold text-2xl text-gray-900 mb-2">Ruang Baca Teknik Komputer</h3>
                                <p class="text-gray-600 text-lg">Dekanat Lama FT</p>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-lg">08:00 AM - 05:00 PM</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-lg">Senin - Jumat</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 rounded-xl p-6 text-center min-w-[200px]">
                            <div class="text-gray-600 font-medium mb-2">Pengunjung Hari Ini</div>
                            <div class="text-3xl font-bold text-blue-600">
                                {{ App\Models\Visitor::whereDate('check_in_at', \Carbon\Carbon::today())->count() }}
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Action Button -->
                    <div class="mt-8">
                        <a href="{{ route('visitor.index') }}" class="block group">
                            <div class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl px-8 py-6 flex justify-between items-center transition duration-300 transform hover:scale-[1.01]">
                                <div>
                                    <h3 class="font-bold text-2xl mb-2">Isi Daftar Hadir</h3>
                                    <p class="text-blue-100 text-lg">Silakan isi daftar hadir untuk menggunakan fasilitas</p>
                                </div>
                                <div class="bg-white/10 rounded-lg p-3">
                                    <svg class="w-8 h-8 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>