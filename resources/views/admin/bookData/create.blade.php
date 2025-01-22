@extends('admin.layouts.base')

@section('title', 'Tambah Buku')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card ">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-book-plus me-2"></i>
                            Tambah Data Buku
                        </h3>
                    </div>
                    <!-- Alert Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong>Terjadi Kesalahan!</strong>
                            </div>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Basic Information -->
                                    <h5 class="border-bottom pb-2 mb-4">Informasi Dasar</h5>
                                    <div class="mb-4">
                                        <label for="judul" class="form-label">Judul Buku <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="judul" id="judul"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="penulis" class="form-label">Penulis <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="penulis" id="penulis"
                                            class="form-control @error('penulis') is-invalid @enderror"
                                            value="{{ old('penulis') }}" placeholder="Masukkan nama penulis" required>
                                        @error('penulis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="penerbit" class="form-label">Penerbit <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="penerbit" id="penerbit"
                                            class="form-control @error('penerbit') is-invalid @enderror"
                                            value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit" required>
                                        @error('penerbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="isbn" class="form-label">ISBN <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="isbn" id="isbn"
                                            class="form-control @error('isbn') is-invalid @enderror"
                                            value="{{ old('isbn') }}" placeholder="Masukkan nomor ISBN" required>
                                        @error('isbn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="kode_unik" class="form-label">Kode Unik <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="kode_unik" id="kode_unik"
                                            class="form-control @error('kode_unik') is-invalid @enderror"
                                            value="{{ old('kode_unik') }}" placeholder="Masukkan kode unik buku" required>
                                        @error('kode_unik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Classification -->
                                    <h5 class="border-bottom pb-2 mb-4">Klasifikasi & Detail</h5>

                                    <div class="mb-4">
                                        <label for="peminatan" class="form-label">Peminatan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('peminatan') is-invalid @enderror" id="peminatan"
                                            name="peminatan" required>
                                            <option value="" disabled selected>Pilih Peminatan</option>
                                            @foreach (['Perangkat Lunak & Mobile Computing', 'Jaringan & Keamanan Komputer', 'Sistem Tertanam & Robotika', 'Multimedia', 'Diluar Peminatan'] as $option)
                                                <option value="{{ $option }}"
                                                    {{ old('peminatan') == $option ? 'selected' : '' }}>
                                                    {{ $option }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('peminatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="sub_peminatan" class="form-label">Sub Peminatan<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('sub_peminatan') is-invalid @enderror"
                                            id="sub_peminatan" name="sub_peminatan">
                                            <option value="" disabled selected>Pilih Sub Peminatan</option>
                                            @foreach (['Linux', 'Network Security', 'Computer Networks', 'Wireless Networks', 'IT Governance', 'Expert System', 'Embedded System', 'Robotics', 'Fuzzy', 'Computer Architecture & Organizations', 'Web Development', 'Mobile Development', 'Programming Language', 'Database', 'Information System', 'Computer Graphics', 'Matlab', 'Data Mining', 'Cryptography', 'Object-Oriented Programming', 'Algorithm & Data Structure', 'Human Computer Interaction', 'Data Communications', 'Multimedia', 'Game Development', 'Image Processing', 'Image & Video Editing', 'UI/UX Design'] as $subOption)
                                                <option value="{{ $subOption }}"
                                                    {{ old('sub_peminatan') == $subOption ? 'selected' : '' }}>
                                                    {{ $subOption }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('sub_peminatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="thumbnail" class="form-label">Thumbnail Buku</label>
                                        <div class="input-group">
                                            <input type="file" name="thumbnail" id="thumbnail"
                                                class="form-control @error('thumbnail') is-invalid @enderror"
                                                accept="image/png, image/jpeg, image/jpg">
                                            <label class="input-group-text" for="thumbnail">
                                                <i class="bi bi-image"></i>
                                            </label>
                                        </div>
                                        <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="synopsis" class="form-label">Synopsis</label>
                                        <textarea name="synopsis" id="synopsis" class="form-control @error('synopsis') is-invalid @enderror" rows="4"
                                            placeholder="Masukkan synopsis buku">{{ old('synopsis') }}</textarea>
                                        @error('synopsis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <div class="form-check form-switch">
                                            <input type="checkbox" name="is_available" id="is_available"
                                                class="form-check-input" value="1"
                                                {{ old('is_available', 1) ? 'checked' : '' }}>
                                            <label for="is_available" class="form-check-label">Status Ketersediaan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6 mb-2 mb-md-0">
                                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-1"></i> Kembali
                                    </a>
                                    <a href="{{ route('admin.downloadBook.template') }}" class="btn btn-warning">
                                        <i class="bi bi-download me-1"></i> Unduh Template
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 text-md-end text-center">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#uploadModal">
                                        <i class="bi bi-upload me-1"></i> Unggah melalui excel
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Upload modal -->
            <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Data Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Pastikan format file dan data sesuai dengan template. Download template terlebih dahulu jika
                                belum
                                memilikinya.
                            </div>
                            <form method="POST" action="{{ route('admin.books.import') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="file" class="form-label">Pilih File Excel</label>
                                    <input type="file" class="form-control" id="file" name="file"
                                        accept=".xlsx,.xls,.csv" required>
                                    <div class="form-text">Format yang didukung: .xlsx, .xls (maksimal 2MB)</div>
                                </div>
                                <div class="text-end">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-upload me-1"></i> Upload
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
