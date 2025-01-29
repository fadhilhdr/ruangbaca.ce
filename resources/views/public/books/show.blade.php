<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Detail Buku',
        ])
        
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:flex">
                <!-- Book Image Section -->
                <div class="md:w-1/3 p-8 flex flex-col items-center">
                    <div class="relative aspect-[3/4] w-full max-w-sm rounded-lg overflow-hidden bg-gray-100 shadow">
                        @if ($bookReference->thumbnail && Storage::exists('public/' . $bookReference->thumbnail))
                            <img src="{{ asset('storage/' . $bookReference->thumbnail) }}" 
                                 alt="{{ Str::title($bookReference->judul )}}" 
                                 class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                <div class="w-20 h-20 mb-4 flex items-center justify-center rounded-full bg-gray-200">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Availability Status -->
                    <div class="mt-6 text-center">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-base font-medium {{ $stockInfo->available_stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            @if($stockInfo->available_stock > 0)
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @else
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @endif
                            {{ $stockInfo->available_stock }} dari {{ $stockInfo->total_copies }} buku tersedia
                        </span>
                    </div>

                    <!-- Borrow Button -->
                    <div class="mt-6">
                        <button class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg text-base font-medium text-white {{ $stockInfo->available_stock > 0 ? 'bg-blue-600 hover:bg-blue-700' : 'bg-gray-400 cursor-not-allowed' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors" {{ $stockInfo->available_stock == 0 ? 'disabled' : '' }}>
                            @auth
                                @if (auth()->user()->role_id == 1)
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    <a href={{ route('member.loans.borrowForm', $bookReference->isbn) }}>Pinjam Sekarang</a>
                                @else
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Khusus untuk Member</span>
                                @endif
                            @else
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                <a href={{route('login')}}>Login untuk Meminjam</a>
                            @endauth
                        </button>
                    </div>
                </div>

                <!-- Book Details Section -->
                <div class="md:w-2/3 p-8 md:border-l border-gray-200">
                    <h1 class="text-3xl font-bold text-gray-900 leading-tight">{{ Str::title($bookReference->judul)  }}</h1>
                    <p class="text-xl text-gray-600 mt-2">oleh {{ Str::title($bookReference->penulis )}}</p>

                    <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                            <dd class="text-base text-gray-900">{{ $bookReference->isbn }}</dd>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                            <dd class="text-base text-gray-900">{{ $bookReference->penerbit }}</dd>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-medium text-gray-500">Peminatan</dt>
                            <dd class="text-base text-gray-900">{{ $bookReference->peminatan }}</dd>
                        </div>
                        <div class="space-y-1">
                            <dt class="text-sm font-medium text-gray-500">Sub Peminatan</dt>
                            <dd class="text-base text-gray-900">{{ $bookReference->sub_peminatan }}</dd>
                        </div>
                    </dl>

                    @if($bookReference->synopsis)
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Tentang Buku</h2>
                            <p class="text-gray-600 leading-relaxed">{{ $bookReference->synopsis }}</p>
                        </div>
                    @endif

                    @if($activeLoans->isNotEmpty())
                        <div class="mt-8 p-4 bg-amber-50 rounded-lg border border-amber-200">
                            <h2 class="text-lg font-semibold text-amber-900 mb-3">Status Peminjaman Aktif</h2>
                            <div class="space-y-3">
                                @foreach($activeLoans as $loan)
                                    <div class="flex items-center space-x-3 text-sm">
                                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span class="text-amber-700">Dipinjam oleh</span>
                                        <span class="font-medium text-amber-900">{{ $loan->user->name }}</span>
                                        @if($loan->return_date)
                                            <span class="text-amber-700">hingga {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>