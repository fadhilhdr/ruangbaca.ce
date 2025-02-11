<x-app-layout>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    </head>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Frequently Asked Question (FAQ) - Ruang Baca CE',
        ])
        <div class="space-y-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                    <i class="bi bi-box-arrow-in-right text-3xl text-blue-500"></i>
                </div>
                <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                    <span class="text-gray-700 font-medium">Bagaimana cara mengakses Ruang Baca CE?<br>
                        Anda dapat mengakses Ruang Baca CE dengan login menggunakan akun Anda. Jika belum memiliki akun, silakan lakukan pendaftaran terlebih dahulu.</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                    <i class="bi bi-search text-3xl text-green-500"></i>
                </div>
                <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                    <span class="text-gray-700 font-medium">Bagaimana cara mencari buku?<br>
                        Anda dapat mencari buku dengan menggunakan fitur pencarian di halaman utama Ruang Baca CE.</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                    <i class="bi bi-upc-scan text-3xl text-yellow-500"></i>
                </div>
                <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                    <span class="text-gray-700 font-medium">Bagaimana cara meminjam buku?<br>
                        Setelah menemukan buku yang diinginkan, scan kode unik pada buku atau lakukan peminjaman melalui sistem.</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                    <i class="bi bi-calendar-check text-3xl text-purple-500"></i>
                </div>
                <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                    <span class="text-gray-700 font-medium">Berapa lama durasi peminjaman buku?<br>
                        Peminjaman buku memiliki batas waktu tertentu. Pastikan untuk mengembalikan buku sebelum batas waktu habis untuk menghindari denda.</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                    <i class="bi bi-exclamation-circle text-3xl text-red-500"></i>
                </div>
                <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                    <span class="text-gray-700 font-medium">Apa yang terjadi jika buku terlambat dikembalikan?<br>
                        Jika buku dikembalikan melewati batas waktu, Anda akan dikenakan denda sesuai dengan kebijakan Ruang Baca CE.</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
