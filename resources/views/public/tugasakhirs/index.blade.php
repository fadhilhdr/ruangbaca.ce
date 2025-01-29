<x-app-layout>        


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">    
            
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Tugas Akhir</h1>
            </div>
            
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search Bar -->
                    <div class="max-w-3xl mb-8">
                        <form action="{{ route('public.tugasakhirs.index') }}" method="GET">
                            <label for="search" class="block mb-2 text-sm font-medium text-gray-700">
                                Cari Tugas Akhir
                            </label>
                            <div class="flex gap-2">
                                <input type="text" 
                                       id="search"
                                       name="search" 
                                       placeholder="Masukkan judul tugas akhir..."
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                       value="{{ request('search') }}">
                                <button type="submit"
                                        class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Results Info -->
                    <div class="mb-4 text-sm text-gray-600">
                        @if(request('search'))
                            Hasil pencarian untuk: "{{ request('search') }}"
                        @else
                            Menampilkan semua tugas akhir
                        @endif
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Judul
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Penulis
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($tugasakhirs as $ta)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $ta->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">
                                                {{ $ta->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('public.tugasakhirs.show', $ta->id) }}"
                                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                                <span>Lihat Detail</span>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada tugas akhir yang ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $tugasakhirs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>