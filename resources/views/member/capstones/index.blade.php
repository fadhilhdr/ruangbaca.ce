<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($capstones->isEmpty())
                        <div class="mb-4 flex justify-end">
                            <a href="{{ route('member.capstones.create') }}" 
                               class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                                Tambah Capstone
                            </a>
                        </div>

                        <div class="text-center py-8 text-gray-500">
                            <p class="mb-2">Anda belum memiliki capstone.</p>
                            <p>Silakan klik tombol "Tambah Capstone" di atas untuk memulai project capstone Anda.</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded">
                                <p class="font-medium">Info</p>
                                <p>Anda sudah memiliki project capstone yang aktif. Setiap mahasiswa hanya diperbolehkan memiliki 1 project capstone.</p>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b bg-gray-50">Kode Kelompok</th>
                                    <th class="px-6 py-3 border-b bg-gray-50">Judul</th>
                                    <th class="px-6 py-3 border-b bg-gray-50">Kategori</th>
                                    <th class="px-6 py-3 border-b bg-gray-50">Status</th>
                                    <th class="px-6 py-3 border-b bg-gray-50">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($capstones as $capstone)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 border-b">{{ $capstone->kode_kelompok }}</td>
                                        <td class="px-6 py-4 border-b">{{ $capstone->judul_capstone }}</td>
                                        <td class="px-6 py-4 border-b">{{ $capstone->kategori }}</td>
                                        <td class="px-6 py-4 border-b">
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
                                                <div class="bg-blue-600 h-2.5 rounded-full" 
                                                     style="width: {{ $progress }}%"
                                                     title="{{ $progress }}% selesai"></div>
                                            </div>
                                            <span class="text-sm text-gray-600 mt-1 block">
                                                {{ $uploadedCount }}/{{ $totalDocuments }} dokumen telah diupload
                                            </span>
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