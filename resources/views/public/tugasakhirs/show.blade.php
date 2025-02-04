<x-app-layout>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @include('components.page-header', [
            'title' => 'Detail Tugas Akhir',
        ])

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header Section -->
                <div class="mb-8 border-b pb-4">
                    <h3 class="text-2xl font-semibold text-gray-900">{{ Str::title($tugasakhir->title) }}</h3>
                    <div class="mt-3 flex items-center space-x-4">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $tugasakhir->user->name ?? 'Tidak diketahui' }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $tugasakhir->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>

                @if(!auth()->check())
                    <div class="p-4 mb-6 text-blue-700 bg-blue-100 border-l-4 border-blue-700 rounded-lg">
                        <p class="font-medium">Anda sedang melihat versi terbatas.</p>
                        <p>Untuk mengakses dokumen lengkap, silakan <a href="{{ route('login') }}" class="underline hover:text-blue-800">login</a> sebagai member.</p>
                    </div>
                @endif

                @php
                    $documents = [
                        'cover_abstract' => 'Cover hingga Abstrak',
                    ];

                    if(auth()->check() && auth()->user()->role_id === 1) {
                        $documents = [
                            'full_document' => 'Dokumen Lengkap',
                            'cover_abstract' => 'Cover hingga Abstrak',
                            'bab1_pendahuluan' => 'BAB 1 - Pendahuluan',
                            'bab2_kajianpustaka' => 'BAB 2 - Kajian Pustaka',
                            'bab3_perancangan' => 'BAB 3 - Perancangan',
                            'bab4_hasilpembahasan' => 'BAB 4 - Hasil dan Pembahasan',
                            'bab5_penutup' => 'BAB 5 - Penutup',
                            'lampiran' => 'Lampiran'
                        ];
                    }
                @endphp

                <!-- Tab Navigation dengan Scrolling -->
                <div class="relative mb-4">
                    <!-- Tombol scroll kiri -->
                    <button onclick="scrollTabs('left')" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white shadow-md rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    
                    <!-- Tombol scroll kanan -->
                    <button onclick="scrollTabs('right')" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white shadow-md rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <div class="overflow-x-auto scrollbar-hide px-8" id="tabs-container">
                        <nav class="flex min-w-full border-b border-gray-200 pb-px" aria-label="Tabs">
                            <div class="flex space-x-1">
                                @foreach($documents as $field => $label)
                                    @if($tugasakhir->$field)
                                        <button onclick="showTab('{{ $field }}')"
                                                id="tab-{{ $field }}"
                                                class="tab-btn whitespace-nowrap px-4 py-2.5 text-sm font-medium border-b-2 border-transparent transition-colors duration-200 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                                            {{ $label }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </nav>
                    </div>
                </div>

                <!-- Tab Content dengan Toolbar -->
                @foreach($documents as $field => $label)
                    @if($tugasakhir->$field)
                        <div id="content-{{ $field }}" class="hidden tab-content">
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg flex items-center justify-between">
                                <h4 class="text-lg font-medium text-gray-900">{{ $label }}</h4>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                    target="_blank"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-600 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Buka di Tab Baru
                                    </a>
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                    download
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                            <div class="border rounded-lg bg-gray-50">
                                <iframe src="{{ Storage::url($tugasakhir->$field) }}"
                                        class="w-full h-screen rounded-lg"
                                        title="{{ $label }}"></iframe>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* Hide scrollbar but keep functionality */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstTab = document.querySelector('.tab-btn');
            if (firstTab) {
                firstTab.click();
            }
            
            // Check if scroll buttons should be visible
            checkScrollButtons();
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
            
            // Set active state pada tab yang dipilih (hanya border bawah)
            const selectedTab = document.getElementById(`tab-${fieldName}`);
            if (selectedTab) {
                selectedTab.classList.add('text-blue-600', 'border-blue-600');
                selectedTab.classList.remove('border-transparent');
            }
        }

        function scrollTabs(direction) {
            const container = document.getElementById('tabs-container');
            const scrollAmount = 200; // Sesuaikan dengan kebutuhan
            
            if (direction === 'left') {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            } else {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        function checkScrollButtons() {
            const container = document.getElementById('tabs-container');
            const maxScroll = container.scrollWidth - container.clientWidth;
            
            // Logika untuk menampilkan/menyembunyikan tombol scroll bisa ditambahkan di sini
            // if (maxScroll > 0) {
            //     // Tampilkan tombol
            // } else {
            //     // Sembunyikan tombol
            // }
        }

        // Event listener untuk update status tombol saat resize
        window.addEventListener('resize', checkScrollButtons);
    </script>
</x-app-layout>