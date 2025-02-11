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
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600 tracking-wide w-48">
                                Cover Buku
                            </th>
                            @php
                                $columns = [
                                    'judul' => 'Judul',
                                    'penulis' => 'Penulis',
                                    'penerbit' => 'Penerbit',
                                    'peminatan' => 'Peminatan',
                                    'sub_peminatan' => 'Sub Peminatan'
                                ];
                            @endphp

                            @foreach($columns as $field => $label)
                                <th scope="col" class="px-6 py-4 text-left">
                                    <a href="{{ route('public.books.index', array_merge(
                                        request()->except(['sort', 'direction']),
                                        [
                                            'sort' => $field,
                                            'direction' => ($sortField === $field && $sortDirection === 'asc') ? 'desc' : 'asc'
                                        ]
                                    )) }}" 
                                        class="group inline-flex items-center space-x-2 text-sm font-semibold {{ $sortField === $field ? 'text-blue-600' : 'text-gray-600' }}"
                                    >
                                        <span class="border-b-2 {{ $sortField === $field ? 'border-blue-600' : 'border-transparent group-hover:border-gray-300' }} py-1">
                                            {{ $label }}
                                        </span>
                                        <span class="relative flex items-center">
                                            @if($sortField === $field)
                                                @if($sortDirection === 'asc')
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                @endif
                                            @else
                                                <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            @endif
                                        </span>
                                    </a>
                                </th>
                            @endforeach
                            <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-600 tracking-wide">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($books as $book)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="relative">
                                        <div class="w-32 h-40 relative overflow-hidden bg-gray-100 rounded-t-lg border border-gray-200 shadow-sm">
                                            @if ($book->thumbnail)
                                                <img src="{{ asset('storage/' . $book->thumbnail) }}" 
                                                    alt="{{ ucfirst(strtolower($book->judul)) }}"
                                                    class="absolute inset-0 w-full h-full object-cover" />
                                            @else
                                                <div class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- Enhanced availability status -->
                                        <div class="">
                                            <div class="relative">
                                                <div class="absolute inset-0 bg-white rounded-full shadow-sm"></div>
                                                <div class="w-32 relative px-3 py-1 rounded-b-lg border {{ $book->available_stock > 0 ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }} text-center">
                                                    <span class="text-sm font-medium {{ $book->available_stock > 0 ? 'text-green-700' : 'text-red-700' }}">
                                                        {{ $book->available_stock }} dari {{ $book->total_stock }} tersedia
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ Str::title($book->judul) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::title($book->penulis) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::title($book->penerbit) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::title($book->peminatan) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ Str::title($book->sub_peminatan) }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('public.books.show', $book->isbn) }}"
                                        class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors duration-200 gap-2 min-w-[160px]">
                                        <span>Detail Buku</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center">
                                    <h3 class="text-base font-medium text-gray-900">Tidak ada buku yang ditemukan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci atau filter pencarian Anda</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
</x-app-layout>
