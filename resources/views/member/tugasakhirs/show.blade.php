<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">{{ $tugasakhir->title }}</h3>
                        <div>
                            <a href="{{ route('member.tugasakhirs.edit', $tugasakhir->id) }}"
                               class="px-4 py-2 mr-2 text-white bg-green-500 rounded hover:bg-green-600">
                                Edit
                            </a>
                            <form action="{{ route('member.tugasakhirs.destroy', $tugasakhir->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus tugas akhir ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

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

                    <div class="mt-6">
                        <h4 class="mb-4 text-lg font-medium">Dokumen yang tersedia:</h4>
                        <div class="space-y-4">
                            @foreach($documents as $field => $label)
                                @if($tugasakhir->$field)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                        <span class="font-medium">{{ $label }}</span>
                                        <div class="space-x-2">
                                            <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                               target="_blank"
                                               class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-100">
                                                Preview
                                            </a>
                                            <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                               download
                                               class="px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>