<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Koleksi Buku</h1>
            <p class="mt-2 text-sm text-gray-600">
                Jelajahi koleksi buku kami yang lengkap dan temukan buku yang Anda cari
            </p>
        </div>

        <!-- Search and Filter Section -->
        <div class="mb-8 bg-white p-6 rounded-xl shadow-sm">
            <form method="GET" action="{{ route('public.books.index') }}" class="space-y-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                        placeholder="Cari judul buku, penulis, atau topik..."
                        class="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" />
                    <button type="submit"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-blue-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>

                <!-- Filter Controls -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Main Filter Dropdown -->
                    <div class="space-y-1">
                        <label for="filter" class="block text-sm font-medium text-gray-700">Filter Berdasarkan</label>
                        <select name="filter" id="filter"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul</option>
                            <option value="penulis" {{ request('filter') == 'penulis' ? 'selected' : '' }}>Pengarang
                            </option>
                            <option value="isbn" {{ request('filter') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                            <option value="peminatan" {{ request('filter') == 'peminatan' ? 'selected' : '' }}>Peminatan
                            </option>
                            <option value="sub_peminatan" {{ request('filter') == 'sub_peminatan' ? 'selected' : '' }}>
                                Sub Peminatan</option>
                        </select>
                    </div>

                    <!-- Dynamic Filter Value Field -->
                    @if (request('filter') && request('filter') != 'all')
                        <div class="space-y-1">
                            <label for="filter_value"
                                class="block text-sm font-medium text-gray-700">{{ ucfirst(request('filter')) }}</label>
                            @if (request('filter') == 'peminatan')
                                <select name="filter_value" id="filter_value"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                    <option value="">Semua Peminatan</option>
                                    @foreach ($peminatans as $peminatan)
                                        <option value="{{ $peminatan }}"
                                            {{ request('filter_value') == $peminatan ? 'selected' : '' }}>
                                            {{ $peminatan }}
                                        </option>
                                    @endforeach
                                </select>
                            @elseif(request('filter') == 'sub_peminatan')
                                <select name="filter_value" id="filter_value"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                    <option value="">Semua Sub Peminatan</option>
                                    @foreach ($subPeminatans as $subPeminatan)
                                        <option value="{{ $subPeminatan }}"
                                            {{ request('filter_value') == $subPeminatan ? 'selected' : '' }}>
                                            {{ $subPeminatan }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" name="filter_value" id="filter_value"
                                    value="{{ request('filter_value') }}" placeholder="Masukkan nilai filter..."
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                            @endif
                        </div>
                    @endif

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-colors">
                            Cari Buku
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Results Info -->
        <div class="mb-6">
            <p class="text-sm text-gray-600">
                Ditemukan <span class="font-semibold">{{ $books->total() }}</span> hasil pencarian
                @if (request('keyword'))
                    untuk kata kunci "<span class="font-semibold">{{ request('keyword') }}</span>"
                @endif
                @if (request('filter') && request('filter_value'))
                    dalam kategori "<span class="font-semibold">{{ ucfirst(request('filter_value')) }}</span>"
                @endif
            </p>
        </div>

        <!-- Book List -->
        <div class="space-y-4">
            @forelse ($books as $book)
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex gap-6">
                        <!-- Book Thumbnail -->
                        <div class="w-32 h-44 relative rounded-lg overflow-hidden bg-gray-100">
                            @if ($book->thumbnail)
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="{{ $book->judul }}"
                                    class="absolute inset-0 w-full h-full object-cover" />
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                    <div
                                        class="w-10 h-10 mb-2 flex items-center justify-center rounded-full bg-gray-200">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                    <p class="text-xs text-gray-600 font-medium text-center px-2">
                                        {{ Str::limit($book->judul, 20) }}
                                    </p>
                                </div>
                            @endif

                        </div>

                        <!-- Book Details -->
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div class="space-y-2">
                                    <h2 class="text-xl font-semibold text-gray-900">{{ $book->judul }}</h2>
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">Penulis:</span> {{ $book->penulis }}
                                        </p>
                                        <p class="text-sm text-gray-600">
                                            <span class="font-medium">ISBN:</span> {{ $book->isbn }}
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-500 line-clamp-2">{{ $book->synopsis }}</p>
                                </div>

                                <!-- Availability Badge -->
                                <div class="text-center px-6 py-3 bg-blue-50 rounded-lg">
                                    <span class="text-2xl font-bold text-blue-700">{{ $book->available_stock }}</span>
                                    <p class="text-sm text-blue-600">Tersedia</p>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-4">
                                <a href="{{ route('public.books.show', $book->isbn) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 14h.01M12 16h.01M12 18h.01M12 20h.01M12 22h.01" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada buku yang ditemukan</h3>
                    <p class="mt-2 text-sm text-gray-500">Coba ubah kata kunci atau filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
