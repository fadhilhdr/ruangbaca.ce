<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Baca CE - UNDIP</title>
    @vite('resources/css/app.css')
    <style>
        .sticky-wrapper {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
        }
        .marquee {
            background-color: #f3f4f6;
            padding: 0.5rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .video-container {
            height: 70vh;
            position: relative;
            margin-bottom: 2rem;
        }
        .content-wrapper {
            padding-top: 4.5rem;
        }
        .visitor-section {
            margin-top: -30rem;
            position: relative;
            z-index: 20;
            padding: 1.5rem;
            border-radius: 0.75rem;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
        .stats-section {
            margin-top: 0;
            position: relative;
            z-index: 20;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="sticky-wrapper">
        <nav class="bg-white shadow-sm">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <img src="{{ asset('images/S1-Teknik-Komputer.png') }}" alt="Logo" class="h-12">
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Beranda</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Informasi</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Bantuan</a>
                        @if (Route::has('login'))
                            <div class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 transition">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 transition">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 transition">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        <div class="marquee">
            <marquee behavior="scroll" direction="left" scrollamount="7">
                Scan barcode KTM Anda di halaman ini untuk mengisi kehadiran di Ruang Baca Teknik Komputer!
            </marquee>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="video-container">
            <video autoplay loop muted class="w-full h-full object-cover">
                <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black opacity-25"></div>
        </div>

        <div class="container mx-auto px-4">
            <div class="visitor-section">
                <h3 class="text-xl font-semibold mb-4">Check-in dan Check-out Visitor</h3>
                <form method="POST" action="{{ route('visitor.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="userid" class="block text-sm font-medium text-gray-700">NIM atau NIP</label>
                        <input type="text" name="userid" id="userid" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Bukan dari Teknik Komputer?</h2>
                        <p class="text-gray-600 mb-4">Silakan isi nama dan instansi manual di bawah ini:</p>
                    
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama </label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                
                        <div class="mb-4">
                            <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                            <input type="text" name="instansi" id="instansi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Teknik Komputer">
                        </div>
                    </div>
            
            
            
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 w-full">Submit</button>
                </form>
            
                @if(session('error'))
                    <div class="mt-4 text-red-500 text-sm">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="mt-4 text-green-500 text-sm">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
            </div>            
            
            </div>
        </div>

        <div class="container mx-auto px-4">
            <div class="stats-section">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-sm text-gray-600">All Titles</h3>
                        <p class="text-2xl font-bold">266,495</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-sm text-gray-600">All Items</h3>
                        <p class="text-2xl font-bold">286,575</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-sm text-gray-600">All Visitor</h3>
                        <p class="text-2xl font-bold">758,573</p>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-6">Our Collection</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold mb-4">Koleksi Buku</h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">📚</span>
                                        72,250
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">⬇️</span>
                                        114,235
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">👁️</span>
                                        428,377
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold mb-4">Koleksi Dokumen Capstone</h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">📚</span>
                                        72,250
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">⬇️</span>
                                        114,235
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">👁️</span>
                                        428,377
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold mb-4">Koleksi Dokumen Tugas Akhir</h3>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">📚</span>
                                        72,250
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">⬇️</span>
                                        114,235
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        <span class="inline-block w-5 text-center mr-2">👁️</span>
                                        428,377
                                    </p>
                                </div>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-gray-800 text-white">
            <div class="container mx-auto px-4 py-8">
                <div class="flex justify-between">
                    <div>
                        <h3 class="font-bold mb-4">Ruang Baca CE</h3>
                        <p class="text-sm text-gray-400">Universitas Diponegoro</p>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-700 text-sm text-gray-400">
                    <p>&copy; 2024 — S1T24K06</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Menghapus notifikasi setelah beberapa detik
        setTimeout(() => {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>
