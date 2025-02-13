<div class="row g-4 mb-5">
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-primary/10 p-3 me-3">
                    <i class="bi bi-person-vcard text-primary fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalStudents }}</h3>
                    <p class="text-muted small mb-0">Total Mahasiswa</p>
                </div>
            </div>
            <a href="{{ route('superadmin.students.index') }}"
                class="card-footer bg-transparent border-top text-primary text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-info/10 p-3 me-3">
                    <i class="bi bi-briefcase text-info fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalPegawai }}</h3>
                    <p class="text-muted small mb-0">Total Pegawai</p>
                </div>
            </div>
            <a href="{{ route('superadmin.employees.index') }}" {{-- Ganti dengan route yang benar --}}
                class="card-footer bg-transparent border-top text-info text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-4 col-xl">
        <div class="card h-100 shadow-sm border-0 transition-all hover:shadow-md">
            <div class="card-body p-4 d-flex align-items-center">
                <div class="icon-square rounded-circle bg-warning/10 p-3 me-3">
                    <i class="bi bi-people text-warning fs-4"></i>
                </div>
                <div>
                    <h3 class="h2 fw-bold mb-1">{{ $totalPengguna }}</h3>
                    <p class="text-muted small mb-0">Total Pengguna</p>
                </div>
            </div>
            <a href="{{ route('superadmin.users.index') }}" {{-- Ganti dengan route yang benar --}}
                class="card-footer bg-transparent border-top text-warning text-decoration-none p-3 d-flex align-items-center justify-content-between">
                <span class="small fw-medium">Tampilkan Detail</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
