@extends('admin.layouts.base')

@section('title', 'Indeks Dokumen')

@section('content')
    <div class="container-fluid">
        <!-- Search and Action Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-4">
                        <form action="{{ route('admin.document.index') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control me-2" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari nama atau judul...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.document.create') }}" class="btn btn-success me-2">
                            <i class="bi bi-plus-circle me-1"></i> Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-book me-2"></i> Daftar Dokumen
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary">Total: {{ $dokumens->total() }} Dokumen</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 40px">NO</th>
                                <th>Nama</th>
                                <th>Judul</th>
                                <th>Dokumen Lengkap</th>
                                <th>Abstrak</th>
                                <th>Bab I</th>
                                <th>Bab II</th>
                                <th>Bab III</th>
                                <th>Bab IV</th>
                                <th>Bab V</th>
                                <th>Lampiran</th>
                                <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumens as $index => $dokumen)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($dokumens->currentPage() - 1) * $dokumens->perPage() }}
                                    </td>
                                    <td>{{ $dokumen->user->name ?? '-' }}</td>
                                    <td>{{ $dokumen->title }}</td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->full_document) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-file-earmark-text"></i> Lihat
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->cover_abstract) }}" target="_blank">Abstrak</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->bab1_pendahuluan) }}" target="_blank">Bab I</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->bab2_kajianpustaka) }}" target="_blank">Bab
                                            II</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->bab3_perancangan) }}" target="_blank">Bab
                                            III</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->bab4_hasilpembahasan) }}" target="_blank">Bab
                                            IV</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->bab5_penutup) }}" target="_blank">Bab V</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($dokumen->lampiran) }}" target="_blank">Lampiran</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('admin.document.edit', $dokumen->id) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.document.destroy', $dokumen->id) }}"
                                                        method="POST"
                                                        onsubmit="event.preventDefault();
                                                                   Swal.fire({
                                                                       title: 'Apakah Anda yakin?',
                                                                       text: 'Data dokumen ini akan dihapus permanen!',
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
                                    <td colspan="12" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data dokumen tersedia</p>
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
                    {{ $dokumens->links('pagination::bootstrap-5') }}
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
