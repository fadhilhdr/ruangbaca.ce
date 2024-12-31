<x-app-layout>
    <div class="container">
        <h1>Riwayat Transaksi</h1>
    
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('member.loans.history') }}">
                    <div class="form-group">
                        <label for="transaction_type">Filter berdasarkan Jenis Transaksi</label>
                        <select name="transaction_type" id="transaction_type" class="form-control">
                            <option value="">Semua</option>
                            <option value="borrow">Peminjaman</option>
                            <option value="return">Pengembalian</option>
                            <option value="fine">Pembayaran Denda</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>
    
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>Tipe Transaksi</th>
                    <th>Buku</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transactionType->type_name }}</td>
                        <td>{{ $transaction->bookLoan->book->title }} ({{ $transaction->bookLoan->book->author }})</td>
                        <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>