<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Capstone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Informasi Capstone -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Informasi Capstone</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Kode Kelompok:</p>
                                <p class="font-semibold">{{ $capstone->kode_kelompok }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Kategori:</p>
                                <p class="font-semibold">{{ $capstone->kategori }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-gray-600">Judul Capstone:</p>
                                <p class="font-semibold">{{ $capstone->judul_capstone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Anggota Tim -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Anggota Tim</h3>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600">Anggota 1:</p>
                                <p class="font-semibold">{{ $capstone->anggota1->name ?? 'Tidak ada' }} ({{ $capstone->anggota1_nim }})</p>
                            </div>
                            @if($capstone->anggota2_nim)
                            <div>
                                <p class="text-gray-600">Anggota 2:</p>
                                <p class="font-semibold">{{ $capstone->anggota2->name ?? 'Tidak ada' }} ({{ $capstone->anggota2_nim }})</p>
                            </div>
                            @endif
                            @if($capstone->anggota3_nim)
                            <div>
                                <p class="text-gray-600">Anggota 3:</p>
                                <p class="font-semibold">{{ $capstone->anggota3->name ?? 'Tidak ada' }} ({{ $capstone->anggota3_nim }})</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Dokumen Section -->
                    <div class="space-y-6">
                        <!-- C100 Document - Always Accessible -->
                        <div class="p-4 mb-6 bg-white border rounded-lg">
                            <h4 class="text-lg font-semibold mb-4">Dokumen C100</h4>
                            @if($capstone->c100_path)
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex gap-2">
                                        <a href="{{ Storage::url($capstone->c100_path) }}"
                                            download
                                            class="px-4 py-2 text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                                            Download C100
                                        </a>
                                        <a href="{{ Storage::url($capstone->c100_path) }}"
                                            target="_blank"
                                            class="px-4 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                            Preview
                                        </a>
                                    </div>
                                </div>
                                <div class="border rounded-lg">
                                    <iframe src="{{ Storage::url($capstone->c100_path) }}"
                                            class="w-full h-[1000px]"
                                            title="Dokumen C100"></iframe>
                                </div>
                            @else
                                <p class="text-gray-500">Dokumen C100 belum tersedia</p>
                            @endif
                        </div>

                        <!-- C200-C500 Documents - Only for authenticated users -->
                        @if(auth()->check())
                            @foreach($documents as $field => $label)
                                @if($field !== 'c100_path' && $capstone->$field)
                                    <div class="p-4 mb-6 bg-white border rounded-lg">
                                        <h4 class="text-lg font-semibold mb-4">{{ $label }}</h4>
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="flex gap-2">
                                                <a href="{{ Storage::url($capstone->$field) }}"
                                                    download
                                                    class="px-4 py-2 text-gray-700 bg-white border rounded-md hover:bg-gray-50">
                                                    Download {{ explode(' ', $label)[1] }}
                                                </a>
                                                <a href="{{ Storage::url($capstone->$field) }}"
                                                    target="_blank"
                                                    class="px-4 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50">
                                                    Preview
                                                </a>
                                            </div>
                                        </div>
                                        <div class="border rounded-lg">
                                            <iframe src="{{ Storage::url($capstone->$field) }}"
                                                    class="w-full h-[500px]"
                                                    title="{{ $label }}"></iframe>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <!-- Locked Documents Section -->
                            <div class="bg-gray-50 border rounded-lg p-6">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <h3 class="mt-2 text-lg font-medium text-gray-900">Dokumen Terkunci</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Dokumen C200-C500 hanya tersedia untuk pengguna yang sudah login
                                    </p>
                                    <div class="mt-4">
                                        <a href="{{ route('login') }}" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Login untuk Akses
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('public.capstones.index') }}" 
                            class="text-gray-600 hover:text-gray-900 hover:underline">
                            ← Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>