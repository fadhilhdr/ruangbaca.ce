@extends('admin.layouts.base')

@section('title', 'Edit Lecturer')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Data Lecturer</h3>
        </div>
        <form method="POST" action="{{ route('admin.lecturers.update', $lecturer->nip) }}">
            @csrf
            @method('PUT') <!-- Metode PUT untuk update -->
            <div class="card-body">
                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip"
                        name="nip" value="{{ old('nip', $lecturer->nip) }}" required>
                    @error('nip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $lecturer->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kode_dosen" class="form-label">Kode Dosen</label>
                    <input type="text" class="form-control @error('kode_dosen') is-invalid @enderror" id="kode_dosen"
                        name="kode_dosen" value="{{ old('kode_dosen', $lecturer->kode_dosen) }}" required>
                    @error('kode_dosen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="riwayat_s1" class="form-label">Riwayat S1</label>
                    <input type="text" class="form-control @error('riwayat_s1') is-invalid @enderror" id="riwayat_s1"
                        name="riwayat_s1" value="{{ old('riwayat_s1', $lecturer->riwayat_s1) }}" required>
                    @error('riwayat_s1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="riwayat_s2" class="form-label">Riwayat S2</label>
                    <input type="text" class="form-control @error('riwayat_s2') is-invalid @enderror" id="riwayat_s2"
                        name="riwayat_s2" value="{{ old('riwayat_s2', $lecturer->riwayat_s2) }}" required>
                    @error('riwayat_s2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="riwayat_s3" class="form-label">Riwayat S3</label>
                    <input type="text" class="form-control @error('riwayat_s3') is-invalid @enderror" id="riwayat_s3"
                        name="riwayat_s3" value="{{ old('riwayat_s3', $lecturer->riwayat_s3) }}">
                    @error('riwayat_s3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kepakaran1" class="form-label">Kepakaran 1</label>
                    <input type="text" class="form-control @error('kepakaran1') is-invalid @enderror" id="kepakaran1"
                        name="kepakaran1" value="{{ old('kepakaran1', $lecturer->kepakaran1) }}" required>
                    @error('kepakaran1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kepakaran2" class="form-label">Kepakaran 2</label>
                    <input type="text" class="form-control @error('kepakaran2') is-invalid @enderror" id="kepakaran2"
                        name="kepakaran2" value="{{ old('kepakaran2', $lecturer->kepakaran2) }}">
                    @error('kepakaran2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
