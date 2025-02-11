@extends('admin.layouts.base')

@section('title', 'Edit Data Capstone')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-square me-2"></i>
                            Form Edit Capstone
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.capstones.update', $capstone->id) }}"
                        enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="kode_kelompok" class="form-label">Kode Kelompok <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('kode_kelompok') is-invalid @enderror"
                                            id="kode_kelompok" name="kode_kelompok"
                                            value="{{ old('kode_kelompok', $capstone->kode_kelompok) }}" required>
                                        @error('kode_kelompok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="form-group mb-4">
                                            <label for="anggota{{ $i }}_nim" class="form-label">NIM Anggota
                                                {{ $i }}</label>
                                            <input type="text"
                                                class="form-control @error('anggota' . $i . '_nim') is-invalid @enderror"
                                                id="anggota{{ $i }}_nim" name="anggota{{ $i }}_nim"
                                                value="{{ old('anggota' . $i . '_nim', $capstone->{'anggota' . $i . '_nim'}) }}">
                                            @error('anggota' . $i . '_nim')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endfor
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="kategori" class="form-label">Kategori <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kategori') is-invalid @enderror"
                                            id="kategori" name="kategori"
                                            value="{{ old('kategori', $capstone->kategori) }}" required>
                                        @error('kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="judul_capstone" class="form-label">Judul Capstone <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('judul_capstone') is-invalid @enderror"
                                            id="judul_capstone" name="judul_capstone"
                                            value="{{ old('judul_capstone', $capstone->judul_capstone) }}" required>
                                        @error('judul_capstone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @php
                                        $fileFields = [
                                            'c100_path' => 'Dokumen C100',
                                            'c200_path' => 'Dokumen C200',
                                            'c300_path' => 'Dokumen C300',
                                            'c400_path' => 'Dokumen C400',
                                            'c500_path' => 'Dokumen C500',
                                        ];
                                    @endphp

                                    @foreach ($fileFields as $key => $label)
                                        <div class="form-group mb-4">
                                            <label for="{{ $key }}"
                                                class="form-label">{{ $label }}</label>
                                            <input type="file" class="form-control @error($key) is-invalid @enderror"
                                                id="{{ $key }}" name="{{ $key }}">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                                            @error($key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <a href="{{ route('admin.capstones.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 text-md-end text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
