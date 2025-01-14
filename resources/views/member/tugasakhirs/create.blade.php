<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Upload Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('member.tugasakhirs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold">Judul</label>
                            <input type="text" name="title" required
                                   class="w-full px-3 py-2 border rounded-lg"
                                   value="{{ old('title') }}">
                        </div>

                        @php
                            $fields = [
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

                        @foreach($fields as $field => $label)
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold">{{ $label }}</label>
                                <input type="file" name="{{ $field }}" required
                                       accept="application/pdf"
                                       class="w-full px-3 py-2 border rounded-lg">
                            </div>
                        @endforeach

                        <div class="mt-6">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                Upload Tugas Akhir
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

