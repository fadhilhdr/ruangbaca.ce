<div class="row g-4 mb-5">
    <!-- Available Books -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-primary/10 p-3 me-3">
                    <i class="bi bi-book text-primary fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $availableBooks ?? 0 }}</h3>
                    <p class="text-muted small mb-0">Buku Tersedia</p>
                </div>
            </div>
            <a href="{{ route('admin.books.index') }}"
                class="card-footer bg-transparent border-top text-primary text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Borrowed Books -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-success/10 p-3 me-3">
                    <i class="bi bi-book-half text-success fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $borrowedBooks }}</h3>
                    <p class="text-muted small mb-0"> Buku Terpinjam</p>
                </div>
            </div>
            <a href="#"
                class="card-footer bg-transparent border-top text-success text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Visitors -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-warning/10 p-3 me-3">
                    <i class="bi bi-person-check text-warning fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalVisitor }}</h3>
                    <p class="text-muted small mb-0">Total Pengunjung</p>
                </div>
            </div>
            <a href="#"
                class="card-footer bg-transparent border-top text-warning text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Students -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-danger/10 p-3 me-3">
                    <i class="bi bi-person-vcard text-danger fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalStudents }}</h3>
                    <p class="text-muted small mb-0">Total Mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('admin.students.index') }}"
                class="card-footer bg-transparent border-top text-danger text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Documents -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-info/10 p-3 me-3">
                    <i class="bi bi-file-earmark-text text-info fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalDocument ?? 0 }}</h3>
                    <p class="text-muted small mb-0">Total Dokumen TA</p>
                </div>
            </div>
            <a href="{{ route('admin.document.index') }}"
                class="card-footer bg-transparent border-top text-info text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .icon-square {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        transition: all 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
    }
</style>
