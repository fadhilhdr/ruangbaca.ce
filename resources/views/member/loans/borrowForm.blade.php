<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Peminjaman Buku',
        ])

        <!-- Main Content Container -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Account Status Banner - Shown when account is suspended -->
            @if($hasActiveLostBook)
                <div class="bg-red-50 border-b border-red-100 p-6">
                    <div class="max-w-3xl mx-auto flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-medium text-red-800">Akun Anda Ditangguhkan</h3>
                            <p class="mt-2 text-sm text-red-700">Anda memiliki kasus kehilangan buku yang belum terselesaikan. Untuk mengaktifkan kembali akun Anda:</p>
                            <ul class="mt-4 space-y-2 text-sm text-red-700">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Silahkan selesaikan proses penggantian buku terlebih dahulu
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                    Hubungi petugas perpustakaan untuk informasi lebih lanjut
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Alert Messages -->
            @if (session('success') || session('error'))
                <div class="max-w-3xl mx-auto px-6 pt-6">
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Main Content Grid -->
            <div class="max-w-7xl mx-auto">
                <div class="md:grid md:grid-cols-2 md:divide-x md:divide-gray-200">
                    <!-- Book Details Section -->
                    <div class="p-6 lg:p-8 @if($hasActiveLostBook) opacity-50 @endif">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">{{ Str::title('Informasi Buku') }}</h2>
                        
                        <div class="flex flex-col sm:flex-row sm:space-x-6">
                            <!-- Book Image -->
                            <div class="flex-shrink-0 mb-4 sm:mb-0">
                                <div class="relative aspect-[3/4] w-full sm:w-48 rounded-lg overflow-hidden bg-white shadow">
                                    @if ($bookReference->thumbnail && Storage::exists('public/' . $bookReference->thumbnail))
                                        <img src="{{ asset('storage/' . $bookReference->thumbnail) }}" 
                                             alt="{{ Str::title($bookReference->judul) }}" 
                                             class="absolute inset-0 w-full h-full object-cover">
                                    @else
                                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50">
                                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Book Information -->
                            <div class="flex-1">
                                <dl class="divide-y divide-gray-200">
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">{{ Str::title('Judul') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ Str::title($bookReference->judul) }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">{{ Str::title('Penulis') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ Str::title($bookReference->penulis) }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">ISBN</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $bookReference->isbn }}</dd>
                                    </div>
                                    <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                                        <dt class="text-sm font-medium text-gray-500">{{ Str::title('Penerbit') }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ Str::title($bookReference->penerbit) }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Loan Period Information -->
                        <div class="mt-8 bg-gray-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-3">{{ Str::title('Periode Peminjaman') }}</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ Str::title('Tanggal Peminjaman') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">{{ Str::title('Tenggat Pengembalian') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::now()->addDays(14)->translatedFormat('l, d M Y H:i') }}</dd>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Borrowing Form Section -->
                    <div class="p-6 lg:p-8 @if($hasActiveLostBook) opacity-50 pointer-events-none @endif">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">{{ Str::title('Konfirmasi Peminjaman') }}</h2>

                        <!-- Borrowing Rules -->
                        <div class="mb-8 bg-blue-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-blue-900 mb-3">{{ Str::title('Aturan Peminjaman') }}:</h3>
                            <ul class="space-y-3">
                                <li class="flex items-start text-sm text-blue-800">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Peminjaman maksimal 2 buku</span>
                                </li>
                                <li class="flex items-start text-sm text-blue-800">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Durasi peminjaman 2 minggu (dapat diperpanjang 1x)</span>
                                </li>
                                <li class="flex items-start text-sm text-blue-800">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Denda keterlambatan: Rp1.000/hari</span>
                                </li>
                                <li class="flex items-start text-sm text-blue-800">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Buku hilang wajib diganti dengan buku yang sama</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Confirmation Form -->
                        <form id="borrowForm" action="{{ route('member.loans.borrow', $bookReference->isbn) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Barcode Scanner Section -->
                            <div>
                                <label for="kode_unik_buku" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kode Unik Buku
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <input type="password" 
                                           name="kode_unik_buku" 
                                           id="kode_unik_buku"
                                           class="block w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm disabled:bg-gray-50 disabled:text-gray-500"
                                           required
                                           placeholder="@if($hasActiveLostBook)Peminjaman tidak tersedia - Akun ditangguhkan @else Scan untuk masukkan kode unik buku @endif"
                                           @if($hasActiveLostBook) disabled @endif>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div id="kodeUnikStatus" class="mt-2 text-sm min-h-[20px]"></div>
                            </div>

                            <!-- Terms Checkbox with Enhanced Styling -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="relative flex items-start">
                                    <div class="flex h-6 items-center">
                                        <input type="checkbox" 
                                               id="terms" 
                                               name="terms" 
                                               class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                               required
                                               @if($hasActiveLostBook) disabled @endif>
                                    </div>
                                    <div class="ml-3">
                                        <label for="terms" class="text-sm text-gray-700">
                                            Saya menyetujui semua aturan peminjaman di atas
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button with Loading State -->
                            <button type="submit" 
                                    id="submitButton"
                                    disabled
                                    class="w-full flex justify-center items-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>{{ Str::title('Konfirmasi Peminjaman') }}</span>
                                </span>
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
            const form = document.getElementById('borrowForm');
            const kodeUnikInput = document.getElementById('kode_unik_buku');
            const termsCheckbox = document.getElementById('terms');
            const submitButton = document.getElementById('submitButton');
            const kodeUnikStatus = document.getElementById('kodeUnikStatus');
            
            let isKodeUnikValid = false;
            let scanTimeout;

            // Update submit button state
            function updateSubmitButton() {
                if (isKodeUnikValid && termsCheckbox.checked) {
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50');
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.add('opacity-50');
                }
            }

            // Validate kode unik with enhanced feedback
            async function validateKodeUnik(kodeUnik) {
                try {
                    kodeUnikStatus.innerHTML = `
                        <div class="flex items-center text-gray-500">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memvalidasi kode...
                        </div>
                    `;

                    const response = await fetch(`/api/validate-kode-unik/${kodeUnik}/${@json($bookReference->isbn)}`);
                    const data = await response.json();
                    
                    isKodeUnikValid = data.valid;
                    const statusClass = data.valid ? 'text-green-600' : 'text-red-600';
                    const iconPath = data.valid 
                        ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
                        : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';

                    kodeUnikStatus.innerHTML = `
                        <div class="flex items-center ${statusClass}">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${iconPath}"/>
                            </svg>
                            ${data.message}
                        </div>
                    `;
                    
                    updateSubmitButton();
                } catch (error) {
                    console.error('Error:', error);
                    kodeUnikStatus.innerHTML = `
                        <div class="flex items-center text-red-600">
                            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Terjadi kesalahan validasi
                        </div>
                    `;
                    isKodeUnikValid = false;
                    updateSubmitButton();
                }
            }

            // Handle barcode scanner input with debounce
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
                }, 300);
            });

            // Prevent form submission on Enter
            kodeUnikInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });

            // Keep focus on input field
            if (!@json($hasActiveLostBook)) {
                kodeUnikInput.focus();
                document.addEventListener('click', function() {
                    kodeUnikInput.focus();
                });
            }

            termsCheckbox.addEventListener('change', updateSubmitButton);

            // Loading state for form submission
            form.addEventListener('submit', function() {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;
            });
        });
    </script>
    @endpush
</x-app-layout>