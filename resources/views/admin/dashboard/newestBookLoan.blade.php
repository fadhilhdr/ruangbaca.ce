<div class="col-lg">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0"> <i class="bi bi-clock-history me-2"></i>
                Transaksi terbaru</h3>
        </div>
        <div class="card-body p-0" style="max-height: 200px; overflow-y: auto;">
            <!-- Set max-height dan scroll -->
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $index => $transaction)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-nowrap">{{ $transaction->bookLoan->user->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                @php
                                    $status = $transaction->type->type_name ?? 'N/A';
                                    $statusMapping = [
                                        'Borrow' => 'Peminjaman',
                                        'Renewal' => 'Perpanjangan',
                                        'Return' => 'Pengembalian',
                                        'Fine Payment' => 'Pembayaran Denda',
                                        'Lost Book Replacement' => 'Penggantian Buku Hilang',
                                    ];
                                    $statusIndo = $statusMapping[$status] ?? 'Tidak Diketahui';
                                    $statusClass = match ($status) {
                                        'Borrow' => 'bg-primary',
                                        'Renewal' => 'bg-info',
                                        'Return' => 'bg-warning',
                                        'Fine Payment' => 'bg-success',
                                        'Lost Book Replacement' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} text-white px-3 py-1">
                                    {{ $statusIndo }}
                                </span>
                            </td>

                            <td class="text-nowrap">{{ $transaction->bookLoan->book->judul ?? 'N/A' }}</td>
                            <td class="text-nowrap">{{ $transaction->bookLoan->loan_date ?? 'N/A' }}</td>
                            <td class="text-center">
                                @php
                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                        $transaction->bookLoan->due_date,
                                        false,
                                    );
                                    $boxColor =
                                        $daysLeft < 0 ? 'bg-danger' : ($daysLeft <= 3 ? 'bg-warning' : 'bg-success');
                                @endphp
                                <span class="badge {{ $boxColor }} text-white px-3 py-1">
                                    @if ($daysLeft < 0)
                                        <i class="bi bi-exclamation-triangle"></i> Terlambat {{ abs($daysLeft) }} hari
                                    @else
                                        <i class="bi bi-clock-history"></i> {{ $daysLeft }} hari tersisa
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.transaction.index') }}" class="text-decoration-none">
                Tampilkan lebih banyak <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>
    </div>
</div>
