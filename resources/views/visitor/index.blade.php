<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Kunjungan Visitor Hari Ini</h1>

        <form action="{{ route('visitor.store') }}" method="POST">
            @csrf
            <div>
                <label for="identifier">NIM/NIP/Nama:</label>
                <input type="text" 
                       id="identifier" 
                       name="identifier" 
                       value="{{ old('identifier') }}" 
                       required>
            </div>
        
            <div>
                <label for="instansi">Instansi:</label>
                <input type="text" 
                       id="instansi" 
                       name="instansi" 
                       value="{{ old('instansi') }}">
                <small>*Wajib diisi jika NIM/NIP tidak terdaftar</small>
            </div>
        
            <button type="submit">Check In</button>
        </form>
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <!-- Tampilkan daftar pengunjung hari ini -->
        <h2>Daftar Pengunjung Hari Ini</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Instansi</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($todayVisitors as $visitor)
                <tr>
                    <td>{{ $visitor->name }}</td>
                    <td>{{ $visitor->instansi }}</td>
                    <td>{{ $visitor->check_in_at }}</td>
                    <td>{{ $visitor->check_out_at ?? 'Belum checkout' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
