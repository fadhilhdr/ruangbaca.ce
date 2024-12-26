<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Konfirmasi Checkout</h1>

        <div class="bg-white p-4 rounded-lg shadow-md">
            <p class="text-lg">Apakah Anda yakin ingin checkout?</p>
            <p class="text-gray-600">Nama: {{ $visitor->name }}</p>
            <p class="text-gray-600">NIM/NIP: {{ $visitor->userid ?? '-' }}</p>
            <p class="text-gray-600">Instansi: {{ $visitor->instansi }}</p>

            <form action="{{ route('visitor.confirmCheckout') }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="visitor_id" value="{{ $visitor->id }}">

                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Konfirmasi Checkout</button>
                <a href="{{ route('visitor.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Bukan Saya</a>
            </form>
        </div>
    </div>
</x-app-layout>
