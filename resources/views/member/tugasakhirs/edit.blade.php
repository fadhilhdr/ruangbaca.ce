<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('member.tugasakhirs.update', $tugasakhir->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Info -->
                        <div class="mb-6">
                            <h3 class="mb-4 text-lg font-medium">Informasi Dasar</h3>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div>
                                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                                    <input type="text" name="title" id="title" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           value="{{ $tugasakhir->title }}" required>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-medium text-gray-700">Penulis</label>
                                    <p class="px-3 py-2 text-gray-600 bg-gray-50 border border-gray-300 rounded-md">
                                        {{ $tugasakhir->user->name }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Document Uploads -->
                        <div class="mb-6">
                            <h3 class="mb-4 text-lg font-medium">Dokumen</h3>
                            <div class="space-y-4">
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
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <label class="block mb-2 font-medium">{{ $label }}</label>
                                        
                                        @if($tugasakhir->$field)
                                            <div class="flex items-center mb-2 space-x-2">
                                                <span class="text-sm text-gray-600">File saat ini:</span>
                                                <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                                target="_blank"
                                                class="text-sm text-blue-600 hover:underline">
                                                    {{ pathinfo($tugasakhir->$field, PATHINFO_FILENAME) }}.{{ pathinfo($tugasakhir->$field, PATHINFO_EXTENSION) }}
                                                </a>
                                            </div>
                                        @endif

                                        <input type="file" 
                                               name="{{ $field }}" 
                                               accept=".pdf"
                                               class="w-full px-3 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        
                                        <p class="mt-1 text-sm text-gray-500">
                                            Biarkan kosong jika tidak ingin mengubah file
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Tugas Akhir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>