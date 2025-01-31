<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Informasi Tugas Akhirmu ',
        ])
        
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Status Card -->
                @if(!$tugasakhirs->count())
                    <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Belum Ada Tugas Akhir</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>Anda belum mengunggah dokumen tugas akhir. Silakan unggah dokumen menggunakan tombol di bawah ini.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <a href="{{ route('member.tugasakhirs.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition-colors duration-200">
                            <svg class="mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Upload Tugas Akhir
                        </a>
                    </div>
                @else
                    <!-- Document Status Grid -->
                    @foreach($tugasakhirs as $ta)
                        <div class="bg-gray-50 rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-xl font-semibold text-gray-900">{{ $ta->title }}</h2>
                                <div class="flex space-x-2">
                                    <a href="{{ route('member.tugasakhirs.show', $ta->id) }}"
                                       class="inline-flex items-center px-3 py-2 border border-blue-600 text-sm font-medium rounded-md text-blue-600 bg-white hover:bg-blue-50 transition-colors duration-200">
                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Detail
                                    </a>
                                    <a href="{{ route('member.tugasakhirs.edit', $ta->id) }}"
                                       class="inline-flex items-center px-3 py-2 border border-green-600 text-sm font-medium rounded-md text-green-600 bg-white hover:bg-green-50 transition-colors duration-200">
                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                @php
                                    $fields = [
                                        'full_document' => ['Dokumen Lengkap', 'document-text'],
                                        'cover_abstract' => ['Cover & Abstrak', 'document'],
                                        'bab1_pendahuluan' => ['BAB 1', 'academic-cap'],
                                        'bab2_kajianpustaka' => ['BAB 2', 'book-open'],
                                        'bab3_perancangan' => ['BAB 3', 'template'],
                                        'bab4_hasilpembahasan' => ['BAB 4', 'chart-bar'],
                                        'bab5_penutup' => ['BAB 5', 'check-circle'],
                                        'lampiran' => ['Lampiran', 'paper-clip']
                                    ];
                                @endphp

                                @foreach($fields as $field => $info)
                                    <div class="bg-white p-4 rounded-lg border {{ $ta->$field ? 'border-green-200' : 'border-gray-200' }}">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium {{ $ta->$field ? 'text-green-600' : 'text-gray-500' }}">
                                                {{ $info[0] }}
                                            </span>
                                            @if($ta->$field)
                                                <a href="{{ Storage::url($ta->$field) }}" 
                                                   target="_blank"
                                                   class="text-blue-600 hover:text-blue-800">
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                </a>
                                            @else
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>