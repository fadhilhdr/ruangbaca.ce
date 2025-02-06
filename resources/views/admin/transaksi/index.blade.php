@extends('admin.layouts.base')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <!-- Search and Filter Card -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-body">
                    <div class="row d-flex justify-content-between">
                        <div class="col-sm-4">
                            <form action="{{ route('admin.transaction.index') }}" method="GET" class="d-flex">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari berdasarkan User ID atau Nama..." value="{{ request('search') }}">
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
                        <i class="bi bi-three-dots-vertical"></i> Transaksi
                    </h3>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 40px">NO</th>
                                    <th>Nama</th>
                                    <th>Status</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $index => $transaction)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $transaction->bookLoan->user->name ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $status = $transaction->type->type_name ?? 'N/A';
                                                $statusMap = [
                                                    'Borrow' => 'Peminjaman',
                                                    'Renewal' => 'Perpanjangan',
                                                    'Return' => 'Pengembalian',
                                                    'Fine Payment' => 'Pembayaran Denda',
                                                    'Lost Book Replacement' => 'Penggantian Buku Hilang',
                                                ];

                                                $statusTranslated = $statusMap[$status] ?? 'Tidak Diketahui';

                                                $statusClass = match ($status) {
                                                    'Borrow' => 'bg-primary',
                                                    'Renewal' => 'bg-info',
                                                    'Return' => 'bg-warning',
                                                    'Fine Payment' => 'bg-success',
                                                    'Lost Book Replacement' => 'bg-warning',
                                                    default => 'bg-secondary',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $statusTranslated }}</span>
                                        </td>
                                        <td>{{ $transaction->bookLoan->book->judul ?? 'N/A' }}</td>
                                        <td>{{ $transaction->bookLoan->loan_date ?? 'N/A' }}</td>
                                        <td>
                                            @php
                                                $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                                    $transaction->bookLoan->due_date,
                                                    false,
                                                );
                                                $boxColor =
                                                    $daysLeft < 0
                                                        ? 'bg-danger'
                                                        : ($daysLeft <= 3
                                                            ? 'bg-warning'
                                                            : 'bg-success');
                                            @endphp
                                            <span class="badge {{ $boxColor }}">
                                                @if ($daysLeft < 0)
                                                    Terlambat {{ abs($daysLeft) }} hari
                                                @else
                                                    {{ $daysLeft }} hari tersisa
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                                <p class="text-muted mt-2">Tidak ada data transaksi tersedia</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-end">
                        {{-- {{ $transactions->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
