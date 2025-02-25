<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Pencatatan Kunjungan RBC Teknik Komputer',
        ])

        {{-- Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-7 gap-8">
            <!-- Form Section (1/4 width) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-8 sticky top-4 border-2 border-blue-500">
                    <!-- Header Section -->
                    <div class="mb-6 border-b border-gray-200 pb-4">
                        <h2 class="text-xl font-bold text-gray-800 mb-2">Form Pengunjung</h2>
                        <h3 class="text-lg font-semibold text-blue-600">Check-In & Check-Out</h3>
                    </div>
            
                    <!-- Form Section -->
                    <form action="{{ route('visitor.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-6">
                            <!-- Identifier Field -->
                            <div>
                                <label for="identifier" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        id="identifier"
                                        name="identifier"
                                        value="{{ old('identifier') }}"
                                        required
                                        autocomplete="off"
                                        data-scanner-input
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200"
                                        placeholder="Masukkan identitas Anda">
                                </div>
                                <p class="mt-2 text-sm text-gray-500 italic">*Dari Teknik Komputer? Masukan NIM/NIP</p>
                            </div>
            
                            <!-- Instansi Field -->
                            <div>
                                <label for="instansi" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Instansi
                                </label>
                                <div class="relative">
                                    <input type="text"
                                        id="instansi"
                                        name="instansi"
                                        value="{{ old('instansi') }}"
                                        autocomplete="off"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-colors duration-200"
                                        placeholder="Nama instansi">
                                </div>
                                <p class="mt-2 text-sm text-gray-500 italic">*Wajib diisi jika NIM/NIP tidak terdaftar</p>
                            </div>
                        </div>
            
                        <!-- Submit Button -->
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-0.5 hover:shadow-lg flex items-center justify-center gap-3 mt-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                            </svg>
                            <span>Enter</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table Section (3/4 width) -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">Daftar Pengunjung Hari Ini</h2>
                                <p class="text-sm text-gray-500 mt-1">Menampilkan data kunjungan per {{ now()->format('d/m/Y') }}</p>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg px-4 py-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
                                    <p class="text-sm font-medium text-gray-700">
                                        Pengunjung Saat Ini 
                                        <span class="ml-1 text-lg font-bold text-blue-600">
                                            {{ App\Models\Visitor::whereNull('check_out_at')->count() }}
                                        </span>
                                        <span class="text-sm font-normal text-gray-700">orang</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Instansi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                        Check In
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                        Check Out
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($todayVisitors as $index => $visitor)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $todayVisitors->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $visitor->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $visitor->instansi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center gap-1">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                {{ \Carbon\Carbon::parse($visitor->check_in_at)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($visitor->check_out_at)
                                                <div class="flex items-center gap-1">
                                                    <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                                    {{ \Carbon\Carbon::parse($visitor->check_out_at)->format('H:i') }}
                                                </div>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Belum checkout
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p>Belum ada pengunjung hari ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t">
                        {{ $todayVisitors->links() }}
                    </div>
                </div>
            </div>
        </div>
        <script>
        // Global state to track manual input mode
        let isManualInputMode = false;

        // Function to handle identifier field focus
        const focusIdentifierField = () => {
            const identifierField = document.getElementById('identifier');
            const instansiField = document.getElementById('instansi');
            
            // Don't force focus if user is in manual input mode
            if (isManualInputMode) {
                return;
            }
            
            // Don't force focus if user is actively typing in instansi field
            if (document.activeElement === instansiField) {
                return;
            }
            
            if (identifierField && document.activeElement !== identifierField) {
                identifierField.focus();
                identifierField.select();
            }
        };

        // Initialize SweetAlert configuration
        const SwalConfig = Swal.mixin({
            customClass: {
                popup: 'animated zoomIn'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });

        // Handle error case when NIM/NIP not found
        const handleNotFoundError = () => {
            SwalConfig.fire({
                icon: 'warning',
                title: 'NIM/NIP tidak ditemukan',
                text: 'Silakan isi nama dan instansi secara manual',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6'
            }).then(() => {
                isManualInputMode = true; // Enable manual input mode
                const instansiField = document.getElementById('instansi');
                if (instansiField) {
                    instansiField.focus();
                }
            });
        };

        // Event Listeners
        document.addEventListener('DOMContentLoaded', () => {
            const identifierField = document.getElementById('identifier');
            const instansiField = document.getElementById('instansi');
            
            // Initial focus
            focusIdentifierField();
            
            // Handle identifier field events
            identifierField.addEventListener('blur', (e) => {
                if (!isManualInputMode) {
                    setTimeout(focusIdentifierField, 100);
                }
            });
            
            // Reset manual mode when identifier field is cleared
            identifierField.addEventListener('input', (e) => {
                if (e.target.value === '') {
                    isManualInputMode = false;
                }
            });
            
            // Handle instansi field focus
            instansiField.addEventListener('focus', () => {
                if (identifierField.value && !isManualInputMode) {
                    // Check if this focus was triggered by tab or click
                    // If NIM/NIP wasn't found, we'll keep manual mode
                    isManualInputMode = true;
                }
            });
        });

        // Handle success messages
        @if(session('success'))
            SwalConfig.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                isManualInputMode = false; // Reset to scanner mode after success
                focusIdentifierField();
            });
        @endif

        // Handle error messages
        @if(session('error'))
            handleNotFoundError();
        @endif

        // Modified interval check
        setInterval(() => {
            if (!isManualInputMode && document.activeElement.id !== 'identifier') {
                focusIdentifierField();
            }
        }, 500);

        // Add manual input mode toggle button (optional)
        const toggleManualMode = () => {
            isManualInputMode = !isManualInputMode;
            if (isManualInputMode) {
                document.getElementById('instansi').focus();
            } else {
                focusIdentifierField();
            }
        };
        </script>  
    </div>
</x-app-layout>