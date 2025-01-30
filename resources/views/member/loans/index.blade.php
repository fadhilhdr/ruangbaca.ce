<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Peminjaman Buku Aktif',
        ])
    
        @if($loans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                @foreach($loans as $loan)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                        <!-- Deadline Banner -->
                        @php
                            $daysLeft = \Carbon\Carbon::now()->diffInDays($loan->due_date, false);
                            $bannerColor = $daysLeft < 0 ? 'bg-red-500' : ($daysLeft <= 3 ? 'bg-yellow-500' : 'bg-green-500');
                        @endphp
                        <div class="{{ $bannerColor }} text-white px-4 py-2 text-center font-semibold">
                            @if($daysLeft < 0)
                                Terlambat {{ abs($daysLeft) }} hari
                            @else
                                {{ $daysLeft }} hari tersisa
                            @endif
                        </div>

                        <div class="p-4">
                            <!-- Book Image and Basic Info -->
                            <div class="flex gap-4">
                                <div class="w-32 h-40 flex-shrink-0 bg-gray-100 rounded-md overflow-hidden">
                                    @if ($loan->book->thumbnail)
                                        <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                             alt="{{ $loan->book->judul }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold text-lg mb-1 text-gray-800">{{ $loan->book->judul }}</h3>
                                    <p class="text-sm text-gray-600 mb-1">{{ $loan->book->penulis }}</p>
                                    <p class="text-xs text-gray-500">ISBN: {{ $loan->book->isbn }}</p>
                                </div>
                            </div>

                            <!-- Loan Details -->
                            <div class="mt-4 space-y-2 border-t pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Tanggal Pinjam:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Jatuh Tempo:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</span>
                                </div>
                                @if($loan->renewal_count > 0)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">Perpanjangan:</span>
                                        <span class="font-medium">{{ $loan->renewal_count }}x</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('member.loans.show', $loan->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $loans->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <p class="text-gray-600">Tidak ada peminjaman aktif saat ini.</p>
                <a href="{{ route('public.books.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                    Pinjam buku sekarang
                </a>
            </div>
        @endif
    </div>
</x-app-layout>