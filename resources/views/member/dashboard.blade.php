<!-- resources/views/member/dashboard.blade.php -->
<x-app-layout>
    <style>
        /* Menghilangkan scrollbar di semua browser */
        .no-scrollbar::-webkit-scrollbar {
            display: none; /* Untuk Chrome, Safari */
        }
    
        .no-scrollbar {
            -ms-overflow-style: none;  /* Untuk Internet Explorer */
            scrollbar-width: none;     /* Untuk Firefox */
        }
    </style>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm mb-8">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('member.loans.index') }}" 
                        class="flex items-center p-4 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="ml-3 font-medium text-gray-600 group-hover:text-blue-700">Daftar Peminjaman</span>
                        </a>

                        <a href="{{ route('member.loans.history') }}"
                        class="flex items-center p-4 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-3 font-medium text-gray-600 group-hover:text-blue-700">Riwayat Peminjaman</span>
                        </a>

                        <a href="{{ route('public.books.index') }}"
                        class="flex items-center p-4 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="ml-3 font-medium text-gray-600 group-hover:text-blue-700">Cari Buku</span>
                        </a>

                        <a href="#"
                        class="flex items-center p-4 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-colors group">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-3 font-medium text-gray-600 group-hover:text-blue-700">Bantuan</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 font-semibold">Active Loans</div>
                        <div class="text-3xl font-bold">{{ $activeLoanCount }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 font-semibold">Late Returns</div>
                        <div class="text-3xl font-bold {{ $lateLoanCount > 0 ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $lateLoanCount }}
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-gray-900 font-semibold">Remaining Loan Quota</div>
                        <div class="text-3xl font-bold">{{ $remainingQuota }}</div>
                    </div>
                </div>
            </div>

            <!-- Active Loans Cards -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Recent Active Loans</h3>
                    @if($allLoans->isNotEmpty())
                        <div class="relative">
                            <!-- Scrollable container -->
                            <div class="overflow-x-auto flex space-x-4 pb-4 -mx-2 px-2 no-scrollbar">
                                @foreach($allLoans as $loan)
                                    <!-- Individual Card -->
                                    <div class="flex-shrink-0 w-72 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                                        <div class="flex p-4">
                                            <!-- Thumbnail -->
                                            <div class="w-20 h-28 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                                @if ($loan->book->thumbnail)
                                                    <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                                        alt="{{ $loan->book->judul }}" 
                                                        class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Book Info -->
                                            <div class="ml-4 flex flex-col flex-grow">
                                                <h4 class="font-medium text-gray-900 mb-1 line-clamp-2">{{ $loan->book->judul }}</h4>
                                                
                                                <div class="mt-auto space-y-2">
                                                    <!-- Due Date -->
                                                    <div class="flex items-center text-sm">
                                                        <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        <span class="text-gray-600">{{ Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</span>
                                                    </div>
                                                    
                                                    <!-- Status Badge -->
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $loan->status['class'] }}">
                                                        {{ $loan->status['label'] }}
                                                    </span>
                                                    
                                                    <!-- View Details Link -->
                                                    <a href="{{ route('member.loans.show', $loan->id) }}" 
                                                    class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                                                        View Details
                                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Empty State -->
                            @if($allLoans->isEmpty())
                                <div class="text-center py-8">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No active loans</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by borrowing a book from our collection.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>