<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Search Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-semibold text-gray-800">Koleksi Buku</h1>
            </div>
            <form method="GET" action="{{ route('public.books.index') }}">
                <div class="flex gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" 
                                   placeholder="Cari buku..." 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="submit" class="absolute right-2 top-2.5">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Options -->
                    <select name="filter" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="title" {{ request('filter') == 'title' ? 'selected' : '' }}>Judul</option>
                        <option value="author" {{ request('filter') == 'author' ? 'selected' : '' }}>Pengarang</option>
                        <option value="isbn" {{ request('filter') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                    </select>
                </div>
            </form>
            <p class="mt-2 text-sm text-gray-600">Ditemukan {{ $books->total() }} hasil pencarian.</p>
        </div>

        <!-- Book List -->
        <div class="space-y-4">
            @forelse ($books as $book)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex gap-4">
                    <!-- Book Thumbnail -->
                    <div class="w-24 h-32 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                        @if ($book->thumbnail && Storage::exists('public/' . $book->thumbnail))
                            <!-- Jika ada thumbnail, tampilkan -->
                            <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->title }}" class="object-cover w-full h-full">
                        @else
                            <!-- Placeholder jika tidak ada thumbnail -->
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        @endif
                    </div>

                        <div class="flex-1">
                            <h2 class="text-lg font-semibold mb-1">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600 mb-2">Penulis: {{ $book->author }}</p>
                            <p class="text-sm text-gray-500">{{ Str::limit($book->synopsis, 100) }}</p>
                            <div class="mt-2">
                                <a href="{{ route('public.books.show', $book) }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="text-lg font-semibold">{{ $book->available_stock }}</span>
                            <p class="text-xs text-gray-500">Copy</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Tidak ada buku yang ditemukan.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-6 gap-2">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
