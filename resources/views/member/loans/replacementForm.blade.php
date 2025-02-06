<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        @include('components.page-header', ['title' => 'Pelaporan Buku Hilang'])

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white shadow-lg rounded-lg p-6">
            <!-- Informasi Buku -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Buku</h2>
                <div class="flex flex-col sm:flex-row sm:space-x-6">
                    <!-- Book Image -->
                    <div class="flex-shrink-0 mb-4 sm:mb-0">
                        <div class="relative aspect-[3/4] w-full sm:w-48 rounded-lg overflow-hidden bg-white shadow">
                            @if ($loan->book->thumbnail && Storage::exists('public/' . $loan->book->thumbnail))
                                <img src="{{ asset('storage/' . $loan->book->thumbnail) }}" 
                                     alt="{{ $loan->book->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Book Details -->
                    <div class="flex-1">
                        <dl class="divide-y divide-gray-200">
                            <div class="py-2 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Judul</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->judul }}</dd>
                            </div>
                            <div class="py-2 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->penulis }}</dd>
                            </div>
                            <div class="py-2 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->isbn }}</dd>
                            </div>
                            <div class="py-2 grid grid-cols-3 gap-4">
                                <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                                <dd class="text-sm text-gray-900 col-span-2">{{ $loan->book->penerbit }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Form Pelaporan -->
            <div>
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Laporan Buku Hilang</h2>
                <p class="text-sm text-gray-700 mb-4">
                    Jika buku yang Anda pinjam hilang, harap isi formulir di bawah ini. Anda wajib mengganti dengan buku yang sama (judul, pengarang, dan penerbit) dalam kondisi baik. 
                    Akun Anda tidak dapat melakukan peminjaman sampai penggantian dikonfirmasi oleh admin.
                </p>

                <form action="{{ route('member.loans.replacement.store', $loan->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Harap menyalin pernyataan di bawah ini:
                        </label>
                        <p class="text-sm italic text-gray-600 mb-1">
                            "Saya sepakat akan mengikuti prosedur pengembalian buku sesuai aturan yang berlaku."
                        </p>
                        <textarea id="description"
                                  name="description"
                                  rows="3"
                                  required
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"
                                  placeholder="Tulis pernyataan di sini..."></textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h4 class="font-medium text-yellow-800 mb-2">Alur Penggantian Buku:</h4>
                        <ul class="list-disc list-inside text-yellow-700 text-sm space-y-1">
                            <li>Ajukan laporan kehilangan buku melaui halaman.</li>
                            <li>Temui admin untuk melakukan penggantian buku harus dengan buku yang sama (judul, pengarang, penerbit).</li>
                            <li>Admin akan melakukan verifikasi secara langsung</li>
                        </ul>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox"
                               id="agreement"
                               name="agreement"
                               required
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="agreement" class="ml-2 text-sm text-gray-700">
                            Saya memahami dan setuju dengan ketentuan penggantian buku.
                        </label>
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
