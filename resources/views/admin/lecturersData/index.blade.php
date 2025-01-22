@extends('admin.layouts.base')

@section('title', 'Indeks Dosen')

@section('content')
    <div class="container-fluid">
        <!-- Search and Filter Card -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body">
                <form action="{{ route('admin.lecturers.index') }}" method="GET">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="search" name="search" id="search" class="form-control border-0 bg-light"
                                    placeholder="Cari berdasarkan Nama atau NIP..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-search me-2"></i>
                                    Cari
                                </button>
                            </div>

                        </div>

                        <div class="col-md-8 text-end">

                            <a href="{{ route('admin.lecturers.create') }}" class="btn btn-success px-4 ms-2">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                Tambah Dosen
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lecturers Table -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="mb-0">
                            <i class="bi bi-table me-2 text-primary"></i>
                            Daftar Dosen
                        </h5>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-primary rounded-pill px-4 py-2">
                            Total: {{ $lecturers->total() }} dosen
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-center">
                            <tr>
                                <th class="py-3 text-center" width="5%">No</th>
                                <th class="py-3" width="12%">Nama Lengkap</th>
                                <th class="py-3" width="15%">NIP/NPPU/NUPK</th>
                                <th class="py-3" width="8%">NIDN/NIDK/NUP/NITK</th>
                                <th class="py-3" width="12%">NUPTK</th>
                                <th class="py-3" width="12%">Pangkat Golongan</th>
                                <th class="py-3" width="12%">Jabatan Fungsional</th>
                                <th class="py-3" width="12%">Tugas tambahan 1</th>
                                <th class="py-3" width="12%">Tugas tambahan 2</th>
                                <th class="py-3" width="12%">Tugas tambahan 3</th>
                                <th class="py-3" width="12%">Kepakaran</th>
                                <th class="py-3" width="12%">Pendidikan Terakhir</th>
                                <th class="py-3" width="12%">Jurusan</th>
                                <th class="py-3" width="12%">Status Bekerja</th>
                                <th class="py-3" width="12%">Status Kepegawaian</th>
                                <th class="py-3" width="12%">Jenis Pegawai</th>
                                <th class="py-3" width="12%">Unit Kerja</th>
                                <th class="py-3" width="12%">Bagian</th>
                                <th class="py-3" width="12%">Sub Bagian</th>
                                <th class="py-3 text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lecturers as $index => $lecturer)
                                {{-- <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="fw-medium text-primary">{{ $lecturer->nip }}</td>
                                <td class="fw-medium">{{ $lecturer->name }}</td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info px-2">
                                        {{ $lecturer->kode_dosen }}
                                    </span>
                                </td>
                                <td><small>{{ $lecturer->riwayat_s1 }}</small></td>
                                <td><small>{{ $lecturer->riwayat_s2 }}</small></td>
                                <td><small>{{ $lecturer->riwayat_s3 ?? '-' }}</small></td>
                                <td><small>{{ $lecturer->kepakaran1 }}</small></td>
                                <td><small>{{ $lecturer->kepakaran2 ?? '-' }}</small></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                            <li>
                                                <a href="{{ route('admin.lecturers.edit', $lecturer->nip) }}"
                                                    class="dropdown-item py-2 px-4">
                                                    <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                    Edit Data
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.lecturers.destroy', $lecturer->nip) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dosen ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item py-2 px-4 text-danger">
                                                        <i class="bi bi-trash me-2"></i>
                                                        Hapus Data
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr> --}}
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="empty-state-icon mb-3">
                                                <i class="bi bi-person-slash text-muted opacity-25"
                                                    style="font-size: 3rem;"></i>
                                            </div>
                                            <h6 class="text-muted">Data Tidak Ditemukan</h6>
                                            <p class="text-muted small mb-0">
                                                Belum ada data dosen yang tersedia saat ini
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($lecturers->hasPages())
                <div class="card-footer bg-white border-top py-3">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <small class="text-muted">
                                Menampilkan {{ $lecturers->firstItem() }} sampai {{ $lecturers->lastItem() }}
                                dari {{ $lecturers->total() }} data
                            </small>
                        </div>
                        <div class="col-auto ms-auto">
                            {{ $lecturers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize tooltips
                const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
                tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));

                // Enhance dropdown interactions
                const dropdownItems = document.querySelectorAll('.dropdown-item');
                dropdownItems.forEach(item => {
                    item.addEventListener('mouseover', function() {
                        this.style.backgroundColor = this.classList.contains('text-danger') ?
                            '#FEE2E2' :
                            '#F3F4F6';
                    });
                    item.addEventListener('mouseout', function() {
                        this.style.backgroundColor = '';
                    });
                });
            });
        </script>
    @endpush
@endsection
