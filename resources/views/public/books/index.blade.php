<x-app-layout>
    <div class="container py-5">
        <h1 class="my-4 text-center fw-bold">Daftar Buku</h1>

        <!-- Form Pencarian Buku -->
        <form method="GET" action="{{ route('public.books.index') }}" class="mb-5">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text" id="title-search">Judul</span>
                        <input type="text" name="title" class="form-control" placeholder="Cari judul buku" value="{{ request()->get('title') }}" aria-label="Judul" aria-describedby="title-search">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text" id="author-search">Pengarang</span>
                        <input type="text" name="author" class="form-control" placeholder="Cari pengarang" value="{{ request()->get('author') }}" aria-label="Pengarang" aria-describedby="author-search">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text" id="specialization-search">Spesialisasi</span>
                        <select name="specialization_id" class="form-select" aria-label="Spesialisasi" aria-describedby="specialization-search">
                            <option value="">Semua</option>
                            <option value="1" {{ request()->get('specialization_id') == 1 ? 'selected' : '' }}>Software</option>
                            <option value="2" {{ request()->get('specialization_id') == 2 ? 'selected' : '' }}>Networking</option>
                            <option value="3" {{ request()->get('specialization_id') == 3 ? 'selected' : '' }}>Multimedia</option>
                            <option value="4" {{ request()->get('specialization_id') == 4 ? 'selected' : '' }}>Embedded System</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>

        <!-- Daftar Buku -->
        <div class="row">
            @forelse($books as $book)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ Str::limit($book->title, 50) }}</h5>
                            <p class="card-text text-muted mb-1"><strong>Pengarang:</strong> {{ $book->author }}</p>
                            <p class="card-text mb-3"><strong>Spesialisasi:</strong> {{ $book->specialization->name }}</p>
                            <a href="{{ route('public.books.show', $book->id) }}" class="btn btn-info mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        Tidak ada buku yang ditemukan.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $books->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-app-layout>
