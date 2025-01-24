@extends('admin.layouts.base')

@section('title', 'Tambah Data Pegawai Lengkap')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-plus me-2"></i>Formulir Data Pegawai Lengkap
                </h3>
            </div>

            <form method="POST" action="{{ route('superadmin.employees.store') }}" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Column 1: Identitas Dasar -->
                        <div class="col-md-4">
                            <h5 class="border-bottom pb-2">Identitas Dasar</h5>

                            <!-- Nama Lengkap -->
                            <div class="form-group mb-3">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                    placeholder="Masukkan Nama Lengkap" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIP/NPPU/NUPK -->
                            <div class="form-group mb-3">
                                <label for="nip_nppu_nupk">NIP/NPPU/NUPK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nip_nppu_nupk') is-invalid @enderror"
                                    id="nip_nppu_nupk" name="nip_nppu_nupk" value="{{ old('nip_nppu_nupk') }}"
                                    placeholder="Masukkan NIP/NPPU/NUPK" required>
                                @error('nip_nppu_nupk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NIDN/NIDK/NUP/NITK -->
                            <div class="form-group mb-3">
                                <label for="nidn_nidk_nup_nitk">NIDN/NIDK/NUP/NITK</label>
                                <input type="text" class="form-control @error('nidn_nidk_nup_nitk') is-invalid @enderror"
                                    id="nidn_nidk_nup_nitk" name="nidn_nidk_nup_nitk"
                                    value="{{ old('nidn_nidk_nup_nitk') }}" placeholder="Masukkan NIDN/NIDK/NUP/NITK">
                                @error('nidn_nidk_nup_nitk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- NUPTK -->
                            <div class="form-group mb-3">
                                <label for="nuptk">NUPTK</label>
                                <input type="text" class="form-control @error('nuptk') is-invalid @enderror"
                                    id="nuptk" name="nuptk" value="{{ old('nuptk') }}" placeholder="Masukkan NUPTK">
                                @error('nuptk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Column 2: Kepegawaian -->
                        <div class="col-md-4">
                            <h5 class="border-bottom pb-2">Informasi Kepegawaian</h5>

                            <!-- Pangkat/Golongan -->
                            <div class="form-group mb-3">
                                <label for="pangkat_golongan">Pangkat/Golongan</label>
                                <input type="text" class="form-control @error('pangkat_golongan') is-invalid @enderror"
                                    id="pangkat_golongan" name="pangkat_golongan" value="{{ old('pangkat_golongan') }}"
                                    placeholder="Masukkan Pangkat/Golongan">
                                @error('pangkat_golongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jabatan Fungsional -->
                            <div class="form-group mb-3">
                                <label for="jabatan_fungsional">Jabatan Fungsional</label>
                                <input type="text" class="form-control @error('jabatan_fungsional') is-invalid @enderror"
                                    id="jabatan_fungsional" name="jabatan_fungsional"
                                    value="{{ old('jabatan_fungsional') }}" placeholder="Masukkan Jabatan Fungsional">
                                @error('jabatan_fungsional')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tugas Tambahan 1-4 -->
                            @foreach (['1', '2', '3', '4'] as $index)
                                <div class="form-group mb-3">
                                    <label for="tugas_tambahan_{{ $index }}">Tugas Tambahan
                                        {{ $index }}</label>
                                    <input type="text"
                                        class="form-control @error('tugas_tambahan_' . $index) is-invalid @enderror"
                                        id="tugas_tambahan_{{ $index }}" name="tugas_tambahan_{{ $index }}"
                                        value="{{ old('tugas_tambahan_' . $index) }}"
                                        placeholder="Masukkan Tugas Tambahan {{ $index }}">
                                    @error('tugas_tambahan_' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <!-- Column 3: Informasi Tambahan -->
                        <div class="col-md-4">
                            <h5 class="border-bottom pb-2">Informasi Tambahan</h5>

                            <!-- Kepakaran -->
                            <div class="form-group mb-3">
                                <label for="kepakaran">Kepakaran</label>
                                <input type="text" class="form-control @error('kepakaran') is-invalid @enderror"
                                    id="kepakaran" name="kepakaran" value="{{ old('kepakaran') }}"
                                    placeholder="Masukkan Kepakaran">
                                @error('kepakaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Pendidikan Terakhir -->
                            <div class="form-group mb-3">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text"
                                    class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                    id="pendidikan_terakhir" name="pendidikan_terakhir"
                                    value="{{ old('pendidikan_terakhir') }}" placeholder="Masukkan Pendidikan Terakhir">
                                @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jurusan -->
                            <div class="form-group mb-3">
                                <label for="jurusan">Jurusan</label>
                                <input type="text" class="form-control @error('jurusan') is-invalid @enderror"
                                    id="jurusan" name="jurusan" value="{{ old('jurusan') }}"
                                    placeholder="Masukkan Jurusan">
                                @error('jurusan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Bekerja -->
                            <div class="form-group mb-3">
                                <label for="status_bekerja">Status Bekerja</label>
                                <select class="form-select @error('status_bekerja') is-invalid @enderror"
                                    id="status_bekerja" name="status_bekerja">
                                    <option value="">Pilih Status Bekerja</option>
                                    <option value="Aktif" {{ old('status_bekerja') == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Non-Aktif"
                                        {{ old('status_bekerja') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                @error('status_bekerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Kepegawaian -->
                            <div class="form-group mb-3">
                                <label for="status_kepegawaian">Status Kepegawaian</label>
                                <select class="form-select @error('status_kepegawaian') is-invalid @enderror"
                                    id="status_kepegawaian" name="status_kepegawaian">
                                    <option value="">Pilih Status Kepegawaian</option>
                                    <option value="PNS" {{ old('status_kepegawaian') == 'PNS' ? 'selected' : '' }}>PNS
                                    </option>
                                    <option value="Non-PNS"
                                        {{ old('status_kepegawaian') == 'Non-PNS' ? 'selected' : '' }}>Non-PNS</option>
                                </select>
                                @error('status_kepegawaian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Columns -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <!-- Jenis Pegawai -->
                            <div class="form-group mb-3">
                                <label for="jenis_pegawai">Jenis Pegawai</label>
                                <select class="form-control @error('jenis_pegawai') is-invalid @enderror"
                                    id="jenis_pegawai" name="jenis_pegawai">
                                    <option value="" disabled selected>Pilih Jenis Pegawai</option>
                                    <option value="Tenaga Dosen"
                                        {{ old('jenis_pegawai') == 'Tenaga Dosen' ? 'selected' : '' }}>Tenaga Dosen
                                    </option>
                                    <option value="Tenaga Kependidikan"
                                        {{ old('jenis_pegawai') == 'Tenaga Kependidikan' ? 'selected' : '' }}>Tenaga
                                        Kependidikan</option>
                                </select>
                                @error('jenis_pegawai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <!-- Unit Kerja -->
                            <div class="form-group mb-3">
                                <label for="unit_kerja">Unit Kerja</label>
                                <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"
                                    id="unit_kerja" name="unit_kerja" value="{{ old('unit_kerja') }}"
                                    placeholder="Masukkan Unit Kerja">
                                @error('unit_kerja')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Bagian -->
                            <div class="form-group mb-3">
                                <label for="bagian">Bagian</label>
                                <input type="text" class="form-control @error('bagian') is-invalid @enderror"
                                    id="bagian" name="bagian" value="{{ old('bagian') }}"
                                    placeholder="Masukkan Bagian">
                                @error('bagian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Last Row -->
                    <div class="row">
                        <div class="col-md-4">
                            <!-- Subbagian -->
                            <div class="form-group mb-3">
                                <label for="subbagian">Subbagian</label>
                                <input type="text" class="form-control @error('subbagian') is-invalid @enderror"
                                    id="subbagian" name="subbagian" value="{{ old('subbagian') }}"
                                    placeholder="Masukkan Subbagian">
                                @error('subbagian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <a href="{{ route('superadmin.employees.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                        <div class="col d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
