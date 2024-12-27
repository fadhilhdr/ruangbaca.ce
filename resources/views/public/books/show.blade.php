<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Detail Buku</h1>

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
                    <p class="text-sm text-gray-600 mb-4"><strong>Stok:</strong> {{ $book->stock }} Buku</p>

                    <!-- Button for Borrowing Restrictions (Member Only) -->
                    <div class="flex items-center gap-2">
                        @auth
                            @if (auth()->user()->role_id == 1) <!-- Check if user is a Member -->
                                <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Pinjam Buku</a>
                            @else
                                <button class="bg-gray-500 text-white px-4 py-2 rounded-md" disabled>Hanya Member yang Bisa Meminjam Buku</button>
                            @endif
                        @else
                            <button class="bg-gray-500 text-white px-4 py-2 rounded-md" disabled>Harap Login untuk Meminjam Buku</button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Books List -->
        <div class="mt-6">
            <a href="{{ route('public.books.index') }}" class="text-blue-600 hover:text-blue-800">Kembali ke Daftar Buku</a>
        </div>
    </div>
</x-app-layout>
