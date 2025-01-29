<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">        
        @include('components.page-header', [
            'title' => 'Koleksi Buku',
        ])

        <!-- Search and Filter Section -->
        <div class="mb-8 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 sm:p-8">
                <form method="GET" action="{{ route('public.books.index') }}" class="space-y-6">
                    <!-- Search Bar -->
                    <div class="max-w-full mx-auto">
                        <div class="relative">
                            <input 
                                type="text" 
                                name="keyword" 
                                value="{{ request('keyword') }}"
                                placeholder="Cari judul buku, penulis, atau topik..."
                                class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-colors"
                            />
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Advanced Filter Controls -->
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Filter Type Selection -->
                        <div class="md:col-span-4">
                            <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Berdasarkan</label>
                            <select 
                                name="filter" 
                                id="filter"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                onchange="this.form.submit()"
                            >
                                <option value="">Pilih Filter</option>
                                <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>Judul</option>
                                <option value="penulis" {{ request('filter') == 'penulis' ? 'selected' : '' }}>Pengarang</option>
                                <option value="isbn" {{ request('filter') == 'isbn' ? 'selected' : '' }}>ISBN</option>
                                <option value="peminatan" {{ request('filter') == 'peminatan' ? 'selected' : '' }}>Peminatan</option>
                                <option value="sub_peminatan" {{ request('filter') == 'sub_peminatan' ? 'selected' : '' }}>Sub Peminatan</option>
                            </select>
                        </div>

                        <!-- Dynamic Filter Values -->
                        <div class="md:col-span-5">
                            @if(request('filter'))
                                <label for="filter_value" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ ucfirst(request('filter')) }}
                                </label>
                                
                                @switch(request('filter'))
                                    @case('peminatan')
                                        <select 
                                            name="filter_value" 
                                            id="filter_value"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                            onchange="this.form.submit()"
                                        >
                                            <option value="">Semua Peminatan</option>
                                            @foreach ($peminatans as $peminatan)
                                                <option value="{{ $peminatan }}" {{ request('filter_value') == $peminatan ? 'selected' : '' }}>
                                                    {{ $peminatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @break

                                    @case('sub_peminatan')
                                        <select 
                                            name="filter_value" 
                                            id="filter_value"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                            onchange="this.form.submit()"
                                        >
                                            <option value="">Semua Sub Peminatan</option>
                                            @foreach ($subPeminatans as $subPeminatan)
                                                <option value="{{ $subPeminatan }}" {{ request('filter_value') == $subPeminatan ? 'selected' : '' }}>
                                                    {{ $subPeminatan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @break

                                    @default
                                        <input 
                                            type="text" 
                                            name="filter_value" 
                                            id="filter_value"
                                            value="{{ request('filter_value') }}" 
                                            placeholder="Masukkan nilai filter..."
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        />
                                @endswitch
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="md:col-span-3 flex items-end">
                            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex w-full gap-3">
                                <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 group">
                                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </button>
                                
                                @if(request()->hasAny(['keyword', 'filter', 'filter_value']))
                                    <a href="{{ route('public.books.index') }}"
                                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-50 text-gray-700 font-medium rounded-xl hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 transition-all duration-200 group border border-gray-200">
                                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Informasi Hasil Pencarian -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 px-6 py-4 rounded-xl border border-blue-100 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-blue-700">
                            <span class="font-medium">{{ number_format($books->total()) }}</span> buku ditemukan
                            @if (request('keyword') || (request('filter') && request('filter_value')))
                                dengan kriteria:
                            @endif
                        </p>
                        @if (request('keyword') || (request('filter') && request('filter_value')))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if (request('keyword'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-700 text-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                        {{ request('keyword') }}
                                    </span>
                                @endif
                                @if (request('filter') && request('filter_value'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-700 text-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                        </svg>
                                        {{ ucfirst(request('filter')) }}: {{ Str::ucfirst(request('filter_value')) }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Book List Container -->
        <div class="grid grid-cols-2 gap-6">
            @forelse ($books as $book)
                <div class="bg-white p-4 border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 rounded-lg">
                    <div class="flex gap-4">
                        <!-- Book Thumbnail -->
                        <div class="w-24 h-32 relative overflow-hidden bg-gray-100 border border-gray-200 flex-shrink-0">
                            @if ($book->thumbnail)
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" 
                                    alt="{{ ucfirst(strtolower($book->judul)) }}"
                                    class="absolute inset-0 w-full h-full object-cover" />
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-200">
                                    <div class="">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Book Details -->
                        <div class="flex-1 min-w-0 flex flex-col justify-between h-full">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">{{ Str::Limit(Str::title($book->judul), 40, '...')}}</h2>

                                <!-- Secondary Info - Smaller and more compact -->
                                <div class="mt-1 space-y-1">
                                    <p class="text-xs text-gray-600">
                                        <span class="font-medium inline-block">Peminatan </span> : {{ Str::title($book->peminatan) }}
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        <span class="font-medium inline-block">Sub Peminatan </span> : {{ Str::title($book->sub_peminatan) }}
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        <span class="font-medium inline-block">Penulis </span> : {{ Str::title($book->penulis) }}
                                    </p>
                                    <p class="text-xs text-gray-600">
                                        <span class="font-medium inline-block">Penerbit </span> : {{ Str::title($book->penerbit) }}
                                    </p>
                                </div>

                                <!-- Synopsis - Fixed height container -->
                                <div class="mt-2 h-10"> <!-- Fixed height untuk synopsis -->
                                    @if($book->synopsis)
                                        <p class="text-xs text-gray-500 line-clamp-2">{{ $book->synopsis }}</p>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Bottom container for badge and button -->
                    <div class="space-y-3">
                        <!-- Availability Badge -->
                        <div class="text-center">
                            <div class="inline-flex items-center px-3 py-1.5 rounded-lg {{ $book->available_stock > 0 ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }}">
                                <span class="text-sm font-medium">
                                    {{ $book->available_stock }} dari {{ $book->total_stock }} tersedia
                                </span>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="text-center">
                            <a href="{{ route('public.books.show', $book->isbn) }}"
                                class="inline-flex rounded-lg items-center px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 border border-blue-200 hover:border-blue-300 transition-colors">
                                <span>Lihat Detail</span>
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State - Spans full width -->
                <div class="col-span-2 text-center py-8 bg-white border border-gray-200 rounded-lg">

                    <h3 class="mt-3 text-base font-medium text-gray-900">Tidak ada buku yang ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci atau filter pencarian Anda</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
