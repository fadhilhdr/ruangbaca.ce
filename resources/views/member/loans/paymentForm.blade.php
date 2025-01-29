<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Peminjaman Buku',
        ])
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('member.loans.returnForm', $loan->id) }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Form Pengembalian
                </a>
            </div>

            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Pembayaran Denda Keterlambatan</h1>

                <!-- Fine Details -->
                <div class="bg-red-50 rounded-lg p-4 mb-6">
                    <h4 class="font-medium text-red-800 mb-2">Informasi Denda</h4>
                    <p class="text-red-600">Keterlambatan: {{ $daysLate }} hari</p>
                    <p class="text-red-600 font-medium">Total Denda: Rp{{ number_format($fineAmount, 0, ',', '.') }}</p>
                </div>

                <!-- QRIS Payment -->
                <div class="mb-6">
                    <h4 class="font-medium text-gray-900 mb-2">Pembayaran via QRIS</h4>
                    <div class="bg-white border rounded-lg p-4 mb-4">
                        <img src="{{ asset('images/dummy-qris.png') }}" 
                             alt="QRIS Code" 
                             class="w-48 h-48 mx-auto">
                        <p class="text-center text-sm text-gray-500 mt-2">Scan QRIS untuk melakukan pembayaran</p>
                    </div>
                </div>

                <!-- Upload Form -->
                <form action="{{ route('member.loans.payment.store', $loan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label for="bukti_tf" class="block text-sm font-medium text-gray-700">
                            Upload Bukti Transfer
                        </label>
                        <input type="file"
                               id="bukti_tf"
                               name="bukti_tf"
                               accept="image/*"
                               required
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-medium
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Format: JPG, PNG (Max. 2MB)</p>
                        @error('bukti_tf')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" 
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Upload Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>