<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Tugas Akhir Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('member.tugasakhirs.create') }}" 
                           class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            Upload Tugas Akhir Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Judul</th>
                                    <th class="px-4 py-2">Dokumen</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tugasakhirs as $ta)
                                    <tr>
                                        <td class="px-4 py-2">{{ $ta->title }}</td>
                                        <td class="px-4 py-2">
                                            @php
                                                $fields = [
                                                    'full_document' => 'Dokumen Lengkap',
                                                    'cover_abstract' => 'Cover & Abstrak',
                                                    'bab1_pendahuluan' => 'BAB 1',
                                                    'bab2_kajianpustaka' => 'BAB 2',
                                                    'bab3_perancangan' => 'BAB 3',
                                                    'bab4_hasilpembahasan' => 'BAB 4',
                                                    'bab5_penutup' => 'BAB 5',
                                                    'lampiran' => 'Lampiran'
                                                ];
                                            @endphp
                                            <div class="space-x-2">
                                                @foreach($fields as $field => $label)
                                                    @if($ta->$field)
                                                        <a href="{{ Storage::url($ta->$field) }}" 
                                                           target="_blank"
                                                           class="text-sm text-blue-600 hover:underline">
                                                            {{ $label }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('member.tugasakhirs.show', $ta->id) }}"
                                               class="px-3 py-1 mr-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-100">
                                                Detail
                                            </a>
                                            <a href="{{ route('member.tugasakhirs.edit', $ta->id) }}"
                                               class="px-3 py-1 text-green-600 border border-green-600 rounded hover:bg-green-100">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
