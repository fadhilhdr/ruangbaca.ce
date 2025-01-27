<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Capstone Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 flex justify-end">
                        <a href="{{ route('member.capstones.create') }}" 
                           class="bg-green-500 text-white px-4 py-2 rounded">
                            Tambah Capstone
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($capstones->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            Anda belum memiliki capstone. Silakan tambah capstone baru.
                        </div>
                    @else
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b">Kode Kelompok</th>
                                    <th class="px-6 py-3 border-b">Judul</th>
                                    <th class="px-6 py-3 border-b">Kategori</th>
                                    <th class="px-6 py-3 border-b">Status</th>
                                    <th class="px-6 py-3 border-b">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($capstones as $capstone)
                                    <tr>
                                        <td class="px-6 py-4 border-b">{{ $capstone->kode_kelompok }}</td>
                                        <td class="px-6 py-4 border-b">{{ $capstone->judul_capstone }}</td>
                                        <td class="px-6 py-4 border-b">{{ $capstone->kategori }}</td>
                                        <td class="px-6 py-4 border-b">
                                            {{-- Tambahkan logic status berdasarkan dokumen yang sudah diupload --}}
                                            @php
                                                $documents = [
                                                    $capstone->c100_path,
                                                    $capstone->c200_path,
                                                    $capstone->c300_path,
                                                    $capstone->c400_path,
                                                    $capstone->c500_path
                                                ];
                                                $uploadedCount = count(array_filter($documents));
                                                $totalDocuments = 5;
                                                $progress = ($uploadedCount / $totalDocuments) * 100;
                                            @endphp
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                            <span class="text-sm text-gray-600">{{ $uploadedCount }}/{{ $totalDocuments }} dokumen</span>
                                        </td>
                                        <td class="px-6 py-4 border-b">
                                            <a href="{{ route('member.capstones.show', $capstone->id) }}"
                                               class="text-blue-500 hover:underline mr-2">Detail</a>
                                            <a href="{{ route('member.capstones.edit', $capstone->id) }}"
                                               class="text-green-500 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4">
                            {{ $capstones->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>