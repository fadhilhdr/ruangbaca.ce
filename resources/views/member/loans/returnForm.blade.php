<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Navigation -->
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('member.loans.show', $loan->id) }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Detail Peminjaman
                </a>
            </div>

            <div class="md:flex">
                <!-- Book Details Section -->
                <div class="md:w-1/2 p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pengembalian Buku</h1>
                    
                    <!-- Book Image -->
                    <div class="mb-6">
                        <div class="relative aspect-[3/4] w-48 rounded-lg overflow-hidden bg-gray-100 shadow-sm">
                            @if ($loan->book->thumbnail)
                                <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                     alt="{{ $loan->book->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                    <div class="w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-gray-200">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Book Information -->
                    <div class="space-y-4">
                        <dl class="grid grid-cols-1 gap-3">
                            <div>
                                <dt class="font-medium text-gray-500">Judul</dt>
                                <dd class="mt-1 text-gray-900">{{ $loan->book->judul }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Penulis</dt>
                                <dd class="mt-1 text-gray-900">{{ $loan->book->penulis }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">ISBN</dt>
                                <dd class="mt-1 text-gray-900">{{ $loan->book->isbn }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Kode Unik</dt>
                                <dd class="mt-1 text-gray-900">{{ $loan->kode_unik_buku }}</dd>
                            </div>
                        </dl>


                    </div>
                </div>

                <!-- Return Form Section -->
                <div class="md:w-1/2 p-6 md:border-l border-gray-200">
                    <div class="space-y-6">
                        <!-- Return Rules -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Informasi Pengembalian:</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-600">
                                <li>Pastikan buku dalam kondisi baik sebelum pengembalian</li>
                                <li>Denda keterlambatan: Rp1.000/hari</li>
                                <li>Pembayaran denda melalui QRIS</li>
                                <li>Upload bukti pembayaran untuk verifikasi</li>
                            </ul>
                        </div>                        
                        <!-- Loan Timeline -->
                        <div class="mt-6 space-y-4">
                            <!-- Loan Date -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Tanggal Peminjaman</p>
                                    <p class="font-medium">{{ Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</p>
                                </div>
                            </div>
                            <!-- Due Date -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full {{ $isLate ? 'bg-red-500' : 'bg-green-500' }} flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-600">Tenggat Pengembalian</p>
                                    <p class="font-medium">{{ Carbon\Carbon::parse($loan->due_date)->format('d M Y') }}</p>
                                    @if($isLate)
                                        <p class="text-red-600 text-sm">Terlambat {{ $daysLate }} hari</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Additional Actions -->
                        @if($isLate)
                            <div class="mb-6">
                                <p class="text-red-600 font-medium mb-2">Denda Keterlambatan: Rp {{ number_format($fineAmount, 0, ',', '.') }}</p>
                                <a href="{{ route('member.loans.paymentForm', $loan->id) }}" 
                                   class="inline-block w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Upload Bukti Pembayaran Denda
                                </a>
                            </div>
                        @endif

                        <!-- Return Form -->
                        <form id="returnForm" action="{{ route('member.loans.return', $loan->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="isLate" value="{{ $isLate }}">
                            
                            <!-- Barcode Scanner Section -->
                            <div>
                                <label for="kode_unik_buku" class="block text-sm font-medium text-gray-700">
                                    Kode Unik Buku
                                </label>
                                <div class="mt-1">
                                    <input type="text" 
                                           name="kode_unik_buku" 
                                           id="kode_unik_buku"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                           required
                                           placeholder="Scan atau masukkan kode unik buku">
                                </div>
                                <div id="kodeUnikStatus" class="mt-2 text-sm"></div>
                            </div>

                            <!-- Terms Checkbox -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" 
                                           id="terms" 
                                           name="terms" 
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           required>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms" class="font-medium text-gray-700">
                                        Saya menyatakan buku dalam kondisi baik
                                    </label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <a href="{{ route('member.loans.replacementForm', $loan->id) }}"
                                   class="flex-1 py-2 px-4 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-center">
                                    Laporkan Buku Hilang
                                </a>

                                <button type="submit" 
                                        id="submitButton"
                                        disabled
                                        class="flex-1 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Konfirmasi Pengembalian
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('returnForm');
            const kodeUnikInput = document.getElementById('kode_unik_buku');
            const termsCheckbox = document.getElementById('terms');
            const submitButton = document.getElementById('submitButton');
            const kodeUnikStatus = document.getElementById('kodeUnikStatus');
            let isKodeUnikValid = false;
            let scanTimeout;

            function updateSubmitButton() {
                submitButton.disabled = !(isKodeUnikValid && termsCheckbox.checked);
            }

            async function validateKodeUnik(kodeUnik) {
                try {
                    const response = await fetch(`/api/validate-return-kode-unik/${kodeUnik}/${@json($loan->id)}`);
                    const data = await response.json();
                    
                    isKodeUnikValid = data.valid;
                    kodeUnikStatus.textContent = data.message;
                    kodeUnikStatus.className = `mt-2 text-sm ${data.valid ? 'text-green-600' : 'text-red-600'}`;
                    
                    updateSubmitButton();
                } catch (error) {
                    console.error('Error:', error);
                    kodeUnikStatus.textContent = 'Terjadi kesalahan validasi';
                    kodeUnikStatus.className = 'mt-2 text-sm text-red-600';
                    isKodeUnikValid = false;
                    updateSubmitButton();
                }
            }

            kodeUnikInput.addEventListener('input', (e) => {
                clearTimeout(scanTimeout);
                scanTimeout = setTimeout(() => {
                    if (e.target.value.length >= 5) {
                        validateKodeUnik(e.target.value);
                    } else {
                        isKodeUnikValid = false;
                        kodeUnikStatus.textContent = '';
                        updateSubmitButton();
                    }
                }, 100);
            });

            termsCheckbox.addEventListener('change', updateSubmitButton);
            
            // Auto-focus barcode input
            kodeUnikInput.focus();
            document.addEventListener('click', () => kodeUnikInput.focus());
        });
    </script>
    @endpush
</x-app-layout>