<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">        
        
        @include('components.page-header', [
        'title' => 'Detail Dokumen Capstone',
    ])

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Project Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Project Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ $capstone->kategori }}
                            </span>
                            <span class="text-sm text-gray-500 font-medium">
                                {{ $capstone->kode_kelompok }}
                            </span>
                        </div>
                        <h1 class="text-xl font-semibold text-gray-900 mb-6 leading-tight">
                            {{ $capstone->judul_capstone }}
                        </h1>
                        
                        <!-- Team Members -->
                        <div class="space-y-4">
                            <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tim Pengembang</h2>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-700">
                                            {{ substr($capstone->anggota1->name ?? 'A', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $capstone->anggota1->name ?? 'Tidak ada' }}</p>
                                        <p class="text-sm text-gray-500">{{ $capstone->anggota1_nim }}</p>
                                    </div>
                                </div>

                                @if($capstone->anggota2_nim)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-700">
                                            {{ substr($capstone->anggota2->name ?? 'A', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $capstone->anggota2->name ?? 'Tidak ada' }}</p>
                                        <p class="text-sm text-gray-500">{{ $capstone->anggota2_nim }}</p>
                                    </div>
                                </div>
                                @endif

                                @if($capstone->anggota3_nim)
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-sm font-medium text-blue-700">
                                            {{ substr($capstone->anggota3->name ?? 'A', 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $capstone->anggota3->name ?? 'Tidak ada' }}</p>
                                        <p class="text-sm text-gray-500">{{ $capstone->anggota3_nim }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Documents -->
            <div class="lg:col-span-2 space-y-6">
                <!-- C100 Document Section -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-semibold text-gray-900">Dokumen C100</h2>
                            @if($capstone->c100_path)
                            <div class="flex items-center space-x-3">
                                <a href="{{ Storage::url($capstone->c100_path) }}" download
                                    class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download
                                </a>
                                <a href="{{ Storage::url($capstone->c100_path) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-2 border border-blue-600 text-sm font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Preview
                                </a>
                            </div>
                            @endif
                        </div>

                        @if($capstone->c100_path)
                            <div class="border rounded-lg overflow-hidden">
                                <iframe src="{{ Storage::url($capstone->c100_path) }}" class="w-full h-[600px]" title="Dokumen C100"></iframe>
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Dokumen Belum Tersedia</h3>
                                <p class="mt-1 text-sm text-gray-500">Dokumen C100 akan segera ditambahkan</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Other Documents Section -->
                @if(auth()->check())
                    @foreach($documents as $field => $label)
                        @if($field !== 'c100_path' && $capstone->$field)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <h2 class="text-lg font-semibold text-gray-900">{{ $label }}</h2>
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ Storage::url($capstone->$field) }}" download
                                                class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Download
                                            </a>
                                            <a href="{{ Storage::url($capstone->$field) }}" target="_blank"
                                                class="inline-flex items-center px-3 py-2 border border-blue-600 text-sm font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                Preview
                                            </a>
                                        </div>
                                    </div>
                                    <div class="border rounded-lg overflow-hidden">
                                        <iframe src="{{ Storage::url($capstone->$field) }}" class="w-full h-[500px]" title="{{ $label }}"></iframe>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-8 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Dokumen Terbatas</h3>
                            <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">
                                Dokumen C200-C500 hanya tersedia untuk pengguna yang sudah melakukan autentikasi
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Login untuk Mengakses
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>