<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Detail Peminjaman Buku',
        ])

            <!-- Main Content -->
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Status Banner -->
                    @php
                        $daysLeft = \Carbon\Carbon::now()->diffInDays($loan->due_date, false);
                        $bannerColor = $daysLeft < 0 ? 'bg-red-500' : ($daysLeft <= 3 ? 'bg-yellow-500' : 'bg-green-500');
                        $statusText = $daysLeft < 0 
                            ? 'Terlambat ' . abs($daysLeft) . ' hari'
                            : $daysLeft . ' hari tersisa';
                    @endphp
                    <div class="{{ $bannerColor }} text-white px-8 py-6">
                        <div class="flex justify-between items-center">
                            <h1 class="text-2xl font-bold">Detail Peminjaman</h1>
                            <span class="px-6 py-2 rounded-full bg-white/20 backdrop-blur-sm font-semibold">
                                {{ $statusText }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8">
                        <!-- Book Details -->
                        <div class="flex flex-col lg:flex-row gap-8">
                            <!-- Book Image -->
                            <div class="lg:w-1/4">
                                <div class="aspect-[3/4] bg-gray-100 rounded-xl overflow-hidden shadow-md">
                                    @if ($loan->book->thumbnail)
                                        <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                            alt="{{ $loan->book->judul }}" 
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Book Information -->
                            <div class="flex-1 space-y-8">
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ Str::title($loan->book->judul) }}</h2>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="space-y-4">
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-sm text-gray-600 mb-1">Penulis</p>
                                                <p class="font-medium">{{ Str::title($loan->book->penulis) }}</p>
                                            </div>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-sm text-gray-600 mb-1">ISBN</p>
                                                <p class="font-medium">{{ $loan->book->isbn }}</p>
                                            </div>
                                        </div>
                                        <div class="space-y-4">
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-sm text-gray-600 mb-1">Peminatan</p>
                                                <p class="font-medium">{{ $loan->book->peminatan }}</p>
                                            </div>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-sm text-gray-600 mb-1">Sub Peminatan</p>
                                                <p class="font-medium">{{ $loan->book->sub_peminatan }}</p>
                                            </div>
                                            <div class="bg-gray-50 p-4 rounded-lg">
                                                <p class="text-sm text-gray-600 mb-1">Status Perpanjangan</p>
                                                <p class="font-medium">{{ $loan->renewal_count }}/1 kali</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Loan Timeline -->
                                <div class="bg-white rounded-xl border border-gray-100 p-6 space-y-6">
                                    <h3 class="text-lg font-semibold mb-4">Timeline Peminjaman</h3>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm text-gray-600">Tanggal Peminjaman</p>
                                            <p class="font-medium">{{ \Carbon\Carbon::parse($loan->loan_date)->translatedFormat('l, d M Y H:i') }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full {{ $bannerColor }} flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm text-gray-600">Tenggat Waktu</p>
                                            <p class="font-medium">{{ \Carbon\Carbon::parse($loan->due_date)->translatedFormat('l, d M Y H:i') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Transaction History -->
                                <div class="bg-white rounded-xl border border-gray-100 p-6">
                                    <h3 class="text-lg font-semibold mb-4">Riwayat Transaksi</h3>
                                    <div class="space-y-3">
                                        @forelse($loan->transactions as $transaction)
                                            <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                                <span class="font-medium">
                                                    {{ $transaction->type?->type_name ?? 'Unknown Transaction' }}
                                                </span>
                                                <span class="text-sm text-gray-500">{{ $transaction->created_at->translatedFormat('l, d M Y H:i') }}</span>
                                            </div>
                                        @empty
                                            <p class="text-sm text-gray-500 text-center py-4">Belum ada riwayat transaksi</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                    @if($loan->canRenew())
                                        <form action="{{ route('member.loans.renewForm', $loan->id) }}" method="GET" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                                Perpanjang Peminjaman
                                            </button>
                                        </form>
                                    @endif

                                    @if($loan->canReturn())
                                        <form action="{{ route('member.loans.returnForm', $loan->id) }}" method="GET" class="flex-1">
                                            @csrf
                                            <button type="submit" class="w-full bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition-colors duration-200 font-medium flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Kembalikan Buku
                                            </button>
                                        </form>
                                    @endif

                                    @if($loan->isReturned())
                                        <button onclick="showLostBookModal()" 
                                                class="flex-1 bg-red-600 text-white px-6 py-3 rounded-xl hover:bg-red-700 transition-colors duration-200 font-medium flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Laporkan Hilang
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lost Book Modal -->
    <div id="lostBookModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-bold mb-4">Konfirmasi Laporan Buku Hilang</h3>
            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin melaporkan buku ini hilang? 
                Anda akan dikenakan biaya penggantian sesuai dengan kebijakan perpustakaan.
            </p>
            <form action="{{ route('member.loans.replacementForm', $loan->id) }}">
                @csrf
                <div class="flex justify-end gap-4">
                    <button type="button" onclick="hideLostBookModal()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showLostBookModal() {
            document.getElementById('lostBookModal').classList.remove('hidden');
            document.getElementById('lostBookModal').classList.add('flex');
        }

        function hideLostBookModal() {
            document.getElementById('lostBookModal').classList.add('hidden');
            document.getElementById('lostBookModal').classList.remove('flex');
        }
    </script>
</x-app-layout>