<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Peminjaman Aktif</h1>
    
        @if($loans->count() > 0)
            <div class="grid grid-cols-1 gap-4">
                @foreach($loans as $loan)
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between items-start">   
                            <!-- Book Thumbnail -->
                            <div class="w-48 h-64 bg-gray-200 rounded-md flex items-center justify-center overflow-hidden">
                                @if ($loan->book->thumbnail && Storage::exists('public/' . $loan->book->thumbnail))
                                    <img src="{{ asset('storage/' . $loan->book->thumbnail) }}" alt="{{ $loan->book->title }}" class="object-cover w-full h-full">
                                @else
                                    <!-- Placeholder if no thumbnail exists -->
                                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                @endif
                            </div>                                                      
                            <div>
                                <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $loan->book->title }}</h2>
                                <p class="text-sm text-gray-600 mb-2"><strong>Penulis:</strong> {{ $loan->book->author }}</p>
                                <p class="text-sm text-gray-600 mb-2"><strong>ISBN:</strong> {{ $loan->book->isbn }}</p>
                                <p class="text-sm text-gray-600 mb-2"><strong>Spesialisasi:</strong> {{ $loan->book->specialization->name ?? 'Tidak Ada' }}</p>
                                <p class="text-sm text-gray-600 mb-2"><strong>Sinopsis:</strong> {{ $loan->book->synopsis }}</p>

                                <p class="text-gray-600">
                                    Dipinjam: {{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}
                                </p>
                                <p class="text-gray-600">
                                    Jatuh Tempo: {{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('member.loans.show', $loan->id) }}" 
                                   class="text-blue-600 hover:text-blue-800">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-4">
                {{ $loans->links() }}
            </div>
        @else
            <p class="text-gray-600">Tidak ada peminjaman aktif.</p>
        @endif
    </div>
</x-app-layout>
