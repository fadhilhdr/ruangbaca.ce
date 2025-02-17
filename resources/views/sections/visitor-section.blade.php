<!-- Floating Button Container -->
<div class="fixed bottom-8 right-8 z-50">
    <a href="{{ route('visitor.index') }}" class="group relative block">
        <!-- Enhanced Gradient Glow Effect -->
        <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-blue-500 to-blue-400 
                    rounded-full blur-md opacity-20 
                    group-hover:opacity-50 group-hover:blur-lg
                    group-hover:rounded-full
                    transition-all duration-300 ease-in-out"></div>
        
        <!-- Main Button Container -->
        <div class="relative flex justify-end">
            <!-- Expanded State (Slides from right to left) -->
            <div class="absolute right-0 
                        bg-white rounded-full shadow-lg
                        w-0 opacity-0 invisible overflow-hidden
                        group-hover:w-[200px] group-hover:opacity-100 group-hover:visible
                        group-hover:rounded-full
                        transition-all duration-300 ease-in-out">
                <!-- Menggunakan padding right sebesar lebar circle button + spacing -->
                <div class="flex items-center justify-end h-16 pr-[72px]">
                    <!-- Simple Text Label dengan margin yang tepat -->
                    <span class="text-blue-600 font-medium whitespace-nowrap">
                        Isi Daftar Hadir
                    </span>
                </div>
            </div>

            <!-- Collapsed State (Circle Button) -->
            <div class="relative bg-white rounded-full shadow-lg
                        w-16 h-16 
                        flex items-center justify-center
                        group-hover:shadow-xl
                        transition-all duration-300 ease-in-out
                        z-10">
                <svg class="w-8 h-8 text-blue-600" 
                     fill="none" 
                     stroke="currentColor" 
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" 
                          stroke-linejoin="round" 
                          stroke-width="2" 
                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
        </div>
    </a>
</div>