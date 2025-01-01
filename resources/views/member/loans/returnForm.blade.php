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

                        <!-- Return Form -->
                        <form id="returnForm" action="{{ route('member.loans.return', $loan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <input type="hidden" name="isLate" value="{{ $isLate }}">
                            
                            <!-- Barcode Scanner Section -->
                            <div>
                                <label for="kode_unik_buku" class="block text-sm font-medium text-gray-700">
                                    Kode Unik Buku
                                </label>
                                <div class="mt-1 flex space-x-2">
                                    <input type="text" 
                                           name="kode_unik_buku" 
                                           id="kode_unik_buku"
                                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                           required
                                           placeholder="Scan atau masukkan kode unik buku">
                                </div>
                                <div id="kodeUnikStatus" class="mt-2 text-sm"></div>
                            </div>

                            <!-- Fine Payment Section (shown if late) -->
                            @if($isLate)
                                <div id="fineSection" class="border rounded-lg p-4 bg-red-50">
                                    <h4 class="font-medium text-red-800 mb-2">Informasi Denda</h4>
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <p class="text-red-600">Keterlambatan: {{ $daysLate }} hari</p>
                                            <p class="text-red-600 font-medium">Total Denda: Rp{{ number_format($fineAmount, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- QRIS Code -->
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 mb-2">Scan QRIS untuk pembayaran:</p>
                                        <div class="bg-white p-4 rounded-lg mb-4">
                                            <img src="{{ asset('images/dummy-qris.png') }}" 
                                                 alt="QRIS Code" 
                                                 class="w-48 h-48 mx-auto">
                                        </div>
                                    </div>

                                    <!-- Upload Bukti Transfer -->
                                    <div class="mt-4">
                                        <label for="bukti_tf" class="block text-sm font-medium text-gray-700">
                                            Upload Bukti Transfer
                                        </label>
                                        <input type="file"
                                               id="bukti_tf"
                                               name="bukti_tf"
                                               accept="image/*"
                                               required
                                               class="mt-1 block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-medium
                                                      file:bg-blue-50 file:text-blue-700
                                                      hover:file:bg-blue-100">
                                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG (Max. 2MB)</p>
                                        @error('bukti_tf')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif

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
                                        Saya menyatakan buku dalam kondisi baik dan {{ $isLate ? 'telah membayar denda keterlambatan' : 'akan mengembalikan tepat waktu' }}
                                    </label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-4">
                                <button type="button" 
                                        onclick="showLostBookModal()"
                                        class="flex-1 py-2 px-4 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Laporkan Buku Hilang
                                </button>

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

    <!-- Lost Book Modal -->
    <div id="lostBookModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-bold mb-4">Konfirmasi Laporan Buku Hilang</h3>
            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin melaporkan buku ini hilang? 
                Anda akan dikenakan biaya penggantian sesuai dengan kebijakan perpustakaan.
            </p>
            <div class="flex justify-end gap-4">
                <button type="button" 
                        onclick="hideLostBookModal()" 
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                    Batal
                </button>
                <form action="#" method="POST">
                    @csrf
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Konfirmasi
                    </button>
                </form>
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
            const buktiTfInput = document.getElementById('bukti_tf');
            
            let isKodeUnikValid = false;
            let scanTimeout;

            // Function to check if form can be submitted
            function updateSubmitButton() {
                const isLate = @json($isLate);
                const hasBuktiTf = isLate ? buktiTfInput && buktiTfInput.files.length > 0 : true;
                submitButton.disabled = !(isKodeUnikValid && termsCheckbox.checked && hasBuktiTf);
            }

            // Validate kode unik
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

            // Handle input events
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

            // Handle file upload
            if (buktiTfInput) {
                buktiTfInput.addEventListener('change', () => {
                    const file = buktiTfInput.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file maksimal 2MB');
                            buktiTfInput.value = '';
                        } else if (!['image/jpeg', 'image/png'].includes(file.type)) {
                            alert('Format file harus JPG atau PNG');
                            buktiTfInput.value = '';
                        }
                    }
                    updateSubmitButton();
                });
            }

            // Modal functions
            window.showLostBookModal = function() {
                document.getElementById('lostBookModal').classList.remove('hidden');
                document.getElementById('lostBookModal').classList.add('flex');
            }

            window.hideLostBookModal = function() {
                document.getElementById('lostBookModal').classList.add('hidden');
                document.getElementById('lostBookModal').classList.remove('flex');
            }

            termsCheckbox.addEventListener('change', updateSubmitButton);
            
            // Auto-focus barcode input
            kodeUnikInput.focus();
            document.addEventListener('click', () => kodeUnikInput.focus());
        });
    </script>
    @endpush
</x-app-layout>