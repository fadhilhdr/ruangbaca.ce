<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Unggah Tugas Akhir',
        ])
        
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Progress Indicator -->
                <div class="mb-8">
                    <div class="relative">
                        <div class="flex items-center justify-center mb-4">
                            <span class="text-sm font-medium text-blue-600">Lengkapi dokumen tugas akhir Anda</span>
                        </div>
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-blue-100">
                            <div id="progress-bar" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 w-0 transition-all duration-500"></div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('member.tugasakhirs.store') }}" method="POST" enctype="multipart/form-data" 
                      class="space-y-6" id="upload-form">
                    @csrf
                    
                    <!-- Basic Info Section -->
                    <div class="bg-white rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas Akhir</label>
                                <input type="text" name="title" id="title" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                       value="{{ old('title') }}"
                                       placeholder="Masukkan judul tugas akhir Anda">
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
                                            'label' => 'Dokumen Lengkap',
                                            'desc' => 'Upload dokumen tugas akhir lengkap dalam format PDF'
                                        ],
                                        'cover_abstract' => [
                                            'label' => 'Cover dan Abstrak',
                                            'desc' => 'Halaman cover dan abstrak tugas akhir'
                                        ],
                                        'bab1_pendahuluan' => [
                                            'label' => 'BAB 1 - Pendahuluan',
                                            'desc' => 'Latar belakang, rumusan masalah, dan tujuan'
                                        ],
                                        'bab2_kajianpustaka' => [
                                            'label' => 'BAB 2 - Kajian Pustaka',
                                            'desc' => 'Tinjauan pustaka dan landasan teori'
                                        ],
                                        'bab3_perancangan' => [
                                            'label' => 'BAB 3 - Perancangan',
                                            'desc' => 'Metodologi dan perancangan sistem'
                                        ],
                                        'bab4_hasilpembahasan' => [
                                            'label' => 'BAB 4 - Hasil dan Pembahasan',
                                            'desc' => 'Hasil penelitian dan pembahasan'
                                        ],
                                        'bab5_penutup' => [
                                            'label' => 'BAB 5 - Penutup',
                                            'desc' => 'Kesimpulan dan saran'
                                        ],
                                        'lampiran' => [
                                            'label' => 'Lampiran',
                                            'desc' => 'Dokumen pendukung lainnya'
                                        ]
                                    ];
                                @endphp

                                @foreach($fields as $field => $info)
                                    <div class="relative">
                                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-blue-400 transition-colors duration-200">
                                            <label class="block">
                                                <span class="text-sm font-medium text-gray-900">{{ $info['label'] }}</span>
                                                <span class="block text-xs text-gray-500 mb-2">{{ $info['desc'] }}</span>
                                                <input type="file" 
                                                       name="{{ $field }}" 
                                                       required
                                                       accept="application/pdf"
                                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                                       onchange="updateProgress()">
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            Upload Tugas Akhir
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateProgress() {
            const form = document.getElementById('upload-form');
            const inputs = form.querySelectorAll('input[type="file"]');
            const totalInputs = inputs.length;
            let filledInputs = 0;

            inputs.forEach(input => {
                if (input.files.length > 0) {
                    filledInputs++;
                }
            });

            const progressBar = document.getElementById('progress-bar');
            const progress = (filledInputs / totalInputs) * 100;
            progressBar.style.width = progress + '%';
        }
    </script>
</x-app-layout>