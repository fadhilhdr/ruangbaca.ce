@extends('admin.layouts.base')

@section('title', 'Daftar Denda')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div class="col-sm-4">
                            <form action="{{ route('admin.fines.index') }}" method="GET" class="d-flex">
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
                        <i class="bi bi-book me-2"></i> Daftar Denda
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Peminjam</th>
                                <th>Jumlah Denda</th>
                                <th>Status</th>
                                <th>Bukti Transfer</th>
                                <th>Dibayar Pada</th>
                                <th>Verifikasi Pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($denda as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->bookLoan->user->name ?? 'N/A' }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($item->status) {
                                                'awaiting_verif' => 'bg-warning',
                                                'verified' => 'bg-success',
                                                'decline' => 'bg-danger',
                                                default => 'bg-secondary',
                                            };
                                        @endphp
                                        <div class="text-white text-center font-semibold rounded {{ $statusClass }}">
                                            {{ $item->status }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->bukti_tf)
                                            <a href="{{ Storage::url($item->bukti_tf) }}" target="_blank">Lihat
                                                Bukti</a>
                                        @else
                                            Tidak Ada
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->paid_at ? \Carbon\Carbon::parse($item->paid_at)->format('d-m-Y H:i:s') : 'Belum Dibayar' }}
                                    </td>
                                    <td>
                                        {{ $item->verified_at ? \Carbon\Carbon::parse($item->verified_at)->format('d-m-Y H:i:s') : 'Belum Diverifikasi' }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.fines.updateStatus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select" onchange="this.form.submit()">
                                                <option value="awaiting_verif"
                                                    {{ $item->status == 'awaiting_verif' ? 'selected' : '' }}>Menunggu
                                                    verifikasi
                                                </option>
                                                <option value="verified"
                                                    {{ $item->status == 'verified' ? 'selected' : '' }}>
                                                    Terverifikasi</option>
                                                <option value="decline" {{ $item->status == 'decline' ? 'selected' : '' }}>
                                                    Ditolak
                                                </option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                            <p class="text-muted mt-2">Tidak ada data denda tersedia</p>
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
