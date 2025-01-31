<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Detail Tugas Akhir',
        ])
        
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Basic Info -->
                <div class="mb-8">
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informasi Tugas Akhir</h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Judul</label>
                                    <p class="mt-1 text-lg text-gray-900">{{ $tugasakhir->title }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Penulis</label>
                                    <p class="mt-1 text-lg text-gray-900">{{ $tugasakhir->user->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Tanggal Upload</label>
                                    <p class="mt-1 text-lg text-gray-900">{{ $tugasakhir->created_at->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-500">Terakhir Diperbarui</label>
                                    <p class="mt-1 text-lg text-gray-900">{{ $tugasakhir->updated_at->format('d F Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Document List -->
                <div class="bg-white rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Dokumen Tersedia</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @php
                                $documents = [
                                    'full_document' => [
                                        'label' => 'Dokumen Lengkap',
                                        'icon' => 'document-text'
                                    ],
                                    'cover_abstract' => [
                                        'label' => 'Cover dan Abstrak',
                                        'icon' => 'document'
                                    ],
                                    'bab1_pendahuluan' => [
                                        'label' => 'BAB 1 - Pendahuluan',
                                        'icon' => 'academic-cap'
                                    ],
                                    'bab2_kajianpustaka' => [
                                        'label' => 'BAB 2 - Kajian Pustaka',
                                        'icon' => 'book-open'
                                    ],
                                    'bab3_perancangan' => [
                                        'label' => 'BAB 3 - Perancangan',
                                        'icon' => 'template'
                                    ],
                                    'bab4_hasilpembahasan' => [
                                        'label' => 'BAB 4 - Hasil dan Pembahasan',
                                        'icon' => 'chart-bar'
                                    ],
                                    'bab5_penutup' => [
                                        'label' => 'BAB 5 - Penutup',
                                        'icon' => 'check-circle'
                                    ],
                                    'lampiran' => [
                                        'label' => 'Lampiran',
                                        'icon' => 'paper-clip'
                                    ]
                                ];
                            @endphp

                            @foreach($documents as $field => $info)
                                @if($tugasakhir->$field)
                                    <div class="relative group">
                                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-400 hover:shadow-md transition-all duration-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                    <div>
                                                        <h4 class="text-sm font-medium text-gray-900">{{ $info['label'] }}</h4>
                                                        <p class="text-xs text-gray-500">PDF Document</p>
                                                    </div>
                                                </div>
                                                <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                                   target="_blank"
                                                   class="hidden group-hover:flex items-center justify-center p-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('member.dashboard') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                    <a href="{{ route('member.tugasakhirs.edit', $tugasakhir->id) }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Tugas Akhir
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>