<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Capstone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Access Level Banner -->
                    @if(!auth()->check())
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Anda sedang melihat versi terbatas. 
                                        <a href="{{ route('login') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                            Login
                                        </a> 
                                        untuk mengakses dokumen lengkap.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

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