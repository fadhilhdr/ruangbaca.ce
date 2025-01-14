@extends('admin.layouts.base')

@section('title', 'Indeks Mahasiswa')

@section('content')
    <div class="container-fluid">
        <!-- Search and Action Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-8">
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
                        <a href="#" class="btn btn-warning">
                            <i class="bi bi-file-earmark-arrow-up me-1"></i> Import
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-people me-2"></i> Daftar Mahasiswa
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary">Total: {{ $students->total() }} mahasiswa</span>
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
                                <th>Gender</th>
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
                                    <td>{{ $student->status }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.students.edit', $student->nim) }}"
                                                class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('admin.students.destroy', $student->nim) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this student?')"
                                                    data-bs-toggle="tooltip" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
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
