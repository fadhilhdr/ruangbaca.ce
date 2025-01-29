<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Dashboard Member',
        ])

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Status Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Peminjaman Aktif -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Peminjaman Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $activeLoanCount }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Total buku yang sedang dipinjam</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-xl">
                            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Keterlambatan -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 {{ $lateLoanCount > 0 ? 'border-red-500' : 'border-green-500' }}">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Keterlambatan</p>
                            <h3 class="text-3xl font-bold {{ $lateLoanCount > 0 ? 'text-red-600' : 'text-gray-900' }} mt-2">
                                {{ $lateLoanCount }}
                            </h3>
                            <p class="text-sm {{ $lateLoanCount > 0 ? 'text-red-500' : 'text-gray-500' }} mt-1">
                                {{ $lateLoanCount > 0 ? 'Buku yang terlambat dikembalikan' : 'Tidak ada keterlambatan' }}
                            </p>
                        </div>
                        <div class="p-3 {{ $lateLoanCount > 0 ? 'bg-red-50' : 'bg-green-50' }} rounded-xl">
                            <svg class="w-8 h-8 {{ $lateLoanCount > 0 ? 'text-red-500' : 'text-green-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Sisa Kuota -->
                <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-purple-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Sisa Kuota Peminjaman</p>
                            <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $remainingQuota }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Buku yang masih bisa dipinjam</p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-xl">
                            <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Cepat & Peminjaman Aktif Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Menu Cepat -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-6">Menu Cepat</h2>
                            <div class="space-y-4">
                                <a href="{{ route('member.loans.index') }}" 
                                   class="flex items-center p-4 rounded-xl border border-gray-100 hover:bg-blue-50 transition-all duration-200 group">
                                    <div class="p-3 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Daftar Peminjaman</h3>
                                        <p class="text-sm text-gray-500 mt-1">Lihat semua peminjaman aktif</p>
                                    </div>
                                </a>

                                <a href="{{ route('member.loans.history') }}"
                                   class="flex items-center p-4 rounded-xl border border-gray-100 hover:bg-blue-50 transition-all duration-200 group">
                                    <div class="p-3 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Riwayat Peminjaman</h3>
                                        <p class="text-sm text-gray-500 mt-1">Lihat histori peminjaman</p>
                                    </div>
                                </a>

                                <a href="{{ route('public.books.index') }}"
                                   class="flex items-center p-4 rounded-xl border border-gray-100 hover:bg-blue-50 transition-all duration-200 group">
                                    <div class="p-3 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Cari Buku</h3>
                                        <p class="text-sm text-gray-500 mt-1">Telusuri koleksi perpustakaan</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Aktif -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-lg font-semibold text-gray-900">Peminjaman Aktif Terbaru</h2>
                                <a href="{{ route('member.loans.index') }}" 
                                   class="text-sm text-blue-600 hover:text-blue-700 hover:underline">
                                    Lihat Semua
                                </a>
                            </div>

                            @if($allLoans->isNotEmpty())
                                <div class="grid gap-6">
                                    @foreach($allLoans as $loan)
                                        <div class="flex bg-white rounded-xl border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-200 p-4">
                                            <!-- Book Thumbnail -->
                                            <div class="w-24 h-32 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden">
                                                @if ($loan->book->thumbnail)
                                                    <img src="{{ Storage::url($loan->book->thumbnail) }}"
                                                         alt="{{ $loan->book->judul }}"
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Book Info -->
                                            <div class="ml-6 flex-grow">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">{{ $loan->book->judul }}</h4>
                                                        <p class="text-sm text-gray-500 mt-1">{{ $loan->book->penulis }}</p>
                                                    </div>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $loan->status['class'] }}">
                                                        {{ $loan->status['label'] }}
                                                    </span>
                                                </div>

                                                <div class="mt-4 flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex items-center text-sm text-gray-500">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                            Tenggat: {{ Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('member.loans.show', $loan->id) }}"
                                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                                        Lihat Detail
                                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-xl">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <h3 class="mt-4 text-sm font-medium text-gray-900">Tidak Ada Peminjaman Aktif</h3>
                                    <p class="mt-2 text-sm text-gray-500">Anda belum memiliki peminjaman buku yang aktif saat ini.</p>
                                    <a href="{{ route('public.books.index') }}" 
                                       class="mt-6 inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                        Cari Buku
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</x-app-layout>