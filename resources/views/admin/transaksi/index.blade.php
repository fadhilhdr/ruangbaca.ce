@extends('admin.layouts.base')

@section('title', 'Daftar Transaksi')

@section('content')
    <style>
        /* style ini untuk dihalaman dashboard membuat tabel tidak ikut di skroll */
        table thead th {
            position: sticky;
            top: 0;
            background-color: #ffffff;
            /* Warna background agar teks tetap terlihat */
            z-index: 2;
            /* Supaya tetap di atas konten tabel */
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            /* Opsional: menambahkan bayangan */
        }

        /* akhir style */
    </style>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Peminjaman Buku</h3>
        </div>
        <div class="card-body" style="max-height: 200px; overflow-y: auto;">
            <!-- Set max-height dan scroll -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{{ $transaction->bookLoan->user->name ?? 'N/A' }}</td>
                            <td>{{ $transaction->type->type_name ?? 'N/A' }}</td>
                            <td>{{ $transaction->bookLoan->book->judul ?? 'N/A' }}</td>
                            <td>{{ $transaction->bookLoan->loan_date ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                        $transaction->bookLoan->due_date,
                                        false,
                                    );
                                    $boxColor =
                                        $daysLeft < 0 ? 'bg-danger' : ($daysLeft <= 3 ? 'bg-warning' : 'bg-success');

                                @endphp

                                <div class="{{ $boxColor }} text-white text-center font-semibold rounded">
                                    @if ($daysLeft < 0)
                                        Terlambat {{ abs($daysLeft) }} hari
                                    @else
                                        {{ $daysLeft }} hari tersisa
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
