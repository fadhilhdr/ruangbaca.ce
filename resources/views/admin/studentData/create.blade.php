@extends('admin.layouts.base')

@section('title', 'Tambah Data Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            Form Tambah Mahasiswa
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('admin.students.store') }}" class="form-horizontal">
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
                                            <select class="form-select @error('angkatan') is-invalid @enderror"
                                                id="angkatan" name="angkatan" required>
                                                <option value="" disabled selected>Pilih Angkatan</option>
                                                @foreach ([2019, 2020, 2021, 2022, 2023, 2024] as $year)
                                                    <option value="{{ $year }}"
                                                        {{ old('angkatan') == $year ? 'selected' : '' }}>{{ $year }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('angkatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Gender -->
                                    <div class="form-group row mb-4">
                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
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
                                        <label for="status" class="col-sm-3 col-form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('status') is-invalid @enderror" id="status"
                                                name="status" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="Tidak Aktif"
                                                    {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
