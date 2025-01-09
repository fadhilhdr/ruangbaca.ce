@extends('admin.layouts.base')

@section('title', 'Daftar Denda')

@section('content')
    <style>
        /* Style untuk membuat header tabel tidak ikut scroll */
        table thead th {
            position: sticky;
            top: 0;
            background-color: #ffffff;
            z-index: 2;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="card">
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
                        <th>Action</th> <!-- Kolom untuk tombol aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($denda as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->bookLoan->user->name ?? 'N/A' }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ $item->status }}</td>
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
                            <td>
                                <!-- Tombol untuk mengubah status verifikasi -->
                                <form action="{{ route('admin.denda.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        {{ $item->status === 'awaiting_verif' ? 'Verifikasi' : 'Batalkan Verifikasi' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
