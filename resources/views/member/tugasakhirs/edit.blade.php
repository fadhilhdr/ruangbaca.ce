<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Kelola Tugas Akhir',
        ])
        
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form method="POST" action="{{ route('member.tugasakhirs.update', $tugasakhir->id) }}" 
                      enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info Section -->
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                                    <input type="text" name="title" id="title" required
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                           value="{{ $tugasakhir->title }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Penulis</label>
                                    <div class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-gray-700 sm:text-sm">
                                        {{ $tugasakhir->user->name }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Dokumen</h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                @php
                                    $documents = [
                                        'full_document' => 'Dokumen Lengkap',
                                        'cover_abstract' => 'Cover dan Abstrak',
                                        'bab1_pendahuluan' => 'BAB 1 - Pendahuluan',
                                        'bab2_kajianpustaka' => 'BAB 2 - Kajian Pustaka',
                                        'bab3_perancangan' => 'BAB 3 - Perancangan',
                                        'bab4_hasilpembahasan' => 'BAB 4 - Hasil dan Pembahasan',
                                        'bab5_penutup' => 'BAB 5 - Penutup',
                                        'lampiran' => 'Lampiran'
                                    ];
                                @endphp

                                @foreach($documents as $field => $label)
                                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                        <label class="block">
                                            <span class="text-sm font-medium text-gray-900">{{ $label }}</span>
                                            
                                            @if($tugasakhir->$field)
                                                <div class="flex items-center mt-2 mb-3 text-sm">
                                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                                       target="_blank"
                                                       class="text-blue-600 hover:underline">
                                                        {{ pathinfo($tugasakhir->$field, PATHINFO_FILENAME) }}.{{ pathinfo($tugasakhir->$field, PATHINFO_EXTENSION) }}
                                                    </a>
                                                </div>
                                            @endif

                                            <input type="file" 
                                                   name="{{ $field }}" 
                                                   accept="application/pdf"
                                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            
                                            <p class="mt-1 text-xs text-gray-500">
                                                Biarkan kosong jika tidak ingin mengubah file
                                            </p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('member.tugasakhirs.show', $tugasakhir->id) }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Tugas Akhir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>