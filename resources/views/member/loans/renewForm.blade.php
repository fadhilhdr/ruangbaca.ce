<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Peminjaman Buku',
        ])
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

            <div class="md:flex">
                <!-- Book Details Section -->
                <div class="md:w-1/2 p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-6">Perpanjangan Peminjaman</h1>
                    
                    <!-- Book Image -->
                    <div class="mb-6">
                        <div class="relative aspect-[3/4] w-48 rounded-lg overflow-hidden bg-gray-100 shadow-sm">
                            @if ($loan->book->thumbnail && Storage::exists('public/' . $loan->book->thumbnail))
                                <img src="{{ asset('storage/' . $loan->book->thumbnail) }}" 
                                     alt="{{ $loan->book->judul }}" 
                                     class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                    <div class="w-16 h-16 mb-2 flex items-center justify-center rounded-full bg-gray-200">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                  d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
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

                        <!-- Timestamps -->
                        <div class="mt-6 space-y-3">
                            <div>
                                <dt class="font-medium text-gray-500">Tanggal Peminjaman</dt>
                                <dd class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Tenggat Saat Ini</dt>
                                <dd class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500">Tenggat Setelah Perpanjangan</dt>
                                <dd class="mt-1 text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($loan->due_date)->addDays(7)->format('d M Y H:i') }}
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Authentication Section -->
                <div class="md:w-1/2 p-6 md:border-l border-gray-200">
                    <div class="space-y-6">
                        <!-- Renewal Rules -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Aturan Perpanjangan:</h3>
                            <ul class="list-disc list-inside space-y-1 text-gray-600">
                                <li>Perpanjangan hanya dapat dilakukan 1 kali</li>
                                <li>Durasi perpanjangan 7 hari dari tenggat waktu saat ini</li>
                                <li>Perpanjangan hanya dapat dilakukan sebelum tenggat waktu</li>
                                <li>Pastikan buku dalam kondisi baik sebelum perpanjangan</li>
                            </ul>
                        </div>

                        <!-- Confirmation Form -->
                        <form id="renewForm" action="{{ route('member.loans.renew', $loan->id) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Barcode Scanner Section -->
                            <div>
                                <label for="kode_unik_buku" class="block text-sm font-medium text-gray-700">
                                    Konfirmasi Kode Unik Buku
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
                                        Saya menyetujui semua aturan perpanjangan di atas
                                    </label>
                                </div>
                            </div>

                            <button type="submit" 
                                    id="submitButton"
                                    disabled
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                Konfirmasi Perpanjangan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('renewForm');
            const kodeUnikInput = document.getElementById('kode_unik_buku');
            const termsCheckbox = document.getElementById('terms');
            const submitButton = document.getElementById('submitButton');
            const kodeUnikStatus = document.getElementById('kodeUnikStatus');
            
            let isKodeUnikValid = false;
            let scanBuffer = '';
            let scanTimeout;
    
            // Function to check if form can be submitted
            function updateSubmitButton() {
                submitButton.disabled = !(isKodeUnikValid && termsCheckbox.checked);
            }
    
            // Validate kode unik
            async function validateKodeUnik(kodeUnik) {
                try {
                    const response = await fetch(`/api/validate-renew-kode-unik/${kodeUnik}/${@json($loan->id)}`);
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
    
            // Handle barcode scanner input
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
    
            // Focus input field automatically
            kodeUnikInput.focus();
    
            // Prevent form submission on Enter
            kodeUnikInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
    
            // Keep focus on input field
            document.addEventListener('click', function() {
                kodeUnikInput.focus();
            });
    
            termsCheckbox.addEventListener('change', updateSubmitButton);
        });
    </script>
    @endpush
</x-app-layout>