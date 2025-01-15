<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold">{{ $tugasakhir->title }}</h3>
                        <p class="mt-2 text-gray-600">Penulis: {{ $tugasakhir->nim }}</p>
                    </div>

                    @if(!auth()->check())
                        <div class="p-4 mb-6 text-blue-700 bg-blue-100 border-l-4 border-blue-700 rounded-lg">
                            <p class="font-medium">Anda sedang melihat versi terbatas.</p>
                            <p>Untuk mengakses dokumen lengkap, silakan <a href="{{ route('login') }}" class="underline">login</a> sebagai member.</p>
                        </div>
                    @endif

                    @php
                        $documents = [
                            'cover_abstract' => 'Cover dan Abstrak',
                        ];

                        if(auth()->check() && auth()->user()->role_id === 1) {
                            $documents = [
                                'full_document' => 'Dokumen Lengkap',
                                'cover_abstract' => 'Cover dan Abstrak',
                                'bab1_pendahuluan' => 'BAB 1 - Pendahuluan',
                                'bab2_kajianpustaka' => 'BAB 2 - Kajian Pustaka',
                                'bab3_perancangan' => 'BAB 3 - Perancangan',
                                'bab4_hasilpembahasan' => 'BAB 4 - Hasil dan Pembahasan',
                                'bab5_penutup' => 'BAB 5 - Penutup',
                                'lampiran' => 'Lampiran'
                            ];
                        }
                    @endphp

                    <!-- Tab Navigation -->
                    <div class="mb-4 border-b border-gray-200">
                        <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                            @foreach($documents as $field => $label)
                                @if($tugasakhir->$field)
                                    <button onclick="showTab('{{ $field }}')"
                                            id="tab-{{ $field }}"
                                            class="px-1 py-4 text-sm font-medium border-b-2 border-transparent hover:border-gray-300 hover:text-gray-700 whitespace-nowrap tab-btn">
                                        {{ $label }}
                                    </button>
                                @endif
                            @endforeach
                        </nav>
                    </div>

                    <!-- Quick Download Panel -->
                    <div class="p-4 mb-6 bg-gray-50 rounded-lg">
                        <h4 class="mb-3 font-medium">Download Dokumen:</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($documents as $field => $label)
                                @if($tugasakhir->$field)
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                       download
                                       class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                                        <span>{{ $label }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab Content -->
                    @foreach($documents as $field => $label)
                        @if($tugasakhir->$field)
                            <div id="content-{{ $field }}" class="hidden tab-content">
                                <div class="mb-4">
                                    <h4 class="mb-2 text-lg font-medium">{{ $label }}</h4>
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                       target="_blank"
                                       class="inline-block px-4 py-2 text-sm text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                        Buka di Tab Baru
                                    </a>
                                </div>
                                <div class="border rounded-lg">
                                    <iframe src="{{ Storage::url($tugasakhir->$field) }}"
                                            class="w-full h-screen"
                                            title="{{ $label }}"></iframe>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        // Inisialisasi tab pertama sebagai active
        document.addEventListener('DOMContentLoaded', function() {
            const firstTab = document.querySelector('.tab-btn');
            if (firstTab) {
                firstTab.click();
            }
        });

        function showTab(fieldName) {
            // Sembunyikan semua content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Hapus semua active state
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-blue-600');
                btn.classList.add('border-transparent');
            });
            
            // Tampilkan content yang dipilih
            const selectedContent = document.getElementById(`content-${fieldName}`);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }
            
            // Set active state pada tab yang dipilih
            const selectedTab = document.getElementById(`tab-${fieldName}`);
            if (selectedTab) {
                selectedTab.classList.add('text-blue-600', 'border-blue-600');
                selectedTab.classList.remove('border-transparent');
            }
        }
    </script>
</x-app-layout>