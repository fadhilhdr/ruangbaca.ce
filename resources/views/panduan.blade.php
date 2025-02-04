<x-app-layout>
<head> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <h2 class="text-xl font-semibold mb-6 text-center">Alur Peminjaman Buku</h2>
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                <i class="bi bi-box-arrow-in-right text-3xl text-blue-500"></i>
            </div>
            <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                <span class="text-gray-700 font-medium">Login atau masuk ke dalam akun, apabila belum mempunyai akun dapat melakukan pendaftaran.</span>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                <i class="bi bi-journal-album text-3xl text-green-500"></i>
            </div>
            <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                <span class="text-gray-700 font-medium">Cari buku yang akan dipinjam pada fitur cari buku.</span>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                <i class="bi bi-upc-scan text-3xl text-yellow-500"></i>
            </div>
            <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                <span class="text-gray-700 font-medium">Scan kode unik pada kode batang yang pada samping sampul buku.</span>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                <i class="bi bi-card-checklist text-3xl text-purple-500"></i>
            </div>
            <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                <span class="text-gray-700 font-medium">Setujui persayaratan peminjaman dan konfirmasi akan melakukan peminjaman.</span>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 flex justify-center items-center rounded-md">
                <i class="bi bi-check-square text-3xl text-green-600"></i>
            </div>
            <div class="flex-1 h-16 bg-gray-100 rounded-md flex items-center px-4">
                <span class="text-gray-700 font-medium">Selamat buku sudah berhasil dipinjam dan dapat dibawa pulang.</span>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
