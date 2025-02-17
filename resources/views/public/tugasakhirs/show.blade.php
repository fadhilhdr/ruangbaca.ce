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
                    <div class="mt-3 flex flex-wrap gap-4 sm:flex-nowrap sm:items-center">
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="truncate">{{ $tugasakhir->user->name ?? 'Tidak diketahui' }}</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                <!-- Improved Tab Navigation dengan Scrolling -->
                <div class="relative mb-4">
                    <div class="flex">
                        <!-- Left scroll button - Now outside the scroll container -->
                        <button onclick="scrollTabs('left')" 
                                id="scroll-left"
                                class="hidden px-2 py-2.5 bg-white shadow-lg rounded-l-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        
                        <!-- Tabs container -->
                        <div class="flex-1 overflow-x-auto scrollbar-hide" id="tabs-container">
                            <nav class="flex border-b border-gray-200" aria-label="Tabs">
                                <div class="flex space-x-1 min-w-full px-1">
                                    @foreach($documents as $field => $label)
                                        @if($tugasakhir->$field)
                                            <button onclick="showTab('{{ $field }}')"
                                                    id="tab-{{ $field }}"
                                                    class="tab-btn whitespace-nowrap px-4 py-2.5 text-sm font-medium border-b-2 border-transparent transition-all duration-200 hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                                                {{ $label }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </nav>
                        </div>
                        
                        <!-- Right scroll button - Now outside the scroll container -->
                        <button onclick="scrollTabs('right')"
                                id="scroll-right" 
                                class="hidden px-2 py-2.5 bg-white shadow-lg rounded-r-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Tab Content with Improved Toolbar -->
                @foreach($documents as $field => $label)
                    @if($tugasakhir->$field)
                        <div id="content-{{ $field }}" class="hidden tab-content">
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <h4 class="text-lg font-medium text-gray-900">{{ $label }}</h4>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                       target="_blank"
                                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-600 rounded-md hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Buka di Tab Baru
                                    </a>
                                    <a href="{{ Storage::url($tugasakhir->$field) }}"
                                       download
                                       class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                </div>
                            </div>
                            <div class="border rounded-lg bg-gray-50">
                                <iframe src="{{ Storage::url($tugasakhir->$field) }}"
                                        class="w-full h-[800px] rounded-lg"
                                        title="{{ $label }}"></iframe>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        /* Smooth transitions for tab indicators */
        .tab-btn {
            position: relative;
        }
        
        .tab-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: transparent;
            transition: background-color 0.2s ease-in-out;
        }
        
        .tab-btn.active::after {
            background-color: rgb(37, 99, 235);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const firstTab = document.querySelector('.tab-btn');
            if (firstTab) {
                firstTab.click();
            }
            
            // Initial check for scroll buttons
            checkScrollButtons();
            
            // Add scroll event listener to container
            const container = document.getElementById('tabs-container');
            container.addEventListener('scroll', checkScrollButtons);
        });

        function showTab(fieldName) {
            // Hide all content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove all active states
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-blue-600', 'border-blue-600', 'active');
                btn.classList.add('border-transparent');
            });
            
            // Show selected content
            const selectedContent = document.getElementById(`content-${fieldName}`);
            if (selectedContent) {
                selectedContent.classList.remove('hidden');
            }
            
            // Set active state on selected tab
            const selectedTab = document.getElementById(`tab-${fieldName}`);
            if (selectedTab) {
                selectedTab.classList.add('text-blue-600', 'border-blue-600', 'active');
                selectedTab.classList.remove('border-transparent');
            }
        }

        function scrollTabs(direction) {
            const container = document.getElementById('tabs-container');
            const scrollAmount = container.clientWidth * 0.75; // Scroll 75% of container width
            
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
            
            // Update scroll buttons after scrolling
            setTimeout(checkScrollButtons, 100);
        }

        function checkScrollButtons() {
            const container = document.getElementById('tabs-container');
            const leftButton = document.getElementById('scroll-left');
            const rightButton = document.getElementById('scroll-right');
            
            // Show/hide left button
            if (container.scrollLeft > 0) {
                leftButton.classList.remove('hidden');
            } else {
                leftButton.classList.add('hidden');
            }
            
            // Show/hide right button
            if (container.scrollLeft + container.clientWidth < container.scrollWidth - 1) {
                rightButton.classList.remove('hidden');
            } else {
                rightButton.classList.add('hidden');
            }
        }

        // Add resize observer to handle window resizing
        const resizeObserver = new ResizeObserver(entries => {
            checkScrollButtons();
        });
        
        resizeObserver.observe(document.getElementById('tabs-container'));
    </script>
</x-app-layout>