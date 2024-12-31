<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold mb-4">Perpanjang Peminjaman</h2>
        
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-xl mb-4">{{ $loan->book->title }}</h3>
            
            <form action="{{ route('member.loans.renew', $loan->id) }}" method="POST">
                @csrf
                <!-- Tambahkan field lain jika diperlukan -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Konfirmasi Perpanjangan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>