@extends('admin.layouts.base')

@section('title', 'Daftar Denda')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <!-- Search Bar -->
                <form action="#" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="search" name="search" id="search" class="form-control"
                            placeholder="Cari berdasarkan nama" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
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
                                    $status = $item->status ?? 'N/A';
                                    $statusClass = match ($status) {
                                        'awaiting_verif' => 'bg-warning', // Kuning
                                        'verified' => 'bg-success', // Hijau
                                        default => 'bg-secondary', // Abu-abu
                                    };
                                @endphp
                                <div class="text-white text-center font-semibold rounded {{ $statusClass }}">
                                    {{ $status }}
                                </div>
                            </td>
                            <td>
                                @if ($item->bukti_tf)
                                    <a href="{{ Storage::url($item->bukti_tf) }}" target="_blank">Lihat Bukti</a>
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

@endsection
