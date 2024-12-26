<x-app-layout>
    <div class="container py-5">
        <h1 class="my-4 text-center fw-bold">{{ $book->title }}</h1>

        <!-- Detail Buku -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h5 class="card-title">Informasi Buku</h5>
                        <hr>
                        <p class="card-text"><strong>Pengarang:</strong> {{ $book->author }}</p>
                        <p class="card-text"><strong>Spesialisasi:</strong> {{ $book->specialization->name }}</p>
                        <p class="card-text"><strong>Stok:</strong> {{ $book->stock }} Buku</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Sinopsis</h5>
                        <hr>
                        <p class="card-text">{{ $book->synopsis ?? 'Tidak ada sinopsis.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Link Kembali ke Daftar Buku -->
        <div class="text-center">
            <a href="{{ route('public.books.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Buku
            </a>
        </div>
    </div>
</x-app-layout>
