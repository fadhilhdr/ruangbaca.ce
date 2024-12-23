<!-- resources/views/visitor.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengunjung - Ruang Baca CE</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Daftar Pengunjung Ruang Baca</h2>

        <!-- Display success or error messages -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">{{ session('error') }}</div>
        @endif

        <!-- Table to display visitors -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left border-b">Nama</th>
                    <th class="px-4 py-2 text-left border-b">NIM/NIP</th>
                    <th class="px-4 py-2 text-left border-b">Check-in Time</th>
                    <th class="px-4 py-2 text-left border-b">Check-out Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $visitor)
                    <tr>
                        <td class="px-4 py-2 border-b">{{ $visitor->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $visitor->userid }}</td>
                        <td class="px-4 py-2 border-b">{{ $visitor->check_in_at }}</td>
                        <td class="px-4 py-2 border-b">{{ $visitor->check_out_at ?? 'Belum Check-out' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
ww