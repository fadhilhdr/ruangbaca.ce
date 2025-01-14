
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Detail Tugas Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="mb-4 text-lg font-semibold">{{ $tugasakhir->title }}</h3>
                    <p class="mb-4">Penulis: {{ $tugasakhir->nim }}</p>

                    @if($tugasakhir->cover_abstract)
                        <div class="mt-4">
                            <h4 class="mb-2 font-semibold">Preview Cover dan Abstrak:</h4>
                            <iframe src="{{ Storage::url($tugasakhir->cover_abstract) }}"
                                    class="w-full h-screen"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>