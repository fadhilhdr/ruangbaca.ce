@extends('admin.layouts.base')

@section('title', 'Edit Data Mahasiswa')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-fill me-2"></i>
                            Form Edit Mahasiswa
                        </h3>
                    </div>

                    <form method="POST" action="{{ route('admin.students.update', $student->nim) }}" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- NIM -->
                                    <div class="form-group row mb-4">
                                        <label for="nim" class="col-sm-3 col-form-label">NIM <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                                id="nim" name="nim" value="{{ old('nim', $student->nim) }}"
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
                                                id="name" name="name" value="{{ old('name', $student->name) }}"
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
                                                <option value="" disabled>Pilih Angkatan</option>
                                                @foreach ([2019, 2020, 2021, 2022, 2023, 2024] as $year)
                                                    <option value="{{ $year }}"
                                                        {{ old('angkatan', $student->angkatan) == $year ? 'selected' : '' }}>
                                                        {{ $year }}</option>
                                                @endforeach
                                            </select>
                                            @error('angkatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Prodi -->
                                    <div class="form-group row mb-4">
                                        <label for="prodi" class="col-sm-3 col-form-label">Prodi <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control @error('prodi') is-invalid @enderror"
                                                id="prodi" name="prodi" value="{{ old('prodi', $student->prodi) }}"
                                                placeholder="Masukkan Program Studi" required>
                                            @error('prodi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <!-- Gender -->
                                    <div class="form-group row mb-4">
                                        <label for="gender" class="col-sm-3 col-form-label">Jenis Kelamin <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('gender') is-invalid @enderror" id="gender"
                                                name="gender" required>
                                                <option value="" disabled>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki"
                                                    {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group row mb-4">
                                        <label for="status_terakhir" class="col-sm-3 col-form-label">Status <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-select @error('status_terakhir') is-invalid @enderror"
                                                id="status_terakhir" name="status_terakhir" required>
                                                <option value="" disabled>Pilih Status</option>
                                                <option value="Aktif"
                                                    {{ old('status_terakhir', $student->status_terakhir) == 'Aktif' ? 'selected' : '' }}>
                                                    Aktif</option>
                                                <option value="Tidak Aktif"
                                                    {{ old('status_terakhir', $student->status_terakhir) == 'Tidak Aktif' ? 'selected' : '' }}>
                                                    Tidak Aktif</option>
                                            </select>
                                            @error('status_terakhir')
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
                                                id="jalur_masuk" name="jalur_masuk"
                                                value="{{ old('jalur_masuk', $student->jalur_masuk) }}"
                                                placeholder="Masukkan Jalur Masuk" required>
                                            @error('jalur_masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">
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
