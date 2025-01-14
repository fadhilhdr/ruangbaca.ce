<div class="row gy-4 mb-4"> <!-- Baris dengan spasi antar elemen -->
    <!-- Buku Tersedia -->
    <div class="col-lg-6 col-xl-3">
        <div class="card card-statistik shadow-sm border-0 bg-light">
            <div class="card-body d-flex align-items-center">
                <div class="icon-square bg-primary text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-book fs-3"></i>
                </div>
                <div>
                    <h4 class="mb-1">{{ $availableBooks }}</h4>
                    <p class="mb-0 text-muted">Buku Tersedia</p>
                </div>
            </div>
            <a href="{{ route('admin.books.index') }}" class="card-footer text-muted text-decoration-none py-2">
                More info <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>

    <!-- Buku Terpinjam -->
    <div class="col-lg-6 col-xl-3">
        <div class="card card-statistik shadow-sm border-0 bg-light">
            <div class="card-body d-flex align-items-center">
                <div class="icon-square bg-success text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-book-half fs-3"></i>
                </div>
                <div>
                    <h4 class="mb-1">{{ $borrowedBooks }}</h4>
                    <p class="mb-0 text-muted">Buku Terpinjam</p>
                </div>
            </div>
            <a href="#" class="card-footer text-muted text-decoration-none py-2">
                More info <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>

    <!-- Pengunjung -->
    <div class="col-lg-6 col-xl-3">
        <div class="card card-statistik shadow-sm border-0 bg-light">
            <div class="card-body d-flex align-items-center">
                <div class="icon-square bg-warning text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check fs-3"></i>
                </div>
                <div>
                    <h4 class="mb-1">{{ $totalVisitor }}</h4>
                    <p class="mb-0 text-muted">Pengunjung</p>
                </div>
            </div>
            <a href="#" class="card-footer text-muted text-decoration-none py-2">
                More info <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>

    <!-- Jumlah Mahasiswa -->
    <div class="col-lg-6 col-xl-3">
        <div class="card card-statistik shadow-sm border-0 bg-light">
            <div class="card-body d-flex align-items-center">
                <div class="icon-square bg-danger text-white me-3 d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-vcard fs-3"></i>
                </div>
                <div>
                    <h4 class="mb-1">{{ $totalStudents }}</h4>
                    <p class="mb-0 text-muted">Jumlah Mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('admin.students.index') }}" class="card-footer text-muted text-decoration-none py-2">
                More info <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
</div>

<!-- Tambahkan CSS -->
<style>
    .icon-square {
        width: 50px;
        height: 50px;
        border-radius: 10%;
        font-size: 1.5rem;
    }

    .card-footer:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .card-statistik {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-statistik:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 1rem 1.25rem;
    }
</style>
