@extends('admin.layouts.base')

@section('title', 'Dashboard')

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
    <div class="app-content-header"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div> <!--end::Row-->
        </div> <!--end::Container-->
    </div> <!--end::App Content Header--> <!--begin::App Content-->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row"> <!--begin::Col-->
                <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 1-->
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{ $availableBooks }}</h3>
                            <p>Buku Tersedia</p>
                        </div>
                        <i class="bi bi-book small-box-icon"></i>
                        <a href="{{ route('admin.books.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                    <!--end::Small Box Widget 1-->
                </div> <!--end::Col-->
                <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 2-->
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $borrowedBooks }}</h3>
                            <p>Buku Terpinjam</p>
                        </div>
                        <i class="bi bi-book-half small-box-icon"></i><a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 2-->
                </div> <!--end::Col-->
                <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>User Terdaftar</p>
                        </div>
                        <i class="bi bi-person-check small-box-icon"></i><a href="#"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 3-->
                </div>
                <div class="col-lg-3 col-6"> <!--begin::Small Box Widget 3-->
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $totalStudents }}</h3>
                            <p>Jumlah Mahasiswa</p>
                        </div>
                        <i class="bi bi-person-vcard small-box-icon"></i><a href="{{ route('admin.students.index') }}"
                            class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                            More info <i class="bi bi-link-45deg"></i> </a>
                    </div> <!--end::Small Box Widget 3-->
                </div> <!--end::Col-->
                <div class="col-lg">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Peminjaman Buku Terbaru</h3>
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
                                                        $dueDate = \Carbon\Carbon::parse(
                                                            $transaction->bookLoan->due_date,
                                                        );
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
                            <div class="card-footer text-end">
                                <a href="{{ route('admin.transaction.index') }}">Tampilkan lebih banyak<i
                                        class="bi bi-arrow-right-short"></i></a>
                                {{-- <a href="#"
                                    class="btn btn-primary link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                                    Tampilkan lebih banyak transaksi
                                </a> --}}
                            </div>
                        </div>
                    </div>


                </div>

            </div> <!--end::Row--> <!--begin::Row-->

        </div> <!--end::Container-->
    </div> <!--end::App Content-->
@endsection
