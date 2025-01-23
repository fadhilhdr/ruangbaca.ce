@extends('superadmin.layouts.base')

@section('title', 'Edit Data Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-fill me-2"></i>
                            Form Edit Pegawai
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('superadmin.employees.update', $pegawai->id) }}"
                        class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Nama Lengkap -->
                                    <div class="form-group row mb-4">
                                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                id="nama_lengkap" name="nama_lengkap"
                                                value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}"
                                                placeholder="Masukkan Nama Lengkap" required>
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- NIP/NUPK -->
                                    <div class="form-group row mb-4">
                                        <label for="nip_nppu_nupk" class="col-sm-3 col-form-label">NIP/NUPK <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('nip_nppu_nupk') is-invalid @enderror"
                                                id="nip_nppu_nupk" name="nip_nppu_nupk"
                                                value="{{ old('nip_nppu_nupk', $pegawai->nip_nppu_nupk) }}"
                                                placeholder="Masukkan NIP/NUPK" required>
                                            @error('nip_nppu_nupk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Pangkat/Golongan -->
                                    <div class="form-group row mb-4">
                                        <label for="pangkat_golongan" class="col-sm-3 col-form-label">Pangkat/Golongan <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('pangkat_golongan') is-invalid @enderror"
                                                id="pangkat_golongan" name="pangkat_golongan"
                                                value="{{ old('pangkat_golongan', $pegawai->pangkat_golongan) }}"
                                                placeholder="Masukkan Pangkat/Golongan" required>
                                            @error('pangkat_golongan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Jabatan Fungsional -->
                                    <div class="form-group row mb-4">
                                        <label for="jabatan_fungsional" class="col-sm-3 col-form-label">Jabatan Fungsional
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('jabatan_fungsional') is-invalid @enderror"
                                                id="jabatan_fungsional" name="jabatan_fungsional"
                                                value="{{ old('jabatan_fungsional', $pegawai->jabatan_fungsional) }}"
                                                placeholder="Masukkan Jabatan Fungsional" required>
                                            @error('jabatan_fungsional')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Tugas Tambahan 1 -->
                                    <div class="form-group row mb-4">
                                        <label for="tugas_tambahan_1" class="col-sm-3 col-form-label">Tugas Tambahan
                                            1</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('tugas_tambahan_1') is-invalid @enderror"
                                                id="tugas_tambahan_1" name="tugas_tambahan_1"
                                                value="{{ old('tugas_tambahan_1', $pegawai->tugas_tambahan_1) }}"
                                                placeholder="Masukkan Tugas Tambahan 1">
                                            @error('tugas_tambahan_1')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Pendidikan Terakhir -->
                                    <div class="form-group row mb-4">
                                        <label for="pendidikan_terakhir" class="col-sm-3 col-form-label">Pendidikan Terakhir
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                id="pendidikan_terakhir" name="pendidikan_terakhir"
                                                value="{{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) }}"
                                                placeholder="Masukkan Pendidikan Terakhir" required>
                                            @error('pendidikan_terakhir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Jenis Kepegawaian -->
                                    <div class="form-group row mb-4">
                                        <label for="jenis_pegawai" class="col-sm-3 col-form-label">Jenis Pegawaian
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('jenis_pegawai') is-invalid @enderror"
                                                id="jenis_pegawai" name="jenis_pegawai" required>
                                                <option value="" disabled>Pilih Jenis Pegawaian</option>
                                                <option value="Tenaga Dosen"
                                                    {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'Tenaga Dosen' ? 'selected' : '' }}>
                                                    Tenaga Dosen
                                                </option>
                                                <option value="Tenaga Kependidikan Aktif"
                                                    {{ old('jenis_pegawai', $pegawai->jenis_pegawai) == 'Tenaga Kependidikan' ? 'selected' : '' }}>
                                                    Tenaga Kependidikan </option>
                                            </select>
                                            @error('jenis_pegawai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="status_kepegawaian" class="col-sm-3 col-form-label">Status Kepegawaian
                                            <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('status_kepegawaian') is-invalid @enderror"
                                                id="status_kepegawaian" name="status_kepegawaian" required>
                                                <option value="" disabled>Pilih Status Kepegawaian</option>
                                                <option value="Aktif"
                                                    {{ old('status_kepegawaian', $pegawai->status_kepegawaian) == 'Aktif' ? 'selected' : '' }}>
                                                    Aktif
                                                </option>
                                                <option value="Tidak Aktif"
                                                    {{ old('status_kepegawaian', $pegawai->status_kepegawaian) == 'Tidak Aktif' ? 'selected' : '' }}>
                                                    Tidak Aktif
                                                </option>
                                            </select>
                                            @error('status_kepegawaian')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Unit Kerja -->
                                    <div class="form-group row mb-4">
                                        <label for="unit_kerja" class="col-sm-3 col-form-label">Unit Kerja <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                class="form-control @error('unit_kerja') is-invalid @enderror"
                                                id="unit_kerja" name="unit_kerja"
                                                value="{{ old('unit_kerja', $pegawai->unit_kerja) }}"
                                                placeholder="Masukkan Unit Kerja" required>
                                            @error('unit_kerja')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('superadmin.employees.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
