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
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Daftar Denda</h3>
        </div>
        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID Transaksi</th>
                        <th>ID Peminjaman</th>
                        <th>Jumlah Denda</th>
                        <th>Status</th>
                        <th>Bukti Transfer</th>
                        <th>Dibayar Pada</th>
                        <th>Verifikasi Pada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($denda as $fine)
                        <tr>
                            <td>{{ $fine->id }}</td>
                            <td>{{ $fine->transaction_id }}</td>
                            <td>{{ $fine->book_loan_id }}</td>
                            <td>Rp {{ number_format($fine->amount, 2, ',', '.') }}</td>
                            <td>
                                @switch($fine->status)
                                    @case('awaiting_verif')
                                        Menunggu Verifikasi
                                    @break

                                    @case('verified')
                                        Terverifikasi
                                    @break

                                    @case('decline')
                                        Ditolak
                                    @break
                                @endswitch
                            </td>
                            <td>
                                @if ($fine->bukti_tf)
                                    <a href="{{ asset('uploads/' . $fine->bukti_tf) }}" target="_blank">Lihat Bukti</a>
                                @else
                                    Tidak Ada
                                @endif
                            </td>
                            <td>{{ $fine->paid_at ? $fine->paid_at->format('d-m-Y H:i:s') : 'Belum Dibayar' }}</td>
                            <td>{{ $fine->verified_at ? $fine->verified_at->format('d-m-Y H:i:s') : 'Belum Diverifikasi' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
