<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Perpanjangan Peminjaman Buku',
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
                <div class="md:w-1/2 p-8 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">{{ Str::title('Informasi Buku') }}</h2>
                    
                    <div class="flex items-start space-x-6">
                        <!-- Book Image -->
                        <div class="flex-shrink-0">
                            <div class="relative aspect-[3/4] w-40 rounded-lg overflow-hidden bg-white shadow">
                                @if ($loan->book->thumbnail && Storage::exists('public/' . $loan->book->thumbnail))
                                    <img src="{{ asset('storage/' . $loan->book->thumbnail) }}" 
                                        alt="{{ Str::title($loan->book->judul) }}" 
                                        class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Book Information -->
                        <div class="flex-1">
                            <dl class="space-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ Str::title('Judul') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ Str::title($loan->book->judul) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ Str::title('Penulis') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ Str::title($loan->book->penulis) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $loan->book->isbn }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ Str::title('Kode Unik') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $loan->kode_unik_buku }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Loan Period Information -->
                    <div class="mt-8 p-4 bg-white rounded-lg border border-gray-200">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">{{ Str::title('Periode Peminjaman') }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ Str::title('Tanggal Peminjaman') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">{{ Str::title('Tenggat Saat Ini') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($loan->due_date)->format('d M Y H:i') }}</dd>
                            </div>
                            <div class="col-span-2">
                                <dt class="text-sm font-medium text-gray-500">{{ Str::title('Tenggat Setelah Perpanjangan') }}</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-semibold">
                                    {{ \Carbon\Carbon::parse($loan->due_date)->addDays(7)->format('d M Y H:i') }}
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Authentication Section -->
                <div class="md:w-1/2 p-8 bg-white">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">{{ Str::title('Konfirmasi Perpanjangan') }}</h2>

                    <!-- Renewal Rules -->
                    <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-100">
                        <h3 class="text-sm font-medium text-blue-900 mb-3">{{ Str::title('Aturan Perpanjangan') }}:</h3>
                        <ul class="space-y-2 text-sm text-blue-800">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Perpanjangan hanya dapat dilakukan 1 kali
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Durasi perpanjangan 7 hari dari tenggat waktu saat ini
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Perpanjangan hanya dapat dilakukan sebelum tenggat waktu
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pastikan buku dalam kondisi baik sebelum perpanjangan
                            </li>
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
                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                    id="terms" 
                                    name="terms" 
                                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                    required>
                            </div>
                            <label for="terms" class="text-sm text-gray-700">
                                Saya menyetujui semua aturan perpanjangan di atas
                            </label>
                        </div>

                        <button type="submit" 
                            id="submitButton"
                            disabled
                            class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ Str::title('Konfirmasi Perpanjangan') }}
                        </button>
                    </form>
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