<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-8 flex justify-between items-center border-b pb-4">
            <h1 class="text-2xl font-bold text-gray-800">Sistem Kunjungan Visitor</h1>
            <div class="text-sm text-gray-600">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Form Section (1/4 width) -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-lg font-semibold mb-4 text-gray-700 border-b pb-2">Form Check-In</h2>
                    
                    @if(session('error'))
                        <div class="mb-4 p-3 rounded-md bg-red-50 border-l-4 border-red-400">
                            <p class="text-red-700 text-sm">{{ session('error') }}</p>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-4 p-3 rounded-md bg-green-50 border-l-4 border-green-400">
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('visitor.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="identifier" class="block text-sm font-medium text-gray-700 mb-1">
                                    NIM/NIP/Nama <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                    id="identifier" 
                                    name="identifier" 
                                    value="{{ old('identifier') }}" 
                                    required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Masukkan identitas Anda">
                            </div>

                            <div>
                                <label for="instansi" class="block text-sm font-medium text-gray-700 mb-1">
                                    Instansi
                                </label>
                                <input type="text" 
                                    id="instansi" 
                                    name="instansi" 
                                    value="{{ old('instansi') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Nama instansi">
                                <p class="mt-1 text-xs text-gray-500">*Wajib diisi jika NIM/NIP tidak terdaftar</p>
                            </div>

                            <button type="submit" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-md transition duration-150 ease-in-out flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                                </svg>
                                Check In
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table Section (3/4 width) -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-semibold text-gray-700">Daftar Pengunjung Hari Ini</h2>
                        <p class="text-sm text-gray-500 mt-1">Menampilkan data kunjungan per {{ now()->format('d/m/Y') }}</p>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                                        No
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Instansi
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                        Check In
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                        Check Out
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($todayVisitors as $index => $visitor)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $todayVisitors->firstItem() + $index }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $visitor->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">
                                            {{ $visitor->instansi }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <div class="flex items-center gap-1">
                                                <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                                                {{ \Carbon\Carbon::parse($visitor->check_in_at)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($visitor->check_out_at)
                                                <div class="flex items-center gap-1">
                                                    <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                                    {{ \Carbon\Carbon::parse($visitor->check_out_at)->format('H:i') }}
                                                </div>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Belum checkout
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 bg-gray-50">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p>Belum ada pengunjung hari ini</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-4 border-t">
                        {{ $todayVisitors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>