@extends('admin.layouts.base')

@section('title', 'Edit Data Dokumen')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3 mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-pencil-square me-2"></i>
                            Form Edit Dokumen
                        </h3>
                    </div>
                    <form method="POST" action="{{ route('admin.document.update', $dokumen->id) }}"
                        enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="nim" class="form-label">NIM <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                            id="nim" name="nim" value="{{ old('nim', $dokumen->nim) }}" required>
                                        @error('nim')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title" class="form-label">Judul <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $dokumen->title) }}"
                                            required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="cover_abstract" class="form-label">Cover Abstrak</label>
                                        <input type="file"
                                            class="form-control @error('cover_abstract') is-invalid @enderror"
                                            id="cover_abstract" name="cover_abstract">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                                        @error('cover_abstract')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @php

                                        $babFields = [
                                            'bab1_pendahuluan' => 'Bab 1: Pendahuluan',
                                            'bab2_kajianpustaka' => 'Bab 2: Kajian Pustaka',
                                            'bab3_perancangan' => 'Bab 3: Metodologi',
                                            'bab4_hasilpembahasan' => 'Bab 4: Implementasi',
                                            'bab5_penutup' => 'Bab 5: Kesimpulan',
                                        ];
                                    @endphp

                                    @foreach ($babFields as $key => $label)
                                        <div class="form-group mb-4">
                                            <label for="{{ $key }}" class="form-label">{{ $label }}</label>
                                            <input type="file" class="form-control @error($key) is-invalid @enderror"
                                                id="{{ $key }}" name="{{ $key }}">
                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
                                            @error($key)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endforeach

                                    <div class="form-group mb-4">
                                        <label for="lampiran" class="form-label">Lampiran (Opsional)</label>
                                        <input type="file" class="form-control @error('lampiran') is-invalid @enderror"
                                            id="lampiran" name="lampiran">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah.</small>
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
