<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Daftar Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <form action="{{ route('public.tugasakhirs.index') }}" method="GET">
                            <input type="text" name="search" placeholder="Cari judul..."
                                   class="w-full px-4 py-2 border rounded-md"
                                   value="{{ request('search') }}">
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Judul</th>
                                    <th class="px-4 py-2">Penulis</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tugasakhirs as $ta)
                                    <tr>
                                        <td class="px-4 py-2">{{ $ta->title }}</td>
                                        <td class="px-4 py-2">{{ $ta->nim }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('public.tugasakhirs.show', $ta->id) }}"
                                               class="text-blue-600 hover:text-blue-800">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $tugasakhirs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
