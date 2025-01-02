<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Search and Filter Section -->
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
                        <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul</option>
                        <option value="penulis" {{ request('filter') == 'penulis' ? 'selected' : '' }}>Pengarang</option>
                        <option value="isbn" {{ request('filter') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                        <option value="peminatan" {{ request('filter') == 'peminatan' ? 'selected' : '' }}>Peminatan</option>
                        <option value="sub_peminatan" {{ request('filter') == 'sub_peminatan' ? 'selected' : '' }}>Sub Peminatan</option>
                    </select>
                </div>

                <!-- Nilai Filter -->
                @if(request('filter') && request('filter') != 'all')
                    @php
                        $filter = request('filter');
                    @endphp
                    <div class="mt-4 flex gap-4">
                        @if($filter == 'peminatan')
                            <select name="filter_value" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Peminatan</option>
                                @foreach($peminatans as $peminatan)
                                    <option value="{{ $peminatan }}" {{ request('filter_value') == $peminatan ? 'selected' : '' }}>{{ $peminatan }}</option>
                                @endforeach
                            </select>
                        @elseif($filter == 'sub_peminatan')
                            <select name="filter_value" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Sub Peminatan</option>
                                @foreach($subPeminatans as $subPeminatan)
                                    <option value="{{ $subPeminatan }}" {{ request('filter_value') == $subPeminatan ? 'selected' : '' }}>{{ $subPeminatan }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" name="filter_value" value="{{ request('filter_value') }}" 
                                   placeholder="Nilai filter..." 
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @endif
                    </div>
                @endif
            </form>
            <p class="mt-2 text-sm text-gray-600">Ditemukan {{ $books->total() }} hasil pencarian.</p>
        </div>

        <!-- Book List -->
        <div class="space-y-4">
            @forelse ($books as $book)
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <div class="flex gap-4">
                        <!-- Book Thumbnail -->
                        <div class="w-24 h-32 relative rounded-lg overflow-hidden bg-gray-100 shadow-sm">
                            @if ($book->thumbnail && Storage::exists('public/' . $book->thumbnail))
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" 
                                    alt="{{ $book->judul }}" 
                                    class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                    <div class="w-8 h-8 mb-1 flex items-center justify-center rounded-full bg-gray-200">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h2 class="text-lg font-semibold mb-1">{{ $book->judul }}</h2>
                                    <p class="text-sm text-gray-600 mb-1">Penulis: {{ $book->penulis }}</p>
                                    <p class="text-sm text-gray-600 mb-2">ISBN: {{ $book->isbn }}</p>
                                    <p class="text-sm text-gray-500">{{ Str::limit($book->synopsis, 100) }}</p>
                                </div>
                                <div class="text-center px-4 py-2 bg-blue-50 rounded-lg">
                                    <span class="text-lg font-semibold text-blue-700">{{ $book->available_stock }}</span>
                                    <p class="text-xs text-blue-600">Tersedia</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('public.books.show', $book->isbn) }}" 
                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                     <span>Lihat Detail</span>
                                     <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                     </svg>
                                 </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 14h.01M12 16h.01M12 18h.01M12 20h.01M12 22h.01" />
                    </svg>
                    <p class="mt-2 text-gray-500">Tidak ada buku yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>