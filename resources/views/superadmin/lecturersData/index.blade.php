@extends('superadmin.layouts.base')

@section('title', 'Indeks Mahasiswa')

@section('content')
    <div class="container-fluid">
        <!-- Search and Filter Card -->

        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-4">
                        <form action="{{ route('superadmin.employees.index') }}" method="GET" class="d-flex">
                            <input type="text" class="form-control me-2" id="search" name="search"
                                value="{{ request('search') }}" placeholder="Cari nama...">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search me-1"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('superadmin.employees.create') }}" class="btn btn-success me-2">
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
                    <i class="bi bi-people me-2"></i> Daftar Pegawai
                </h3>
                <div class="card-tools">
                    <span class="badge bg-primary rounded-pill px-4 py-2">
                        Total: {{ $pegawais->total() }} Pegawai
                    </span>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NIP/NPPU/NUPK</th>
                                <th>NIDN/NIDK/NUP/NITK</th>
                                <th>NUPTK</th>
                                <th>Pangkat/Golongan</th>
                                <th>Jabatan Fungsional</th>
                                <th>Tugas Tambahan 1</th>
                                <th>Tugas Tambahan 2</th>
                                <th>Tugas Tambahan 3</th>
                                <th>Tugas Tambahan 4</th>
                                <th>Kepakaran</th>
                                <th>Pendidikan Terakhir</th>
                                <th>Jurusan</th>
                                <th>Status Bekerja</th>
                                <th>Status Kepegawaian</th>
                                <th>Jenis Pegawai</th>
                                <th>Unit Kerja</th>
                                <th>Bagian</th>
                                <th>Subbagian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $index => $pegawai)
                                <tr>
                                    <td>{{ $loop->iteration + ($pegawais->currentPage() - 1) * $pegawais->perPage() }}</td>
                                    <td>{{ $pegawai->nama_lengkap }}</td>
                                    <td>{{ $pegawai->nip_nppu_nupk }}</td>
                                    <td>{{ $pegawai->nidn_nidk_nup_nitk }}</td>
                                    <td>{{ $pegawai->nuptk }}</td>
                                    <td>{{ $pegawai->pangkat_golongan }}</td>
                                    <td>{{ $pegawai->jabatan_fungsional }}</td>
                                    <td>{{ $pegawai->tugas_tambahan_1 }}</td>
                                    <td>{{ $pegawai->tugas_tambahan_2 }}</td>
                                    <td>{{ $pegawai->tugas_tambahan_3 }}</td>
                                    <td>{{ $pegawai->tugas_tambahan_4 }}</td>
                                    <td>{{ $pegawai->kepakaran }}</td>
                                    <td>{{ $pegawai->pendidikan_terakhir }}</td>
                                    <td>{{ $pegawai->jurusan }}</td>
                                    <td>{{ $pegawai->status_bekerja }}</td>
                                    <td>{{ $pegawai->status_kepegawaian }}</td>
                                    <td>{{ $pegawai->jenis_pegawai }}</td>
                                    <td>{{ $pegawai->unit_kerja }}</td>
                                    <td>{{ $pegawai->bagian }}</td>
                                    <td>{{ $pegawai->subbagian }}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm border-0 rounded-circle shadow-sm"
                                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li>
                                                    <a href="{{ route('superadmin.employees.edit', $pegawai->nip_nppu_nupk) }}"
                                                        class="dropdown-item py-2 px-4">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i>
                                                        Edit Data
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('superadmin.employees.destroy', $pegawai->nip_nppu_nupk) }}"
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <div class="float-end">
                    {{ $pegawais->links('pagination::bootstrap-5') }}
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
