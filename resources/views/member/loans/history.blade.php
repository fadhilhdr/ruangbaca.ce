<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Peminjaman Buku',
        ])

            <!-- Filters -->
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Peminjaman</h1>
            
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <form method="GET" action="{{ route('member.loans.history') }}" class="space-y-4 md:space-y-0 md:flex md:gap-4">
                    <div class="flex-1">
                        <label for="transaction_type" class="block text-sm font-medium text-gray-700 mb-1">
                            Jenis Transaksi
                        </label>
                        <select name="transaction_type" id="transaction_type" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Transaksi</option>
                            @foreach($transactionTypes as $type)
                                <option value="{{ $type }}" {{ request('transaction_type') == $type ? 'selected' : '' }}>
                                    {{ ucfirst($type) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">
                            Dari Tanggal
                        </label>
                        <input type="date" name="date_from" id="date_from" 
                               value="{{ request('date_from') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex-1">
                        <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">
                            Sampai Tanggal
                        </label>
                        <input type="date" name="date_to" id="date_to" 
                               value="{{ request('date_to') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Loan History Cards -->
            @if($loans->count() > 0)
                <div class="space-y-4">
                    @foreach($loans as $loan)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Book Image -->
                                    <div class="w-full md:w-32 h-40 flex-shrink-0">
                                        @if($loan->book->thumbnail)
                                            <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                                 alt="{{ $loan->book->judul }}"
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <div class="w-full h-full bg-gray-100 rounded-lg flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Loan Details -->
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $loan->book->judul }}</h3>
                                        <p class="text-gray-600 mb-4">{{ $loan->book->penulis }}</p>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-sm text-gray-600">Tanggal Peminjaman</p>
                                                <p class="font-medium">{{ Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-600">Tanggal Pengembalian</p>
                                                <p class="font-medium">{{ $loan->return_date ? Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}</p>
                                            </div>
                                        </div>

                                        <!-- Transaction Timeline -->
                                        <div class="border-t pt-4">
                                            <h4 class="text-sm font-medium text-gray-700 mb-2">Riwayat Transaksi</h4>
                                            <div class="space-y-2">
                                                @foreach($loan->transactions as $transaction)
                                                    <div class="flex items-center justify-between text-sm">
                                                        <span class="text-gray-600">
                                                            {{ ucfirst($transaction->type->type_name) }}
                                                            @if($transaction->type->type_name === 'fine')
                                                                (Rp {{ number_format($transaction->fines->first()->amount, 0, ',', '.') }})
                                                            @endif
                                                        </span>
                                                        <span class="text-gray-500">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $loans->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    <p class="text-gray-600">Tidak ada riwayat peminjaman.</p>
                    <a href="{{ route('public.books.index') }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Pinjam buku sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>