<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Konfirmasi Check-out',
        ])

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Konfirmasi Check-out Pengunjung</h2>
            </div>

            <!-- Content Section -->
            <div class="p-6">
                <!-- Visitor Info Card -->
                <div class="bg-blue-50 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pengunjung</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">Nama</span>
                                    <span class="text-gray-900 font-medium">{{ $visitor->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">NIM/NIP</span>
                                    <span class="text-gray-900 font-medium">{{ $visitor->nim_nip_nppu_nupk }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">Instansi</span>
                                    <span class="text-gray-900 font-medium">{{ $visitor->instansi }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Kunjungan</h3>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">Tanggal</span>
                                    <span class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($visitor->check_in_at)->isoFormat('dddd, D MMMM Y') }}
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">Jam Masuk</span>
                                    <span class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($visitor->check_in_at)->format('H:i') }} WIB
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 w-24">Durasi</span>
                                    <span class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($visitor->check_in_at)->diffForHumans(now(), ['parts' => 2, 'join' => true]) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Section -->
                <div class="text-center space-y-4">
                    <p class="text-gray-600">Apakah Anda yakin ingin melakukan check-out?</p>
                    
                    <form action="{{ route('visitor.confirmCheckout') }}" method="POST" class="space-x-4">
                        @csrf
                        <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">
                        
                        <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Konfirmasi Check-out
                        </button>
                        
                        <a href="{{ route('visitor.index') }}" 
                            class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Bukan Saya
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>