<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Detail Dokumen Capstone',
        ])

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Informasi Capstone</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Kode Kelompok:</p>
                            <p class="font-semibold">{{ $capstone->kode_kelompok }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Kategori:</p>
                            <p class="font-semibold">{{ $capstone->kategori }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-gray-600">Judul Capstone:</p>
                            <p class="font-semibold">{{ $capstone->judul_capstone }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Anggota Tim</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-gray-600">Ketua (Anggota 1):</p>
                            <p class="font-semibold">{{ $capstone->anggota1->name ?? 'Tidak ada' }} ({{ $capstone->anggota1_nim }})</p>
                        </div>
                        @if($capstone->anggota2_nim)
                        <div>
                            <p class="text-gray-600">Anggota 2:</p>
                            <p class="font-semibold">{{ $capstone->anggota2->name ?? 'Tidak ada' }} ({{ $capstone->anggota2_nim }})</p>
                        </div>
                        @endif
                        @if($capstone->anggota3_nim)
                        <div>
                            <p class="text-gray-600">Anggota 3:</p>
                            <p class="font-semibold">{{ $capstone->anggota3->name ?? 'Tidak ada' }} ({{ $capstone->anggota3_nim }})</p>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Dokumen Capstone</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">C100:</p>
                            <p class="font-semibold">{{ $capstone->c100_path ? 'Tersedia' : 'Belum upload' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">C200:</p>
                            <p class="font-semibold">{{ $capstone->c200_path ? 'Tersedia' : 'Belum upload' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">C300:</p>
                            <p class="font-semibold">{{ $capstone->c300_path ? 'Tersedia' : 'Belum upload' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">C400:</p>
                            <p class="font-semibold">{{ $capstone->c400_path ? 'Tersedia' : 'Belum upload' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">C500:</p>
                            <p class="font-semibold">{{ $capstone->c500_path ? 'Tersedia' : 'Belum upload' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex gap-4">
                        @if($capstone->anggota1_nim === auth()->user()->userid)
                        <a href="{{ route('member.capstones.edit', $capstone->id) }}" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit Capstone
                        </a>
                        {{-- <form action="{{ route('member.capstones.destroy', $capstone->id) }}" method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus capstone ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Hapus Capstone
                            </button>
                        </form> --}}
                        @endif
                    </div>
                    <a href="{{ route('member.capstones.index') }}" 
                        class="text-gray-600 hover:underline">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>