@extends('admin.layouts.base')

@section('title', 'Create Student')

@section('content')
    <div class="card card-primary card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Tambah Data Mahasiswa</div>
        </div> <!--end::Header-->

        <!--begin::Form-->
        <form method="POST" action="{{ route('admin.students.store') }}">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                        name="nim" value="{{ old('nim') }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <select class="form-select @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan"
                        required>
                        <option value="" disabled selected>Pilih Angkatan</option>
                        @foreach ([2019, 2020, 2021, 2022, 2023, 2024] as $year)
                            <option value="{{ $year }}" {{ old('angkatan') == $year ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                    @error('angkatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Jenis Kelamin</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                        required>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div> <!--end::Body-->

            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div> <!--end::Footer-->
        </form> <!--end::Form-->
    </div> <!--end::Quick Example-->
@endsection
