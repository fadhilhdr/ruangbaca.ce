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
    <div class="card mt-3">
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
                                    $dueDate = \Carbon\Carbon::parse($transaction->bookLoan->due_date);
                                    $today = \Carbon\Carbon::now();

                                    // Hitung selisih dalam jam
                                    $hoursRemaining = $dueDate->diffInHours($today, false);

                                    // Hitung sisa hari dan jam
                                    $daysRemaining = intdiv($hoursRemaining, 24);
                                    $remainingHours = $hoursRemaining % 24;
                                @endphp

                                @if ($hoursRemaining > 0)
                                    @if ($daysRemaining > 0)
                                        Masih ada {{ $daysRemaining }} hari dan {{ $remainingHours }}
                                        jam lagi
                                    @else
                                        Masih ada {{ $remainingHours }} jam lagi
                                    @endif
                                @elseif ($hoursRemaining === 0)
                                    Waktu peminjaman sudah habis
                                @else
                                    @php
                                        $daysLate = abs(intdiv($hoursRemaining, 24));
                                        $lateHours = abs($hoursRemaining % 24);
                                    @endphp
                                    Sudah terlambat {{ $daysLate }} hari dan {{ $lateHours }}
                                    jam
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
