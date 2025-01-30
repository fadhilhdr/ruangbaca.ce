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
                                
                                <a href="{{ route('member.tugasakhirs.index') }}"
                                    class="flex items-center p-4 rounded-xl border border-gray-100 hover:bg-blue-50 transition-all duration-200 group">
                                    <div class="p-3 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11h6"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15h4"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Tugas Akhir</h3>
                                        <p class="text-sm text-gray-500 mt-1">Unggah dokumen TA</p>
                                    </div>
                                </a>  
                                
                                <a href="{{ route('member.capstones.index') }}"
                                    class="flex items-center p-4 rounded-xl border border-gray-100 hover:bg-blue-50 transition-all duration-200 group">
                                    <div class="p-3 rounded-lg bg-blue-50 group-hover:bg-blue-100">
                                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11h6"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15h4"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-medium text-gray-900">Capstone</h3>
                                        <p class="text-sm text-gray-500 mt-1">Unggah dokumen Capstone</p>
                                    </div>
                                </a>                                                                                           
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Terbaru -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-lg font-semibold text-gray-900">Peminjaman Terbaru</h2>
                                <div class="flex space-x-4">
                                    <a href="{{ route('member.loans.index') }}" 
                                    class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline">
                                        Pinjaman Aktif
                                    </a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('member.loans.history') }}" 
                                    class="text-sm font-medium text-blue-600 hover:text-blue-700 hover:underline">
                                        Riwayat Peminjaman
                                    </a>
                                </div>
                            </div>

                            @php
                                $now = now();
                                // Get active loans (not returned) and sort by newest first
                                $activeLoans = $allLoans
                                    ->filter(function($loan) {
                                        return !$loan->return_date;
                                    })
                                    ->sortByDesc('loan_date');

                                // Get returned loans and sort by return date
                                $returnedLoans = $allLoans
                                    ->filter(function($loan) {
                                        return $loan->return_date;
                                    })
                                    ->sortByDesc('return_date');

                                // Combine active loans first, then returned loans, and take 3
                                $displayLoans = $activeLoans->merge($returnedLoans)->take(3);
                                
                                // Check if there are more loans than what we're displaying
                                $hasMoreLoans = $allLoans->count() > 3;
                            @endphp

                            @if($displayLoans->isNotEmpty())
                                <div class="grid gap-4">
                                    @foreach($displayLoans as $loan)
                                        @php
                                            $dueDate = Carbon\Carbon::parse($loan->due_date);
                                            $isOverdue = $dueDate->isPast() && !$loan->return_date;
                                            $daysRemaining = $now->diffInDays($dueDate, false);
                                        @endphp
                                        <div class="group flex bg-white rounded-xl border border-gray-200 hover:border-blue-300 hover:shadow-lg transition-all duration-200 p-5">
                                            <!-- Book Thumbnail -->
                                            <div class="w-28 h-36 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden shadow-sm">
                                                @if ($loan->book->thumbnail)
                                                    <img src="{{ Storage::url($loan->book->thumbnail) }}"
                                                        alt="{{ Str::title($loan->book->judul) }}"
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Book Info -->
                                            <div class="ml-6 flex-grow">
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">{{ Str::title($loan->book->judul) }}</h4>
                                                        <p class="text-sm text-gray-500 mt-1">{{ Str::title($loan->book->penulis) }}</p>
                                                    </div>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $loan->status['class'] }}">
                                                        {{ Str::title($loan->status['label']) }}
                                                    </span>
                                                </div>

                                                <div class="text-sm mt-1">
                                                    @if($loan->return_date)
                                                        <div class="text-green-600">
                                                            Sudah dikembalikan pada {{ Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                                                        </div>
                                                    @else
                                                        @php
                                                            $now = now();
                                                            $dueDate = Carbon\Carbon::parse($loan->due_date);
                                                            $isOverdue = $dueDate < $now;
                                                            $isDueSoon = !$isOverdue && $dueDate <= $now->addDays(3);
                                                            $daysRemaining = $now->diffInDays($dueDate, false);
                                                        @endphp
                                                        
                                                        @if($isOverdue)
                                                            <div class="text-red-600">
                                                                Terlambat {{ abs($daysRemaining) }} hari
                                                            </div>
                                                        @elseif($isDueSoon)
                                                            <div class="text-yellow-600">
                                                                {{ $daysRemaining }} hari tersisa (Segera Jatuh Tempo)
                                                            </div>
                                                        @else
                                                            <div class="text-blue-600">
                                                                {{ $daysRemaining }} hari tersisa
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($allLoans->count() > 3)
                                        <div class="text-center pt-4">
                                            <a href="{{ route('member.loans.history') }}" 
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                                Lihat Semua Riwayat Peminjaman
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
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