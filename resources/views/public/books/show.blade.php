<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:flex">
                <!-- Book Image Section - Fixed Portrait Format -->
                <div class="md:w-1/4 p-6">
                    <div class="relative aspect-[3/4] rounded-lg overflow-hidden bg-gray-100 shadow-sm">
                        @if ($bookReference->thumbnail && Storage::exists('public/' . $bookReference->thumbnail))
                            <img src="{{ asset('storage/' . $bookReference->thumbnail) }}" 
                                 alt="{{ $bookReference->judul }}" 
                                 class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                <div class="w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-gray-200">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                              d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 font-medium text-center px-4">
                                    {{ Str::limit($bookReference->judul, 30) }}
                                </p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Availability Badge -->
                    <div class="mt-4 text-center">
                        <div class="inline-flex items-center px-3 py-1 rounded-full {{ $stockInfo->available_stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            <span class="text-sm font-medium">{{ $stockInfo->available_stock }} dari {{ $stockInfo->total_copies }} tersedia</span>
                        </div>
                    </div>
                </div>

                <!-- Book Details Section -->
                <div class="md:w-3/4 p-6 md:border-l border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $bookReference->judul }}</h1>
                    <p class="text-lg text-gray-600 mt-1">{{ $bookReference->penulis }}</p>

                    <dl class="mt-6 space-y-4">
                        <div class="flex">
                            <dt class="w-32 font-medium text-gray-500">ISBN</dt>
                            <dd class="text-gray-900">{{ $bookReference->isbn }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="w-32 font-medium text-gray-500">Penerbit</dt>
                            <dd class="text-gray-900">{{ $bookReference->penerbit }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="w-32 font-medium text-gray-500">Peminatan</dt>
                            <dd class="text-gray-900">{{ $bookReference->peminatan }}</dd>
                        </div>
                        <div class="flex">
                            <dt class="w-32 font-medium text-gray-500">Sub Peminatan</dt>
                            <dd class="text-gray-900">{{ $bookReference->sub_peminatan }}</dd>
                        </div>
                    </dl>

                    @if($bookReference->synopsis)
                        <div class="mt-6">
                            <h2 class="text-lg font-medium text-gray-900">Sinopsis</h2>
                            <p class="mt-2 text-gray-600 leading-relaxed">{{ $bookReference->synopsis }}</p>
                        </div>
                    @endif

                    @if($activeLoans->isNotEmpty())
                        <div class="mt-6 p-4 bg-yellow-50 rounded-lg">
                            <h2 class="text-sm font-medium text-yellow-800">Status Peminjaman</h2>
                            <div class="mt-2 space-y-1">
                                @foreach($activeLoans as $loan)
                                    <div class="flex items-center space-x-2 text-sm">
                                        <span class="text-yellow-700">Dipinjam oleh:</span>
                                        <span class="font-medium text-yellow-900">{{ $loan->user->name }}</span>
                                        @if($loan->return_date)
                                            <span class="text-yellow-700">(Tenggat: {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }})</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    

                    <div class="mt-8">
                        <div class="flex space-x-4">
                            <!-- Existing back button -->
                            <a href="{{ route('public.books.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Daftar Buku
                            </a>

                            <!-- Borrow Button -->
                            <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $stockInfo->available_stock > 0 ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-400 cursor-not-allowed' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" {{ $stockInfo->available_stock == 0 ? 'disabled' : '' }}>
                                @auth
                                    @if (auth()->user()->role_id == 1)
                                        <a href={{ route('member.loans.borrowForm', $bookReference->isbn) }}>Pinjam Buku</a>
                                    @else
                                        <span>Hanya Member yang Bisa Meminjam Buku</span>
                                    @endif
                                @else
                                    <a href={{route('login')}}>Harap Login untuk Meminjam Buku</a>
                                @endauth
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>