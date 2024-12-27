@extends('admin.layouts.base')

@section('title', 'Edit Student')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Data Student</h3>
        </div>
        <form method="POST" action="{{ route('admin.students.update', $student->nim) }}">
            @csrf
            @method('PUT') <!-- Metode PUT untuk update -->
            <div class="card-body">
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                        name="nim" value="{{ old('nim', $student->nim) }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $student->name) }}" required>
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
                            <option value="{{ $year }}"
                                {{ old('angkatan', $student->angkatan) == $year ? 'selected' : '' }}>
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
                        <option value="Laki-laki" {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
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
                        <option value="Aktif" {{ old('status', $student->status) == 'Aktif' ? 'selected' : '' }}>Aktif
                        </option>
                        <option value="Tidak Aktif"
                            {{ old('status', $student->status) == 'Tidak Aktif' ? 'selected' : '' }}>
                            Tidak Aktif</option>
                    </select>
                    @error('status')
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
