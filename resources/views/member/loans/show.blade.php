<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Detail Peminjaman Buku</h1>

        <!-- Book Detail Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex gap-6">
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

                <!-- Book Information -->
                <div class="flex-1">
                    <h2 class="text-2xl font-semibold mb-2 text-gray-800">{{ $loan->book->title }}</h2>
                    <p class="text-sm text-gray-600 mb-2"><strong>Penulis:</strong> {{ $loan->book->author }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>ISBN:</strong> {{ $loan->book->isbn }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>Spesialisasi:</strong> {{ $loan->book->specialization->name ?? 'Tidak Ada' }}</p>
                    <p class="text-sm text-gray-600 mb-2"><strong>Sinopsis:</strong> {{ $loan->book->synopsis }}</p>
                    <p class="text-sm text-gray-600 mb-4"><strong>Status Peminjaman:</strong> @if ($isLate) <span class="text-red-500">Terlambat</span> @else <span class="text-green-500">On Time</span> @endif </p>
                    <p class="text-sm text-gray-600 mb-2"><strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}</p>
                    <p class="text-sm text-gray-600 mb-4"><strong>Tanggal Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($loan->due_date)->format('d-m-Y') }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4">
                @if($isLate)
                    <p class="text-red-600 font-semibold">Terlambat! Harap bayar denda terlebih dahulu.</p>
                @else
                    <div class="flex gap-4">
                        {{-- <!-- Renewal Button -->
                        <form action="{{ route('member.loans.renew', $loan->id) }}" method="POST" class="w-1/2">
                            @csrf
                            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600" @if(!$canRenew) disabled @endif>
                                Perpanjang Peminjaman
                            </button>
                        </form> --}}

                        <!-- Return Button -->
                        <form action="{{ route('member.loans.returnForm', $loan->id) }}" method="GET" class="w-1/2">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $loan->book_id }}">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Kembalikan Buku
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
