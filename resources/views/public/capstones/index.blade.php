<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Dokumen Capstone',
        ])
        <!-- Search and Filter Section -->
        <div class="mb-8 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="p-6 sm:p-8">
                <form method="GET" action="{{ route('public.capstones.index') }}" class="space-y-6">
                    <!-- Search Bar -->
                    <div class="max-w-full mx-auto">
                        <div class="relative">
                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                                placeholder="Cari judul capstone, kode kelompok, atau kategori..."
                                class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 transition-colors" />
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
                            <label for="filter" class="block text-sm font-medium text-gray-700 mb-2">Filter
                                Berdasarkan</label>
                            <select name="filter" id="filter"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                onchange="this.form.submit()">
                                <option value="">Pilih Filter</option>
                                <option value="judul_capstone"
                                    {{ request('filter') == 'judul_capstone' ? 'selected' : '' }}>Judul Capstone
                                </option>
                                <option value="kode_kelompok"
                                    {{ request('filter') == 'kode_kelompok' ? 'selected' : '' }}>Kode Kelompok
                                </option>
                                <option value="kategori" {{ request('filter') == 'kategori' ? 'selected' : '' }}>
                                    Kategori</option>
                            </select>
                        </div>

                        <!-- Dynamic Filter Values -->
                        <div class="md:col-span-5">
                            @if (request('filter'))
                                <label for="filter_value" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ ucfirst(str_replace('_', ' ', request('filter'))) }}
                                </label>

                                @if (request('filter') == 'kategori')
                                    <select name="filter_value" id="filter_value"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                        onchange="this.form.submit()">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}"
                                                {{ request('filter_value') == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="text" name="filter_value" id="filter_value"
                                        value="{{ request('filter_value') }}" placeholder="Masukkan nilai filter..."
                                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
                                @endif
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="md:col-span-3 flex items-end">
                            <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex w-full gap-3">
                                <button type="submit"
                                    class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all duration-200 group">
                                    <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Cari
                                </button>

                                @if (request()->hasAny(['keyword', 'filter', 'filter_value']))
                                    <a href="{{ route('public.capstones.index') }}"
                                        class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-50 text-gray-700 font-medium rounded-xl hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 transition-all duration-200 group border border-gray-200">
                                        <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:rotate-180 transition-transform duration-300"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Search Results Info -->
        <div class="mb-8">
            <div
                class="bg-gradient-to-r from-blue-50 to-blue-100/50 px-6 py-4 rounded-xl border border-blue-100 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-blue-700">
                            <span class="font-medium">{{ number_format($capstones->total()) }}</span> capstone
                            ditemukan
                            @if (request('keyword') || (request('filter') && request('filter_value')))
                                dengan kriteria:
                            @endif
                        </p>
                        @if (request('keyword') || (request('filter') && request('filter_value')))
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if (request('keyword'))
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-700 text-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        {{ request('keyword') }}
                                    </span>
                                @endif
                                @if (request('filter') && request('filter_value'))
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-100 text-blue-700 text-sm">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                        </svg>
                                        {{ ucfirst(str_replace('_', ' ', request('filter'))) }}:
                                        {{ request('filter_value') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Capstone Container -->
        <div class="bg-white rounded-xl shadow-sm   border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left">
                                <a href="{{ route('public.capstones.index', array_merge(
                                    request()->except(['sort', 'direction']),
                                    [
                                        'sort' => 'kode_kelompok',
                                        'direction' => ($sortField === 'kode_kelompok' && $sortDirection === 'asc') ? 'desc' : 'asc'
                                    ]
                                )) }}" 
                                    class="group inline-flex items-center space-x-2 text-sm font-semibold {{ $sortField === 'kode_kelompok' ? 'text-blue-600' : 'text-gray-600' }}"
                                >
                                    <span class="border-b-2 {{ $sortField === 'kode_kelompok' ? 'border-blue-600' : 'border-transparent group-hover:border-gray-300' }} py-1">
                                        Kode Kelompok
                                    </span>
                                    <span class="relative flex items-center">
                                        @if($sortField === 'kode_kelompok')
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
                            <th scope="col" class="px-6 py-4 text-left">
                                <a href="{{ route('public.capstones.index', array_merge(
                                    request()->except(['sort', 'direction']),
                                    [
                                        'sort' => 'judul_capstone',
                                        'direction' => ($sortField === 'judul_capstone' && $sortDirection === 'asc') ? 'desc' : 'asc'
                                    ]
                                )) }}" 
                                    class="group inline-flex items-center space-x-2 text-sm font-semibold {{ $sortField === 'judul_capstone' ? 'text-blue-600' : 'text-gray-600' }}"
                                >
                                    <span class="border-b-2 {{ $sortField === 'judul_capstone' ? 'border-blue-600' : 'border-transparent group-hover:border-gray-300' }} py-1">
                                        Judul
                                    </span>
                                    <span class="relative flex items-center">
                                        @if($sortField === 'judul_capstone')
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
                            <th scope="col" class="px-6 py-4 text-left">
                                <a href="{{ route('public.capstones.index', array_merge(
                                    request()->except(['sort', 'direction']),
                                    [
                                        'sort' => 'kategori',
                                        'direction' => ($sortField === 'kategori' && $sortDirection === 'asc') ? 'desc' : 'asc'
                                    ]
                                )) }}" 
                                    class="group inline-flex items-center space-x-2 text-sm font-semibold {{ $sortField === 'kategori' ? 'text-blue-600' : 'text-gray-600' }}"
                                >
                                    <span class="border-b-2 {{ $sortField === 'kategori' ? 'border-blue-600' : 'border-transparent group-hover:border-gray-300' }} py-1">
                                        Kategori
                                    </span>
                                    <span class="relative flex items-center">
                                        @if($sortField === 'kategori')
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
                            <th scope="col" class="px-6 py-4 text-left">
                                <span class="text-sm font-semibold text-gray-600">
                                    Aksi
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($capstones as $capstone)
                            <tr class="hover:bg-gray-50/75 transition-colors duration-150">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $capstone->kode_kelompok }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 line-clamp-2">
                                        {{ $capstone->judul_capstone }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $capstone->kategori }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('public.capstones.show', $capstone->id) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200 gap-2">
                                        <span>Lihat Detail</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                        </svg>
                                        <div>
                                            <h3 class="text-base font-medium text-gray-900">Tidak ada capstone yang ditemukan</h3>
                                            <p class="mt-1 text-sm text-gray-500">Coba ubah kata kunci atau filter pencarian Anda</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $capstones->links() }}
        </div>
    </div>
</x-app-layout>
