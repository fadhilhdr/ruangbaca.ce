@extends('admin.layouts.base')

@section('title', 'Indeks Mahasiswa')

@section('content')
    <div class="container-fluid">
        <!-- Search and Filter Card -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-4">
                        <form action="{{ route('admin.students.index') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control me-2" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari nama atau NIM...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.students.create') }}" class="btn btn-success me-2">
                            <i class="bi bi-plus-circle me-1"></i> Tambah
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-people me-2"></i> Daftar Mahasiswa
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary rounded-pill px-4 py-2">
                        Total: {{ $students->total() }} Mahasiswa
                    </span>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 40px">NO</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Prodi</th>
                                <th>Jalur Masuk</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $index => $student)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}
                                    </td>
                                    <td>{{ $student->nim }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->angkatan }}</td>
                                    <td>{{ $student->gender }}</td>
                                    <td>{{ $student->prodi }}</td>
                                    <td>{{ $student->jalur_masuk }}</td>
                                    <td>{{ $student->status_terakhir }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('admin.students.edit', $student->nim) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.students.destroy', $student->nim) }}"
                                                        method="POST"
                                                        onsubmit="event.preventDefault();
                                                                   Swal.fire({
                                                                       title: 'Apakah Anda yakin?',
                                                                       text: 'Data mahasiswa ini akan dihapus permanen!',
                                                                       icon: 'warning',
                                                                       showCancelButton: true,
                                                                       confirmButtonColor: '#d33',
                                                                       cancelButtonColor: '#3085d6',
                                                                       confirmButtonText: 'Ya, Hapus!',
                                                                       cancelButtonText: 'Batal'
                                                                   }).then((result) => {
                                                                       if (result.isConfirmed) {
                                                                           this.submit();
                                                                       }
                                                                   });
                                                                   return false;">
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

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data mahasiswa tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $students->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Initialize tooltips
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                });
            });
        </script>
    @endpush
@endsection
