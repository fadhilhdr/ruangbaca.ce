<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Kembalikan Buku</h2>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded p-6">
            <h3 class="text-xl font-semibold mb-4">Detail Peminjaman</h3>

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

            <p><strong>Buku:</strong> {{ $loan->book->title }}</p>
            <p><strong>Nama Pemegang:</strong> {{ $loan->user->name }}</p>
            <p><strong>Tanggal Peminjaman:</strong> {{ \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') }}</p>
            <p><strong>Tanggal Jatuh Tempo:</strong> {{ \Carbon\Carbon::parse($loan->due_date)->format('d/m/Y') }}</p>

            @php
                // Menghitung selisih hari antara tanggal saat ini dan tanggal jatuh tempo
                $today = now();
                $lateDays = $today->gt($loan->due_date) ? $today->diffInDays($loan->due_date) : 0; // Hitung keterlambatan jika tanggal sekarang lebih besar dari tanggal jatuh tempo
                $fineAmount = $lateDays > 0 ? $lateDays * 1000 : 0; // Hitung denda berdasarkan keterlambatan
            @endphp

            <div class="mt-4">
                <h4 class="text-lg font-semibold">Status Pengembalian</h4>
                @if($lateDays > 0)
                    <p class="text-red-500">Buku terlambat {{ $lateDays }} hari. Denda yang harus dibayar: IDR {{ number_format($fineAmount, 0, ',', '.') }}</p>
                    <p>Harap bayar denda terlebih dahulu untuk bisa mengembalikan buku.</p>
                @else
                    <p class="text-green-500">Buku masih dalam batas waktu pengembalian.</p>
                @endif
            </div>


            <form action="{{ route('member.loans.return', $loan->id) }}" method="POST" class="mt-6">
                @csrf
                <div class="flex items-center">
                    <input type="checkbox" name="confirm_return" id="confirm_return" class="mr-2" required>
                    <label for="confirm_return">Saya telah memeriksa dan ingin mengembalikan buku.</label>
                </div>

                <div class="mt-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700" 
                        @if($fineAmount > 0) disabled @endif>
                        Kembalikan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
