@extends('admin.layouts.base')

@section('title', 'Indeks Capstone')

@section('content')
    <div class="container-fluid">
        <!-- Search and Action Bar -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-4">
                        <form action="{{ route('admin.capstones.index') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control me-2" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari kode kelompok atau judul...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('admin.capstones.create') }}" class="btn btn-success me-2">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Capstone
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Capstone Table -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-mortarboard me-2"></i> Daftar Capstone
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary">Total: {{ $capstones->count() }} Capstone</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 40px">NO</th>
                                <th>Kode Kelompok</th>
                                <th>Anggota 1</th>
                                <th>Anggota 2</th>
                                <th>Anggota 3</th>
                                <th>Judul Capstone</th>
                                <th>C100</th>
                                <th>C200</th>
                                <th>C300</th>
                                <th>C400</th>
                                <th>C500</th>
                                <th class="text-center" style="width: 100px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($capstones as $index => $capstone)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $capstone->kode_kelompok }}</td>
                                    <td>{{ $capstone->anggota1->name }}</td>
                                    <td>{{ $capstone->anggota2->name }}</td>
                                    <td> {{ $capstone->anggota3->name }}</td>
                                    <td>{{ $capstone->judul_capstone }}</td>
                                    <td>
                                        <a href="{{ Storage::url($capstone->c100_path) }}" target="_blank">C100</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($capstone->c200_path) }}" target="_blank">C200</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($capstone->c300_path) }}" target="_blank">C300</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($capstone->c400_path) }}" target="_blank">C400</a>
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($capstone->c500_path) }}" target="_blank">C500</a>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('admin.capstones.edit', $capstone->id) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.capstones.destroy', $capstone->id) }}"
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
                                    <td colspan="10" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data capstone tersedia</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
