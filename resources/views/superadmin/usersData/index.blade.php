@extends('superadmin.layouts.base')

@section('title', 'Indeks Pengguna')

@section('content')
    <div class="container-fluid">
        <!-- Search and Filter Card -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-4">
                        <form action="{{ route('superadmin.users.index') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control me-2" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari nama/userid...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>
                            </button>
                        </form>
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
                        Total: {{ $users->total() }} Pengguna
                    </span>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 40px">NO</th>
                                <th>id</th>
                                <th>User ID</th>
                                <th>Nama</th>
                                <th>Role ID</th>
                                <th class="text-center" style="width: 100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $index => $user)
                                <tr class="align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->userid }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        @if ($user->role->name == 'Admin')
                                            <span class="badge bg-primary">Admin</span>
                                        @elseif($user->role->name == 'Superadmin')
                                            <span class="badge bg-success">Super Admin</span>
                                        @elseif($user->role->name == 'Member')
                                            <span class="badge bg-warning text-dark">Member</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('superadmin.users.edit', $user->userid) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('superadmin.users.destroy', $user->userid) }}"
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
                                            <p class="text-muted mt-2">Tidak ada data pengguna tersedia</p>
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
                    {{ $users->links('pagination::bootstrap-5') }}
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
