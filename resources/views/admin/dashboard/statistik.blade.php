<div class="row g-4 mb-5">
    <!-- Available Books -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="stat-card">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-indigo p-3 me-3">
                    <i class="bi bi-book text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $availableBooks ?? 0 }}</h3>
                    <p class="text-muted small mb-0">Buku Tersedia</p>
                </div>
            </div>
            <a href="{{ route('admin.books.index') }}"
                class="card-footer bg-transparent text-decoration-none p-3 d-flex align-items-center justify-content-between text-indigo">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Borrowed Books -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="stat-card">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-purple p-3 me-3">
                    <i class="bi bi-book-half text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $borrowedBooks }}</h3>
                    <p class="text-muted small mb-0">Buku Terpinjam</p>
                </div>
            </div>
            <a href="{{ route('admin.books.index') }}"
                class="card-footer bg-transparent text-decoration-none p-3 d-flex align-items-center justify-content-between text-purple">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Visitors -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="stat-card">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-teal p-3 me-3">
                    <i class="bi bi-person-check text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalVisitor }}</h3>
                    <p class="text-muted small mb-0">Total Pengunjung</p>
                </div>
            </div>
            <a href="#"
                class="card-footer bg-transparent text-decoration-none p-3 d-flex align-items-center justify-content-between text-teal">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Students -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="stat-card">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-blue p-3 me-3">
                    <i class="bi bi-person-vcard text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalStudents }}</h3>
                    <p class="text-muted small mb-0">Total Mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('admin.students.index') }}"
                class="card-footer bg-transparent text-decoration-none p-3 d-flex align-items-center justify-content-between text-blue">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Documents -->
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="stat-card">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-violet p-3 me-3">
                    <i class="bi bi-file-earmark-text text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalDocument ?? 0 }}</h3>
                    <p class="text-muted small mb-0">Total Dokumen TA</p>
                </div>
            </div>
            <a href="{{ route('admin.document.index') }}"
                class="card-footer bg-transparent text-decoration-none p-3 d-flex align-items-center justify-content-between text-violet">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
    .stat-card {
        background: white;
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
        transition: 0.5s;
    }

    .stat-card:hover::after {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .icon-square {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* New color definitions */
    .bg-indigo {
        background-color: #4F46E5;
    }

    .bg-purple {
        background-color: #9333EA;
    }

    .bg-teal {
        background-color: #14B8A6;
    }

    .bg-blue {
        background-color: #3B82F6;
    }

    .bg-violet {
        background-color: #8B5CF6;
    }

    .text-indigo {
        color: #4F46E5;
    }

    .text-purple {
        color: #9333EA;
    }

    .text-teal {
        color: #14B8A6;
    }

    .text-blue {
        color: #3B82F6;
    }

    .text-violet {
        color: #8B5CF6;
    }

    .card-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-footer:hover i {
        transform: translateX(5px);
    }

    .card-footer i {
        transition: transform 0.3s ease;
    }
</style>
