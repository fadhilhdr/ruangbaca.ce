@extends('admin.layouts.base')

@section('title', 'Indeks Buku')

@section('content')
    <div class="container-fluid">
        <!-- Search and Action Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-8">
                        <form action="{{ route('admin.books.index') }}" method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label for="search" class="form-label">Cari Buku</label>
                                <input type="text" class="form-control" id="search" name="search"
                                    value="{{ request('search') }}" placeholder="Masukkan judul/penulis...">
                            </div>
                            <div class="col-md-3">
                                <label for="peminatan" class="form-label">Peminatan</label>
                                <select class="form-select" name="peminatan" id="peminatan">
                                    <option value="">Semua Peminatan</option>
                                    <option value="Perangkat Lunak & Mobile Computing"
                                        {{ request('peminatan') == 'Perangkat Lunak & Mobile Computing' ? 'selected' : '' }}>
                                        Perangkat Lunak & Mobile Computing</option>
                                    <option value="Jaringan & Keamanan Komputer"
                                        {{ request('peminatan') == 'Jaringan & Keamanan Komputer' ? 'selected' : '' }}>
                                        Jaringan & Keamanan Komputer</option>
                                    <option value="Sistem Tertanam & Robotika"
                                        {{ request('peminatan') == 'Sistem Tertanam & Robotika' ? 'selected' : '' }}>Sistem
                                        Tertanam & Robotika</option>
                                    <option value="Multimedia" {{ request('peminatan') == 'Multimedia' ? 'selected' : '' }}>
                                        Multimedia</option>
                                    <option value="Diluar Peminatan"
                                        {{ request('peminatan') == 'Diluar Peminatan' ? 'selected' : '' }}>Diluar Peminatan
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="is_available" class="form-label">Status</label>
                                <select class="form-select" name="is_available" id="is_available">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('is_available') == '1' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="0" {{ request('is_available') == '0' ? 'selected' : '' }}>Tidak
                                        Tersedia</option>
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search me-1"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.books.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-lg me-1"></i> Tambah
                        </a>

                    </div>
                </div>

            </div>
        </div>

        <!-- Books Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-book me-2"></i> Daftar Buku
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary rounded-pill px-4 py-2">Total: {{ $books->total() }} buku</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 40px">NO</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Peminatan</th>
                                <th>Sub Peminatan</th>
                                <th>Kode Unik</th>
                                <th class="text-center">Thumbnail</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $index => $book)
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}
                                    </td>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->penulis }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                    <td><code>{{ $book->isbn }}</code></td>
                                    <td>{{ $book->peminatan }}</td>
                                    <td>{{ $book->sub_peminatan }}</td>
                                    <td><code>{{ $book->kode_unik }}</code></td>
                                    <td class="text-center">
                                        @if ($book->thumbnail)
                                            <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail"
                                                class="img-thumbnail" style="max-width: 50px; height: auto;">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $book->is_available ? 'success' : 'danger' }}">
                                            {{ $book->is_available ? 'Tersedia' : 'Terpinjam' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('admin.books.edit', $book->id) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.books.destroy', $book->id) }}"
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
                                    <td colspan="11" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data buku tersedia</p>
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
                    {{ $books->links('pagination::bootstrap-5') }}
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
