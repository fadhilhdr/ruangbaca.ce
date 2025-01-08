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
