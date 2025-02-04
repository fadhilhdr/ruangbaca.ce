<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Kelola Tugas Akhir',
        ])

        {{-- Error Notification --}}
        @if(session('error'))
            <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Peringatan!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Success Notification --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Progress Indicator -->
                <div class="mb-8">
                    <div class="relative">
                        <div class="flex items-center justify-center mb-4">
                            <span class="text-sm font-medium text-blue-600">Update dokumen tugas akhir Anda</span>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-100">
                            <div id="progress-bar" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500"></div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('member.tugasakhirs.update', $tugasakhir->id) }}" 
                      enctype="multipart/form-data" class="space-y-6" id="upload-form">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info Section -->
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    Judul Tugas Akhir
                                    <span id="title-length-indicator" class="text-xs text-gray-500 ml-2">0/255</span>
                                </label>
                                <textarea 
                                    name="title" 
                                    id="title" 
                                    required
                                    class="mt-1 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm h-20 resize-y @error('title') border-red-500 @enderror"
                                    placeholder="Masukkan judul tugas akhir Anda (maks. 255 karakter)">{{ old('title', $tugasakhir->title) }}</textarea>
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Dokumen Tugas Akhir</h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                @php
                                    $fields = [
                                        'full_document' => [
                                            'label' => 'Dokumen Lengkap Laporan Tugas Akhir',
                                            'desc' => 'Upload dokumen tugas akhir lengkap dalam format PDF',
                                            'maxSize' => '15 MB'
                                        ],
                                        'cover_abstract' => [
                                            'label' => 'Cover hingga Abstrak',
                                            'desc' => 'Upload dokumen cover hingga abstrak tugas akhir dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                        'bab1_pendahuluan' => [
                                            'label' => 'BAB I - Pendahuluan',
                                            'desc' => 'Upload dokumen tugas akhir bab 1  dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                        'bab2_kajianpustaka' => [
                                            'label' => 'BAB II - Kajian Pustaka',
                                            'desc' => 'Upload dokumen tugas akhir bab 2  dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                        'bab3_perancangan' => [
                                            'label' => 'BAB III - Perancangan',
                                            'desc' => 'Upload dokumen tugas akhir bab 3  dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                        'bab4_hasilpembahasan' => [
                                            'label' => 'BAB IV - Hasil dan Pembahasan',
                                            'desc' => 'Upload dokumen tugas akhir bab 4  dalam format PDF',
                                            'maxSize' => '10 MB'
                                        ],
                                        'bab5_penutup' => [
                                            'label' => 'BAB V - Penutup',
                                            'desc' => 'Upload dokumen tugas akhir bab 5  dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                        'lampiran' => [
                                            'label' => 'Lampiran',
                                            'desc' => 'Upload dokumen lampiran tugas akhir dalam format PDF',
                                            'maxSize' => '5 MB'
                                        ],
                                    ];
                                @endphp

                                @foreach($fields as $field => $info)
                                    <div class="relative">
                                        <div class="p-4 bg-gray-50 rounded-lg border hover:border-blue-400 transition-colors duration-200 @error($field) border-red-500 @enderror">
                                            <label class="block">
                                                <span class="text-sm font-medium text-gray-900">{{ $info['label'] }}</span>
                                                <span class="block text-xs text-gray-500 mb-2">
                                                    {{ $info['desc'] }} 
                                                    <span class="text-blue-600">(Maks. {{ $info['maxSize'] }})</span>
                                                </span>

                                                @if($tugasakhir->$field)
                                                    <div class="flex items-center mt-2 mb-3 text-sm">
                                                        <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <a href="{{ Storage::url($tugasakhir->$field) }}" 
                                                           target="_blank"
                                                           class="text-blue-600 hover:underline">
                                                            {{ pathinfo($tugasakhir->$field, PATHINFO_FILENAME) }}.{{ pathinfo($tugasakhir->$field, PATHINFO_EXTENSION) }}
                                                        </a>
                                                    </div>
                                                @endif

                                                <input type="file" 
                                                       name="{{ $field }}" 
                                                       accept="application/pdf"
                                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                       onchange="updateProgress()">
                                                
                                                <p class="mt-1 text-xs text-gray-500">
                                                    Biarkan kosong jika tidak ingin mengubah file
                                                </p>
                                            </label>
                                            @error($field)
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('member.tugasakhirs.show', $tugasakhir->id) }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kembali
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Update Tugas Akhir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Memisahkan fungsi penghitung karakter
        function updateTitleCount() {
            const titleTextarea = document.getElementById('title');
            const lengthIndicator = document.getElementById('title-length-indicator');
            const maxLength = 255;
            const currentLength = titleTextarea.value.length;
    
            if (lengthIndicator) {
                lengthIndicator.textContent = `${currentLength}/${maxLength}`;
                
                // Ubah warna indikator jika mendekati batas
                if (currentLength >= maxLength - 50) {
                    lengthIndicator.classList.add('text-yellow-600');
                } else {
                    lengthIndicator.classList.remove('text-yellow-600');
                }
            }
        }
    
        // Fungsi untuk validasi file dan progress
        function updateProgress() {
            const form = document.getElementById('upload-form');
            const inputs = form.querySelectorAll('input[type="file"]');
            const totalInputs = inputs.length;
            let filledInputs = 0;
    
            const fieldLabels = {
                'full_document': 'Dokumen Lengkap Laporan Tugas Akhir',
                'cover_abstract': 'Dokumen Cover hingga Abstrak',
                'bab1_pendahuluan': 'Dokumen BAB 1 - Pendahuluan',
                'bab2_kajianpustaka': 'Dokumen BAB 2 - Kajian Pustaka',
                'bab3_perancangan': 'Dokumen BAB 3 - Perancangan',
                'bab4_hasilpembahasan': 'Dokumen BAB 4 - Hasil dan Pembahasan',
                'bab5_penutup': 'Dokumen BAB 5 - Penutup',
                'lampiran': 'Dokumen Lampiran'
            };
    
            const maxSizeMB = {
                'full_document': 15,
                'cover_abstract': 5,
                'bab1_pendahuluan': 5,
                'bab2_kajianpustaka': 5,
                'bab3_perancangan': 5,
                'bab4_hasilpembahasan': 10,
                'bab5_penutup': 5,
                'lampiran': 10
            };
    
            inputs.forEach(input => {
                if (input.files.length > 0) {
                    const fileSizeMB = input.files[0].size / 1024 / 1024;
                    const label = fieldLabels[input.name] || input.name;
                    
                    if (fileSizeMB <= maxSizeMB[input.name]) {
                        filledInputs++;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ukuran File Terlalu Besar',
                            html: `
                                <b>${label}</b> yang Anda unggah melebihi batas maksimum.<br>
                                Batas maksimum: <span class="text-red-600">${maxSizeMB[input.name]} MB</span><br>
                                Ukuran file Anda: <span class="text-red-600">${fileSizeMB.toFixed(2)} MB</span>
                            `,
                            confirmButtonText: 'Pilih File Lain',
                            confirmButtonColor: '#3085d6',
                        });
                        input.value = '';
                    }
                }
            });
    
            const progressBar = document.getElementById('progress-bar');
            const progress = (filledInputs / totalInputs) * 100;
            progressBar.style.width = progress + '%';
        }
    
        // Event Listeners
        document.addEventListener('DOMContentLoaded', function() {
            const titleTextarea = document.getElementById('title');
            const maxLength = 255;
            let isAlertShown = false;
    
            // Set initial character count
            updateTitleCount();
    
            // Add input event listener
            titleTextarea?.addEventListener('input', function() {
                updateTitleCount();
                
                const currentLength = this.value.length;
                
                // Show alert if exceeds max length
                if (currentLength > maxLength && !isAlertShown) {
                    isAlertShown = true;
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'Judul Terlalu Panjang',
                        html: `
                            Judul tugas akhir maksimal <b>${maxLength} karakter</b>.<br>
                            Saat ini: <span class="text-red-600">${currentLength} karakter</span><br>
                            Mohon kurangi <span class="text-red-600">${currentLength - maxLength} karakter</span> lagi.
                        `,
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        isAlertShown = false;
                    });
                }
            });
    
            // Form submission validation
            const form = document.getElementById('upload-form');
            form?.addEventListener('submit', function(e) {
                const currentLength = titleTextarea.value.length;
                
                if (currentLength > maxLength) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Dapat Dikirim',
                        html: `
                            Judul masih melebihi batas maksimal ${maxLength} karakter.<br>
                            Mohon kurangi panjang judul sebelum mengirim form.
                        `,
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#3085d6'
                    });
                }
            });
    
            // Initial progress calculation
            updateProgress();
        });
    </script>
    @endpush
</x-app-layout>