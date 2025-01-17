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
                                    value="{{ request('search') }}" placeholder="Cari judul, penulis, atau ISBN...">
                            </div>
                            <div class="col-md-3">
                                <label for="peminatan" class="form-label">Peminatan</label>
                                <select class="form-select" name="peminatan" id="peminatan">
                                    <option value="Semua Peminatan">Semua Peminatan</option>
                                    <option value="Perangkat Lunak & Mobile Computing">Perangkat Lunak & Mobile Computing
                                    </option>
                                    <option value="Jaringan & Keamanan Komputer">Jaringan & Keamanan Komputer</option>
                                    <option value="Sistem Tertanam & Robotika">Sistem Tertanam & Robotika</option>
                                    <option value="Multimedia">Multimedia</option>
                                    <option value="Diluar Peminatan">Diluar Peminatans</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" name="status" id="status">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Terpinjam
                                    </option>
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
                    <span class="badge bg-primary">Total: {{ $books->total() }} buku</span>
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
                                        <div class="btn-group">
                                            <a href="{{ route('admin.books.edit', $book->id) }}"
                                                class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this book?')"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
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
