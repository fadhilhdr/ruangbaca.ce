<!-- Page header with simplified layout -->
<div class="relative mb-6">
    <div class="relative px-8 pt-4 pb-6">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold text-gray-900 tracking-tight mb-4">
            {{ $title }}
        </h1>

        <!-- Navigation row with back button and breadcrumbs -->
        <div class="flex items-center space-x-4">
            <!-- Back Button -->
            <button onclick="history.back()" 
                    class="group flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200"
                    title="Kembali ke halaman sebelumnya">
                <svg class="w-4 h-4 mr-1.5 transform group-hover:-translate-x-1 transition-transform duration-200" 
                     fill="currentColor" 
                     viewBox="0 0 20 20">
                    <path fill-rule="evenodd" 
                          d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" 
                          clip-rule="evenodd"/>
                </svg>
                <span class="font-medium hover:underline underline-offset-2">Kembali</span>
            </button>

            <!-- Divider -->
            <div class="h-4 w-px bg-gray-300"></div>

            <!-- Breadcrumbs -->
            <nav aria-label="Lokasi halaman">
                <ol class="flex items-center text-sm">
                    <li class="text-gray-600">
                        <span class="hover:text-gray-900">Beranda</span>
                    </li>
                    
                    @foreach (\App\Helpers\BreadcrumbHelper::generateBreadcrumb() as $breadcrumb)
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mx-2 text-gray-400" 
                                 fill="currentColor" 
                                 viewBox="0 0 20 20">
                                <path fill-rule="evenodd" 
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" 
                                      clip-rule="evenodd"/>
                            </svg>
                            <span class="{{ $loop->last ? 'font-medium text-gray-900' : 'text-gray-600' }}">
                                {{ $breadcrumb['name'] }}
                            </span>
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
        
        <!-- Underline -->
        <div class="absolute bottom-0 left-0 h-0.5 w-full bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500"></div>
    </div>
</div>