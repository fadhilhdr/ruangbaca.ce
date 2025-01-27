<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Capstone Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('member.capstones.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Informasi Dasar -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kode_kelompok">
                                        Kode Kelompok <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="kode_kelompok" id="kode_kelompok" 
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kode_kelompok') border-red-500 @enderror"
                                            value="{{ old('kode_kelompok') }}" 
                                            pattern="S[1-2]T\d{2}K\d{2}"
                                            maxlength="8"
                                            required>
                                        <div id="kode_status" class="absolute right-2 top-2 hidden">
                                            <!-- Loading spinner -->
                                            <svg class="animate-spin h-5 w-5 text-gray-500 loading-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <!-- Success icon -->
                                            <svg class="h-5 w-5 text-green-500 success-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <!-- Error icon -->
                                            <svg class="h-5 w-5 text-red-500 error-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p id="kode_message" class="text-sm italic mt-1 hidden"></p>
                                    <p class="text-xs text-gray-500 mt-1">Format: S[1-2]T[Tahun]K[Nomor] (Contoh: S2T24K13)</p>
                                    @error('kode_kelompok')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="kategori">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select name="kategori" id="kategori" 
                                        class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kategori') border-red-500 @enderror"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="SI" {{ old('kategori') == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="Jaringan" {{ old('kategori') == 'Jaringan' ? 'selected' : '' }}>Jaringan</option>
                                        <option value="Embedded" {{ old('kategori') == 'Embedded' ? 'selected' : '' }}>Embedded</option>
                                        <option value="Game" {{ old('kategori') == 'Game' ? 'selected' : '' }}>Game</option>
                                    </select>
                                    @error('kategori')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="judul_capstone">
                                    Judul Capstone <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="judul_capstone" id="judul_capstone" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('judul_capstone') border-red-500 @enderror"
                                    value="{{ old('judul_capstone') }}" required>
                                @error('judul_capstone')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Anggota Kelompok -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Anggota Kelompok</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        NIM Anggota 1 (Anda)
                                    </label>
                                    <input type="text" value="{{ auth()->user()->userid }}" 
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-500 bg-gray-100"
                                        disabled>
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="anggota2_nim">
                                        NIM Anggota 2
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="anggota2_nim" id="anggota2_nim" 
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('anggota2_nim') border-red-500 @enderror"
                                            value="{{ old('anggota2_nim') }}">
                                        <div id="anggota2_status" class="absolute right-2 top-2 hidden">
                                            <!-- Loading spinner -->
                                            <svg class="animate-spin h-5 w-5 text-gray-500 loading-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <!-- Success icon -->
                                            <svg class="h-5 w-5 text-green-500 success-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <!-- Error icon -->
                                            <svg class="h-5 w-5 text-red-500 error-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p id="anggota2_message" class="text-sm italic mt-1 hidden"></p>
                                    @error('anggota2_nim')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Ulangi struktur yang sama untuk anggota3_nim -->
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="anggota3_nim">
                                        NIM Anggota 3
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="anggota3_nim" id="anggota3_nim" 
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('anggota3_nim') border-red-500 @enderror"
                                            value="{{ old('anggota3_nim') }}">
                                        <div id="anggota3_status" class="absolute right-2 top-2 hidden">
                                            <!-- Loading spinner -->
                                            <svg class="animate-spin h-5 w-5 text-gray-500 loading-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <!-- Success icon -->
                                            <svg class="h-5 w-5 text-green-500 success-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <!-- Error icon -->
                                            <svg class="h-5 w-5 text-red-500 error-icon hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p id="anggota3_message" class="text-sm italic mt-1 hidden"></p>
                                    @error('anggota3_nim')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Dokumen -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Upload Dokumen</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="c100">
                                        Dokumen C100
                                    </label>
                                    <input type="file" name="c100" id="c100" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                        accept="application/pdf">
                                    @error('c100')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="c200">
                                        Dokumen C200
                                    </label>
                                    <input type="file" name="c200" id="c200" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                        accept="application/pdf">
                                    @error('c200')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="c300">
                                        Dokumen C300
                                    </label>
                                    <input type="file" name="c300" id="c300" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                        accept="application/pdf">
                                    @error('c300')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="c400">
                                        Dokumen C400
                                    </label>
                                    <input type="file" name="c400" id="c400" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                        accept="application/pdf">
                                    @error('c400')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="c500">
                                        Dokumen C500
                                    </label>
                                    <input type="file" name="c500" id="c500" 
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                        accept="application/pdf">
                                    @error('c500')
                                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">
                                Simpan Capstone
                            </button>
                            <a href="{{ route('member.capstones.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded">
                                Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let checkTimeout = null;
        
        function checkNim(nimInput, statusId, messageId) {
            const nim = nimInput.value.trim();
            const statusEl = document.getElementById(statusId);
            const messageEl = document.getElementById(messageId);
            
            // Reset status
            statusEl.querySelectorAll('svg').forEach(icon => icon.classList.add('hidden'));
            messageEl.classList.add('hidden');
            
            if (nim === '') {
                statusEl.classList.add('hidden');
                return;
            }
        
            // Show loading
            statusEl.classList.remove('hidden');
            statusEl.querySelector('.loading-icon').classList.remove('hidden');
        
            clearTimeout(checkTimeout);
            checkTimeout = setTimeout(() => {
                fetch(`/api/check-nim/${nim}`)
                    .then(response => response.json())
                    .then(data => {
                        statusEl.querySelectorAll('svg').forEach(icon => icon.classList.add('hidden'));
                        messageEl.classList.remove('hidden');
        
                        if (data.exists && !data.inTeam) {
                            statusEl.querySelector('.success-icon').classList.remove('hidden');
                            messageEl.textContent = 'NIM valid';
                            messageEl.classList.remove('text-red-500');
                            messageEl.classList.add('text-green-500');
                        } else if (data.exists && data.inTeam) {
                            statusEl.querySelector('.error-icon').classList.remove('hidden');
                            messageEl.textContent = 'NIM sudah terdaftar dalam tim lain';
                            messageEl.classList.remove('text-green-500');
                            messageEl.classList.add('text-red-500');
                        } else {
                            statusEl.querySelector('.error-icon').classList.remove('hidden');
                            messageEl.textContent = 'NIM tidak ditemukan';
                            messageEl.classList.remove('text-green-500');
                            messageEl.classList.add('text-red-500');
                        }
                    })
                    .catch(error => {
                        statusEl.querySelectorAll('svg').forEach(icon => icon.classList.add('hidden'));
                        statusEl.querySelector('.error-icon').classList.remove('hidden');
                        messageEl.textContent = 'Terjadi kesalahan';
                        messageEl.classList.remove('text-green-500');
                        messageEl.classList.add('text-red-500');
                        messageEl.classList.remove('hidden');
                    });
            }, 500);
        }
        
        // Add event listeners
        document.getElementById('anggota2_nim').addEventListener('input', function() {
            checkNim(this, 'anggota2_status', 'anggota2_message');
        });
        
        document.getElementById('anggota3_nim').addEventListener('input', function() {
            checkNim(this, 'anggota3_status', 'anggota3_message');
        });

        function validateKodeKelompok(input) {
            const kode = input.value.trim().toUpperCase();
            const statusEl = document.getElementById('kode_status');
            const messageEl = document.getElementById('kode_message');
            const pattern = /^S[1-2]T\d{2}K\d{2}$/;
            
            input.value = kode; // Convert to uppercase automatically
            
            if (kode === '') {
                statusEl.classList.add('hidden');
                messageEl.classList.add('hidden');
                return;
            }

            if (!pattern.test(kode)) {
                statusEl.classList.remove('hidden');
                statusEl.querySelector('.error-icon').classList.remove('hidden');
                messageEl.textContent = 'Format kode kelompok tidak valid';
                messageEl.classList.remove('hidden');
                messageEl.classList.add('text-red-500');
                return;
            }

            // Show loading
            statusEl.classList.remove('hidden');
            statusEl.querySelector('.loading-icon').classList.remove('hidden');

            // Check if code exists
            fetch(`/api/check-kode/${kode}`)
                .then(response => response.json())
                .then(data => {
                    statusEl.querySelectorAll('svg').forEach(icon => icon.classList.add('hidden'));
                    
                    if (data.exists) {
                        statusEl.querySelector('.error-icon').classList.remove('hidden');
                        messageEl.textContent = 'Kode kelompok sudah digunakan';
                        messageEl.classList.add('text-red-500');
                    } else {
                        statusEl.querySelector('.success-icon').classList.remove('hidden');
                        messageEl.textContent = 'Kode kelompok tersedia';
                        messageEl.classList.add('text-green-500');
                    }
                    messageEl.classList.remove('hidden');
                });
        }

        document.getElementById('kode_kelompok').addEventListener('input', function() {
            validateKodeKelompok(this);
        });
        </script>
</x-app-layout>