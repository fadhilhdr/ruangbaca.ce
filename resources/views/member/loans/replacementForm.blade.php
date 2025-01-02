<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('member.loans.returnForm', $loan->id) }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Form Pengembalian
                </a>
            </div>

            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Laporan Buku Hilang</h1>

                <!-- Book Details -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <h4 class="font-medium text-gray-900 mb-2">Informasi Buku</h4>
                    <dl class="grid grid-cols-1 gap-2">
                        <div>
                            <dt class="text-sm text-gray-500">Judul</dt>
                            <dd class="text-gray-900">{{ $loan->book->judul }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">Kode Unik</dt>
                            <dd class="text-gray-900">{{ $loan->kode_unik_buku }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm text-gray-500">ISBN</dt>
                            <dd class="text-gray-900">{{ $loan->book->isbn }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Replacement Form -->
                <form action="{{ route('member.loans.replacement.store', $loan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Keterangan Kehilangan
                        </label>
                        <textarea id="description"
                                 name="description"
                                 rows="4"
                                 required
                                 class="mt-1 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm border-gray-300 rounded-md"
                                 placeholder="Jelaskan bagaimana buku tersebut hilang..."></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-yellow-50 rounded-lg p-4">
                        <h4 class="font-medium text-yellow-800 mb-2">Ketentuan Penggantian Buku:</h4>
                        <ul class="list-disc list-inside space-y-1 text-yellow-700 text-sm">
                            <li>Penggantian harus dengan buku yang sama (judul, pengarang, penerbit)</li>
                            <li>Kondisi buku harus baru</li>
                            <li>Waktu penggantian maksimal 30 hari</li>
                            <li>Denda keterlambatan tetap berlaku sampai buku pengganti diterima</li>
                        </ul>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox"
                                   id="agreement"
                                   name="agreement"
                                   required
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="agreement" class="font-medium text-gray-700">
                                Saya memahami dan setuju dengan ketentuan penggantian buku
                            </label>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Ajukan Laporan Kehilangan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>