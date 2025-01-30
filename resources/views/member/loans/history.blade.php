<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        @include('components.page-header', [
            'title' => 'Riwayat Peminjaman Buku',
        ])  
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
                <div class="space-y-6">
                    @foreach($loans as $loan)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-200">
                            <div class="p-6">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Book Image -->
                                    <div class="w-full md:w-36 h-48 flex-shrink-0">
                                        @if($loan->book->thumbnail)
                                            <img src="{{ Storage::url($loan->book->thumbnail) }}" 
                                                alt="{{ Str::title($loan->book->judul) }}"
                                                class="w-full h-full object-cover rounded-lg shadow-sm">
                                        @else
                                            <div class="w-full h-full bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Loan Details -->
                                    <div class="flex-1">
                                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                            <div>
                                                <h3 class="text-xl font-semibold text-gray-900">{{ Str::title($loan->book->judul) }}</h3>
                                                <p class="text-gray-600 mt-1">{{ Str::title($loan->book->penulis) }}</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Loan Dates -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-600">Tanggal Peminjaman</p>
                                                        <p class="font-medium text-gray-900">{{ Carbon\Carbon::parse($loan->loan_date)->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <div class="flex items-center space-x-3">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                    </svg>
                                                    <div>
                                                        <p class="text-sm text-gray-600">Tanggal Pengembalian</p>
                                                        <p class="font-medium text-gray-900">
                                                            {{ $loan->return_date ? Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Transaction Timeline -->
                                        <div class="mt-6 border-t border-gray-100 pt-6">
                                            <h4 class="text-sm font-medium text-gray-900 mb-4">Riwayat Transaksi</h4>
                                            <div class="space-y-3">
                                                @foreach($loan->transactions as $transaction)
                                                    <div class="flex items-center justify-between text-sm bg-gray-50 rounded-lg p-3">
                                                        <span class="flex items-center text-gray-700">
                                                            @if($transaction->type->type_name === 'borrow')
                                                                <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                                </svg>
                                                            @elseif($transaction->type->type_name === 'return')
                                                                <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                                </svg>
                                                            @elseif($transaction->type->type_name === 'fine')
                                                                <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                                </svg>
                                                            @endif
                                                            {{ Str::title($transaction->type->type_name) }}
                                                            @if($transaction->type->type_name === 'fine')
                                                                <span class="text-red-600 ml-1">
                                                                    (Rp {{ number_format($transaction->fines->first()->amount, 0, ',', '.') }})
                                                                </span>
                                                            @endif
                                                        </span>
                                                        <span class="text-gray-500 flex items-center">
                                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ $transaction->created_at->format('d M Y H:i') }}
                                                        </span>
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
                <div class="mt-8">
                    {{ $loans->links() }}
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-xl">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <h3 class="mt-4 text-sm font-medium text-gray-900">Tidak Ada Riwayat Peminjaman</h3>
                    <p class="mt-2 text-sm text-gray-500">Anda belum memiliki riwayat peminjaman buku.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>