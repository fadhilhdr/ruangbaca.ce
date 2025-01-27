<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="{{ route('public.capstones.index') }}" method="GET" class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="border rounded px-2 py-1 flex-1" placeholder="Cari capstone...">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded hover:bg-blue-600">
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Capstone List -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kode Kelompok
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Judul
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kategori
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Detail
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($capstones as $capstone)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $capstone->kode_kelompok }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $capstone->judul_capstone }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $capstone->kategori }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('public.capstones.show', $capstone->id) }}" 
                                            class="text-blue-600 hover:text-blue-900">Lihat Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $capstones->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>