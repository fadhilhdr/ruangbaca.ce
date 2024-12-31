<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Pinjam Buku</h2>

        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Book Detail Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex gap-6">
                <!-- Book Thumbnail -->
                <div class="w-48 h-64 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                    @if ($book->thumbnail && Storage::exists('public/' . $book->thumbnail))
                        <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="object-cover w-full h-full">
                    @else
                        <!-- Placeholder if no thumbnail exists -->
                        <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    @endif
                </div>

                <!-- Book Information -->
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $book->title }}</h2>
                    <p class="text-sm text-gray-600 mb-2"><strong>Penulis:</strong> {{ $book->author }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>ISBN:</strong> {{ $book->isbn }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>Spesialisasi:</strong> {{ $book->specialization->name ?? 'Tidak Ada' }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>Sinopsis:</strong> {{ $book->synopsis }}</p>
                    <p class="text-sm text-gray-600 mb-4"><strong>Stok:</strong> {{ $book->available_stock }}</p>

                    <!-- Aturan Peminjaman -->
                    <div class="mb-4">
                        <h3 class="font-bold">Aturan Peminjaman:</h3>
                        <ul class="list-disc list-inside">
                            <li>Peminjaman maksimal 2 buku.</li>
                            <li>Peminjaman maksimal selama 2 minggu, bisa diperpanjang.</li>
                            <li>Jika buku hilang, wajib mencari buku pengganti yang sama.</li>
                            <li>Keterlambatan pengembalian akan dikenakan denda Rp. 1000,00 x jumlah hari terlambat.</li>
                        </ul>
                    </div>

                    <!-- Borrow Form -->
                    <form method="POST" action="{{ route('member.loans.borrow', $book->id) }}">
                        @csrf
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                            @if ($book->available_stock <= 0) disabled @endif
                        >
                            Pinjam Buku
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
