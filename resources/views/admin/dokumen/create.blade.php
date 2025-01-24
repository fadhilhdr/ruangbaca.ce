@extends('admin.layouts.base')

@section('title', 'Tambah Data Dokumen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-file-earmark-plus-fill me-2"></i>
                            Form Tambah Dokumen
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.document.store') }}" enctype="multipart/form-data"
                        class="form-horizontal">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="nim" class="form-label">NIM <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                            id="nim" name="nim" value="{{ old('nim') }}"
                                            placeholder="Masukkan NIM" required>
                                        @error('nim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="judul" class="form-label">Judul <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                            id="judul" name="judul" value="{{ old('judul') }}"
                                            placeholder="Masukkan Judul" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="cover_abstrak" class="form-label">Cover Abstrak <span
                                                class="text-danger">*</span></label>
                                        <input type="file"
                                            class="form-control @error('cover_abstrak') is-invalid @enderror"
                                            id="cover_abstrak" name="cover_abstrak" required>
                                        @error('cover_abstrak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @php
                                        $babFields = [
                                            'bab1_pendahuluan' => 'Bab 1: Pendahuluan',
                                            'bab2_kajian_pustaka' => 'Bab 2: Kajian Pustaka',
                                            'bab3_metodologi' => 'Bab 3: Metodologi',
                                            'bab4_implementasi' => 'Bab 4: Implementasi',
                                            'bab5_kesimpulan' => 'Bab 5: Kesimpulan',
                                        ];
                                    @endphp

                                    @foreach ($babFields as $key => $label)
                                        <div class="form-group mb-4">
                                            <label for="{{ $key }}" class="form-label">{{ $label }}
                                                <span class="text-danger">*</span></label>
                                            <input type="file" class="form-control @error($key) is-invalid @enderror"
                                                id="{{ $key }}" name="{{ $key }}" required>
                                            @error($key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group mb-4">
                                        <label for="lampiran" class="form-label">Lampiran (Opsional)</label>
                                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                            id="lampiran" name="lampiran">
                                        @error('lampiran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <a href="{{ route('admin.document.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 text-md-end text-center">
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
@endsection
