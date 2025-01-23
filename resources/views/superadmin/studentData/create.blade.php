@extends('superadmin.layouts.base')

@section('title', 'Tambah Data Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Form Tambah Mahasiswa
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('superadmin.students.store') }}" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <!-- Two Column Layout -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- NIM -->
                                    <div class="form-group row mb-4">
                                        <label for="nim" class="col-sm-3 col-form-label">NIM <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                id="nim" name="nim" value="{{ old('nim') }}"
                                                placeholder="Masukkan NIM" required>
                                            @error('nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Nama -->
                                    <div class="form-group row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Nama <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name') }}"
                                                placeholder="Masukkan Nama Lengkap" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Angkatan -->
                                    <div class="form-group row mb-4">
                                        <label for="angkatan" class="col-sm-3 col-form-label">Angkatan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number"
                                                class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                                                name="angkatan" value="{{ old('angkatan') }}"
                                                placeholder="Masukkan Angkatan" required>
                                            @error('angkatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Jalur Masuk -->
                                    <div class="form-group row mb-4">
                                        <label for="jalur_masuk" class="col-sm-3 col-form-label">Jalur Masuk <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('jalur_masuk') is-invalid @enderror"
                                                id="jalur_masuk" name="jalur_masuk" value="{{ old('jalur_masuk') }}"
                                                placeholder="Masukkan Jalur Masuk" required>
                                            @error('jalur_masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Gender -->
                                    <div class="form-group row mb-4">
                                        <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                                name="gender" required>
                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group row mb-4">
                                        <label for="status_terakhir" class="col-sm-4 col-form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="form-select @error('status_terakhir') is-invalid @enderror"
                                                id="status_terakhir" name="status_terakhir" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="Aktif"
                                                    {{ old('status_terakhir') == 'Aktif' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="Tidak Aktif"
                                                    {{ old('status_terakhir') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                                    Aktif
                                                </option>
                                            </select>
                                            @error('status_terakhir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Program Studi -->
                                    <div class="form-group row mb-4">
                                        <label for="prodi" class="col-sm-4 col-form-label">Program Studi <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                                id="prodi" name="prodi" value="{{ old('prodi') }}"
                                                placeholder="Masukkan Program Studi" required>
                                            @error('prodi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row d-flex justify-content-between">
                                <div class="col">
                                    <a href="" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <a href="#" class="btn btn-warning">
                                        <i class="bi bi-download me-1"></i> Unduh Template
                                    </a>

                                </div>
                                <div class="col text-end">

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#uploadModal">
                                        <i class="bi bi-upload me-1"></i> Unggah melalui excel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan
                                    </button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Pastikan format file dan data sesuai dengan template. Download template terlebih dahulu jika belum
                        memilikinya.
                    </div>
                    <form method="POST" action="{{ route('admin.students.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="file" class="form-label">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file"
                                accept=".xlsx,.xls,.csv" required>
                            <div class="form-text">Format yang didukung: .xlsx, .xls (maksimal 2MB)</div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-upload me-1"></i> Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
