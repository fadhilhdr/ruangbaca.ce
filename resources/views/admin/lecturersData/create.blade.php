@extends('admin.layouts.base')

@section('title', 'Tambah Data Dosen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Form Tambah Dosen
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('admin.lecturers.store') }}" class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <!-- Two Column Layout -->
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- NIP -->
                                    <div class="form-group row mb-4">
                                        <label for="nip" class="col-sm-3 col-form-label">NIP <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                                id="nip" name="nip" value="{{ old('nip') }}"
                                                placeholder="Masukkan NIP" required>
                                            @error('nip')
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

                                    <!-- Kode Dosen -->
                                    <div class="form-group row mb-4">
                                        <label for="kode_dosen" class="col-sm-3 col-form-label">Kode Dosen <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('kode_dosen') is-invalid @enderror"
                                                id="kode_dosen" name="kode_dosen" value="{{ old('kode_dosen') }}"
                                                placeholder="Masukkan Kode Dosen" required>
                                            @error('kode_dosen')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Riwayat S1 -->
                                    <div class="form-group row mb-4">
                                        <label for="riwayat_s1" class="col-sm-3 col-form-label">Riwayat S1 <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('riwayat_s1') is-invalid @enderror"
                                                id="riwayat_s1" name="riwayat_s1" value="{{ old('riwayat_s1') }}"
                                                placeholder="Masukkan Riwayat S1" required>
                                            @error('riwayat_s1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Riwayat S2 -->
                                    <div class="form-group row mb-4">
                                        <label for="riwayat_s2" class="col-sm-3 col-form-label">Riwayat S2 <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('riwayat_s2') is-invalid @enderror"
                                                id="riwayat_s2" name="riwayat_s2" value="{{ old('riwayat_s2') }}"
                                                placeholder="Masukkan Riwayat S2" required>
                                            @error('riwayat_s2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Riwayat S3 -->
                                    <div class="form-group row mb-4">
                                        <label for="riwayat_s3" class="col-sm-3 col-form-label">Riwayat S3</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('riwayat_s3') is-invalid @enderror"
                                                id="riwayat_s3" name="riwayat_s3" value="{{ old('riwayat_s3') }}"
                                                placeholder="Masukkan Riwayat S3">
                                            @error('riwayat_s3')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kepakaran 1 -->
                                    <div class="form-group row mb-4">
                                        <label for="kepakaran1" class="col-sm-3 col-form-label">Kepakaran 1 <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('kepakaran1') is-invalid @enderror"
                                                id="kepakaran1" name="kepakaran1" value="{{ old('kepakaran1') }}"
                                                placeholder="Masukkan Kepakaran 1" required>
                                            @error('kepakaran1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Kepakaran 2 -->
                                    <div class="form-group row mb-4">
                                        <label for="kepakaran2" class="col-sm-3 col-form-label">Kepakaran 2</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('kepakaran2') is-invalid @enderror"
                                                id="kepakaran2" name="kepakaran2" value="{{ old('kepakaran2') }}"
                                                placeholder="Masukkan Kepakaran 2">
                                            @error('kepakaran2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer row">
                            <div class=" col d-flex justify conntent-start">
                                <a href="{{ route('admin.lecturers.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>

                            </div>
                            <div class=" col d-flex justify-content-end gap-3">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#uploadModal">
                                    <i class="bi bi-upload me-1"></i> Unggah melalui excel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload Data </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.lecturers.import') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="file" class="form-label">Pilih File</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->has('upload'))
            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-danger" id="errorModalLabel">Validasi Gagal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @foreach ($errors->get('upload') as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                });
            </script>
        @endif
    </div>
@endsection
