<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Navigation -->
            <div class="mb-6">
                <a href="{{ route('member.loans.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Peminjaman
                </a>
            </div>

            <!-- Main Content -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Status Banner -->
                @php
                    $daysLeft = \Carbon\Carbon::now()->diffInDays($loan->due_date, false);
                    $bannerColor = $daysLeft < 0 ? 'bg-red-500' : ($daysLeft <= 3 ? 'bg-yellow-500' : 'bg-green-500');
                    $statusText = $daysLeft < 0 
                        ? 'Terlambat ' . abs($daysLeft) . ' hari'
                        : $daysLeft . ' hari tersisa';
                @endphp
                <div class="{{ $bannerColor }} text-white px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h1 class="text-xl font-bold">Detail Peminjaman</h1>
                        <span class="px-4 py-2 {{ $bannerColor }} font-semibold">
                            {{ $statusText }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Book Details -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Book Image -->
                        <div class="w-full md:w-1/3">
                            <div class="aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden">
                                @if ($loan->book->thumbnail)
                                    <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                         alt="{{ $loan->book->judul }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Book Information -->
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $loan->book->judul }}</h2>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-sm text-gray-600">Penulis</p>
                                    <p class="font-medium">{{ $loan->book->penulis }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">ISBN</p>
                                    <p class="font-medium">{{ $loan->book->isbn }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Peminatan</p>
                                    <p class="font-medium">{{ $loan->book->peminatan }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Sub Peminatan</p>
                                    <p class="font-medium">{{ $loan->book->sub_peminatan }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Kode Unik</p>
                                    <p class="font-medium">{{ $loan->kode_unik_buku }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Status Perpanjangan</p>
                                    <p class="font-medium">{{ $loan->renewal_count }}/1 kali</p>
                                </div>
                            </div>

                            <!-- Loan Timeline -->
                            <div class="space-y-4 mb-6">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600">Tanggal Peminjaman</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full {{ $bannerColor }} flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm text-gray-600">Tenggat Waktu</p>
                                        <p class="font-medium">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Transaction History -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3">Riwayat Transaksi</h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    @forelse($loan->transactions as $transaction)
                                        <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                                            <span class="text-sm">
                                                {{ $transaction->type?->type_name ?? 'Unknown Transaction' }}
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500">Belum ada riwayat transaksi</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                @if($loan->canRenew())
                                    <form action="{{ route('member.loans.renewForm', $loan->id) }}" method="GET" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            Perpanjang Peminjaman
                                        </button>
                                    </form>
                                @endif

                                @if($loan->canReturn())
                                    <form action="{{ route('member.loans.returnForm', $loan->id) }}" method="GET" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-200">
                                            Kembalikan Buku
                                        </button>
                                    </form>
                                @endif

                                <!-- Report Lost Book -->
                                <button onclick="showLostBookModal()" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-200">
                                    Laporkan Hilang
                                </button>
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
            <form action="{{ route('member.loans.replacementForm', $loan->id) }}" method="POST">
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