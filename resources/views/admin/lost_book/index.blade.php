@extends('admin.layouts.base')

@section('title', 'Daftar Buku Hilang')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div class="col-sm-4">
                            <form action="{{ route('admin.lost-books.index') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="search" name="search" id="search" class="form-control"
                                        placeholder="Cari berdasarkan nama pengguna..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-book-x me-2"></i> Daftar Buku Hilang
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>Judul Buku</th>
                                <th>ISBN</th>
                                <th>Tanggal Dilaporkan</th>
                                <th>Status Penggantian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lostBooks as $index => $book)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $book->bookLoan->user->name ?? 'N/A' }}</td>
                                    <td>{{ $book->bookLoan->book->judul ?? 'N/A' }}</td>
                                    <td>{{ $book->isbn }}</td>
                                    <td>{{ \Carbon\Carbon::parse($book->date_reported)->format('d-m-Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($book->replacement_status) {
                                                'awaiting_verif' => 'bg-warning',
                                                'verified' => 'bg-success',
                                                'decline' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };

                                            $statusText = match ($book->replacement_status) {
                                                'awaiting_verif' => 'Menunggu Verifikasi',
                                                'verified' => 'Terverifikasi',
                                                'decline' => 'Ditolak',
                                                default => 'Status Tidak Diketahui', // Untuk status lainnya
                                            };
                                        @endphp
                                        <div
                                            class="text-white text-center font-semibold rounded px-2 py-1 {{ $statusClass }}">
                                            {{ $statusText }}
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.lost-books.updateStatus', $book->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="replacement_status" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="awaiting_verif"
                                                    {{ $book->replacement_status == 'awaiting_verif' ? 'selected' : '' }}>
                                                    Menunggu Verifikasi</option>
                                                <option value="verified"
                                                    {{ $book->replacement_status == 'verified' ? 'selected' : '' }}>
                                                    Terverifikasi
                                                </option>
                                                <option value="decline"
                                                    {{ $book->replacement_status == 'decline' ? 'selected' : '' }}>Ditolak
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data buku hilang</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
