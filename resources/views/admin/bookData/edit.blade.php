@extends('admin.layouts.base')

@section('title', 'Edit Book')

@section('content')
    <div class="card">
        <!-- Error Alert -->
        @if ($errors->has('thumbnail'))
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                <strong>Error!</strong> {{ $errors->first('thumbnail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card Header -->
        <div class="card-header">
            <h3 class="card-title">Edit Buku</h3>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                value="{{ old('judul', $book->judul) }}" required>
                        </div>

                        <!-- Penulis -->
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control"
                                value="{{ old('penulis', $book->penulis) }}" required>
                        </div>

                        <!-- Penerbit -->
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control"
                                value="{{ old('penerbit', $book->penerbit) }}" required>
                        </div>

                        <!-- ISBN -->
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="form-control"
                                value="{{ old('isbn', $book->isbn) }}" required>
                        </div>

                        <!-- Kode Unik -->
                        <div class="mb-3">
                            <label for="kode_unik" class="form-label">Kode Unik</label>
                            <input type="text" name="kode_unik" id="kode_unik" class="form-control"
                                value="{{ old('kode_unik', $book->kode_unik) }}" required>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Peminatan -->
                        <div class="mb-3">
                            <label for="peminatan" class="form-label">Peminatan</label>
                            <select class="form-select @error('peminatan') is-invalid @enderror" id="peminatan"
                                name="peminatan" required>
                                <option value="" disabled selected>Pilih Peminatan</option>
                                @foreach (['Perangkat Lunak & Mobile Computing', 'Jaringan & Keamanan Komputer', 'Sistem Tertanam & Robotika', 'Multimedia', 'Diluar Peminatan'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old('peminatan', $book->peminatan) == $option ? 'selected' : '' }}>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                            @error('peminatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sub Peminatan -->
                        <div class="mb-3">
                            <label for="sub_peminatan" class="form-label">Sub Peminatan</label>
                            <select class="form-select @error('sub_peminatan') is-invalid @enderror" id="sub_peminatan"
                                name="sub_peminatan">
                                <option value="" disabled selected>Pilih Sub Peminatan</option>
                                @foreach (['Linux', 'Network Security', 'Computer Networks', 'Wireless Networks', 'IT Governance', 'Expert System', 'Embedded System', 'Robotics', 'Fuzzy', 'Computer Architecture & Organizations', 'Web Development', 'Mobile Development', 'Programming Language', 'Database', 'Information System', 'Computer Graphics', 'Matlab', 'Data Mining', 'Cryptography', 'Object-Oriented Programming', 'Algorithm & Data Structure', 'Human Computer Interaction', 'Data Communications', 'Multimedia', 'Game Development', 'Image Processing', 'Image & Video Editing', 'UI/UX Design'] as $subOption)
                                    <option value="{{ $subOption }}"
                                        {{ old('sub_peminatan', $book->sub_peminatan) == $subOption ? 'selected' : '' }}>
                                        {{ $subOption }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_peminatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control"
                                accept="image/png, image/jpeg, image/jpg">
                            @if ($book->thumbnail)
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail" class="mt-2"
                                    width="150">
                            @endif
                        </div>

                        <!-- Synopsis -->
                        <div class="mb-3">
                            <label for="synopsis" class="form-label">Synopsis</label>
                            <textarea name="synopsis" id="synopsis" class="form-control" rows="4">{{ old('synopsis', $book->synopsis) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_available" id="is_available" class="form-check-input"
                                    value="1" {{ old('is_available', 1) ? 'checked' : '' }}>
                                <label for="is_available" class="form-check-label">Status Ketersediaan</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Update Book</button>
                </div>
            </form>

        </div>
    </div>
@endsection
