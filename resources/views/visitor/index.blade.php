<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Kunjungan Visitor Hari Ini</h1>

        @if(session('success'))
            <div id="notification" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-2 px-4 rounded-md shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Loading Bar -->
        <div id="loading-bar-container" class="relative w-full bg-gray-300 rounded-full h-2 mb-4">
            <div id="loading-bar" class="absolute bg-blue-500 h-2 rounded-full" style="width: 0%;"></div>
        </div>

        <!-- Tabel Visitor -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse bg-white text-left text-sm text-gray-500">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-gray-700 font-semibold">No</th>
                        <th class="px-4 py-2 text-gray-700 font-semibold">Nama</th>
                        <th class="px-4 py-2 text-gray-700 font-semibold">NIM/NIP</th>
                        <th class="px-4 py-2 text-gray-700 font-semibold">Instansi</th>
                        <th class="px-4 py-2 text-gray-700 font-semibold">Check-In</th>
                        <th class="px-4 py-2 text-gray-700 font-semibold">Check-Out</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($todayVisitors->sortByDesc('check_in_at') as $index => $visitor)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $visitor->name }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $visitor->userid ?? '-' }}</td>
                            <td class="px-4 py-2 text-gray-700">{{ $visitor->instansi ?? 'Teknik Komputer' }}</td> 
                            <td class="px-4 py-2 text-gray-700">
                                {{ $visitor->check_in_at ? \Carbon\Carbon::parse($visitor->check_in_at)->format('H:i:s') : '-' }}
                            </td>
                            <td class="px-4 py-2 text-gray-700">
                                {{ $visitor->check_out_at ? \Carbon\Carbon::parse($visitor->check_out_at)->format('H:i:s') : 'Belum Check-out' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada kunjungan hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const loadingBar = document.getElementById('loading-bar');
        let progress = 0;
        const duration = 8000; // 8 detik
        const interval = 10; // Update setiap 10ms
        const step = (100 / (duration / interval));

        const loadingInterval = setInterval(() => {
            progress += step;
            loadingBar.style.width = `${progress}%`;

            if (progress >= 100) {
                clearInterval(loadingInterval);
                setTimeout(() => {
                    window.location.href = "{{ url('/') }}";
                }, 1000); // Redirect 1 detik setelah selesai
            }
        }, interval);
    </script>
</x-app-layout>
