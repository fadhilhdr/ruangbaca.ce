<!-- Page header with gradient background -->
<div class="relative mb-4">
    <div class="relative px-6 py-6">
        <!-- Page title with decorative line -->
        <div class="space-y-4">
            <div class="relative pb-3">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $title }}
                </h1>
            </div>
        </div>
        <nav class="mb-0" aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center">
                <li class="flex items-center text-sm">
                    <a href="{{ url('/') }}" 
                       class="text-gray-500 hover:text-blue-600 inline-flex items-center group transition-all duration-200">
                        <span class="hover:underline underline-offset-2">Beranda</span>
                    </a>
                </li>
                
                @foreach (\App\Helpers\BreadcrumbHelper::generateBreadcrumb() as $breadcrumb)
                    <li class="flex items-center text-sm">
                        <svg class="w-5 h-5 mx-2 text-gray-400 flex-shrink-0" 
                             fill="currentColor" 
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd" 
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" 
                                  clip-rule="evenodd"/>
                        </svg>
                        @if ($loop->last)
                            <span class="font-bold text-black" 
                                  aria-current="page">
                                {{ $breadcrumb['name'] }}
                            </span>
                        @else
                            <a href="{{ url($breadcrumb['url']) }}" 
                               class="text-gray-500 hover:text-blue-600 transition-colors duration-200 hover:underline underline-offset-2">
                                {{ $breadcrumb['name'] }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        <!-- Underline -->
        <div class="absolute bottom-0 left-0 h-1 w-full bg-blue-500"></div>
    </div>
</div>