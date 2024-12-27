<!DOCTYPE html>
<html lang="en">
<!-- Previous head section remains the same -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Baca CE - UNDIP</title>
    @vite('resources/css/app.css')
    <style>
        .hero-section {
            min-height: 70vh;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6));
            position: relative;
        }
        
        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        
        .search-container {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(10px);
        }
        
        .announcement-bar {
            background: rgba(243, 244, 246, 0.97);
            backdrop-filter: blur(10px);
        }

        .collection-card {
            transition: all 0.3s ease;
        }

        .collection-card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Previous navbar and announcement bar remain the same -->
        <!-- Navbar -->
        <nav class="bg-white shadow-sm fixed w-full top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <img src="{{ asset('images/S1-Teknik-Komputer.png') }}" alt="Logo" class="h-12">
                    </div>
                    <div class="flex items-center space-x-6">
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Beranda</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Informasi</a>
                        <a href="#" class="text-gray-700 hover:text-gray-900 transition">Bantuan</a>
                        @if (Route::has('login'))
                            <div class="flex items-center space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 transition">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Login</a>
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
    
        <!-- Announcement Bar -->
        <div class="announcement-bar fixed w-full top-16 z-40">
            <div class="container mx-auto px-4 py-2">
                <p class="text-sm text-gray-600 text-center">
                    Scan barcode KTM Anda di halaman ini untuk mengisi kehadiran di Ruang Baca Teknik Komputer!
                </p>
            </div>
        </div>

    <!-- Hero Section with Enhanced Styling -->
    <div class="hero-section mt-24">
        <video autoplay loop muted playsinline class="hero-video">
            <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
        </video>
        
        <div class="container mx-auto px-4 py-20">
            <div class="text-center text-white mb-12 space-y-4">
                <h1 class="text-5xl font-bold mb-4 leading-tight">Selamat Datang di Ruang Baca CE</h1>
                <p class="text-xl font-light max-w-2xl mx-auto">Temukan referensi dan resource yang Anda butuhkan untuk mendukung perjalanan akademik Anda</p>
            </div>

            <!-- Enhanced Dual Purpose Card -->
            <div class="search-container max-w-4xl mx-auto rounded-2xl shadow-xl p-8">
                <!-- Enhanced Tabs -->
                <div class="flex space-x-6 mb-8 border-b border-gray-200">
                    <button class="px-6 py-3 text-blue-600 border-b-2 border-blue-600 font-medium transition-all duration-200 hover:text-blue-700">
                        Check-in Visitor
                    </button>
                    <button class="px-6 py-3 text-gray-500 hover:text-gray-700 transition-all duration-200">
                        Cari Buku
                    </button>
                </div>

                <!-- Previous forms remain the same -->
                <!-- Check-in Form -->
                <form method="POST" action="{{ route('visitor.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="userid" class="block text-sm font-medium text-gray-700">NIM atau NIP</label>
                        <input type="text" name="userid" id="userid" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Manual Input Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Bukan dari Teknik Komputer?</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                <input type="text" name="name" id="name" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                                <input type="text" name="instansi" id="instansi" class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                        Check-in
                    </button>
                </form>

                <!-- Book Search Form (Initially Hidden) -->
                <form action="{{ route('public.books.index') }}" method="GET" class="hidden space-y-4">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari judul buku, penulis, atau kategori..." 
                               class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <svg class="w-6 h-6 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                        Cari Buku
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Section -->
    <div class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="stat-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-blue-600 mb-2">266,495</h3>
                    <p class="text-gray-600 text-lg">Total Judul</p>
                </div>
                <div class="stat-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-blue-600 mb-2">286,575</h3>
                    <p class="text-gray-600 text-lg">Total Item</p>
                </div>
                <div class="stat-card bg-white p-8 rounded-2xl shadow-lg text-center">
                    <h3 class="text-4xl font-bold text-blue-600 mb-2">758,573</h3>
                    <p class="text-gray-600 text-lg">Total Pengunjung</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Collection Section -->
    <div class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Koleksi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Telusuri berbagai koleksi yang kami miliki untuk mendukung pembelajaran dan penelitian Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Koleksi Buku -->
                <div class="collection-card bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-bold text-2xl text-gray-800">Koleksi Buku</h3>
                        <span class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <span class="text-xl">📚</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">72,250</p>
                                <p class="text-sm text-gray-600">Total Judul</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-50 rounded-lg">
                                <span class="text-xl">⬇️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">114,235</p>
                                <p class="text-sm text-gray-600">Total Unduhan</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <span class="text-xl">👁️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">428,377</p>
                                <p class="text-sm text-gray-600">Total Views</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Koleksi Capstone -->
                <div class="collection-card bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-bold text-2xl text-gray-800">Dokumen Capstone</h3>
                        <span class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-green-50 rounded-lg">
                                <span class="text-xl">📚</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">15,320</p>
                                <p class="text-sm text-gray-600">Total Dokumen</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-yellow-50 rounded-lg">
                                <span class="text-xl">⬇️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">45,890</p>
                                <p class="text-sm text-gray-600">Total Unduhan</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-red-50 rounded-lg">
                                <span class="text-xl">👁️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">156,234</p>
                                <p class="text-sm text-gray-600">Total Views</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Koleksi Tugas Akhir -->
                <div class="collection-card bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-bold text-2xl text-gray-800">Tugas Akhir</h3>
                        <span class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <span class="text-xl">📚</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">8,450</p>
                                <p class="text-sm text-gray-600">Total Dokumen</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-indigo-50 rounded-lg">
                                <span class="text-xl">⬇️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">25,780</p>
                                <p class="text-sm text-gray-600">Total Unduhan</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="p-3 bg-pink-50 rounded-lg">
                                <span class="text-xl">👁️</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-800">98,567</p>
                                <p class="text-sm text-gray-600">Total Views</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="bg-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">Ruang Baca CE</h3>
                    <p class="text-gray-400 max-w-md">Departemen Teknik Komputer</p>
                    <p class="text-gray-400">Fakultas Teknik</p>
                    <p class="text-gray-400">Universitas Diponegoro</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400">&copy; 2024 — S1T24K06</p>
                    <p class="text-gray-400 mt-2">Developed with ❤️ by Team S1T24K06</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Previous scripts remain the same -->
    <script>
        // Toggle between check-in and search forms
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('button');
            const forms = document.querySelectorAll('form');
            
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    // Update tab styles
                    tabs.forEach(t => {
                        t.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                        t.classList.add('text-gray-500');
                    });
                    tab.classList.remove('text-gray-500');
                    tab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                    
                    // Show/hide forms
                    forms.forEach((form, formIndex) => {
                        if (formIndex === index) {
                            form.classList.remove('hidden');
                        } else {
                            form.classList.add('hidden');
                        }
                    });
                });
            });
        });

        // Auto-hide notifications
        setTimeout(() => {
            const notifications = document.querySelectorAll('.notification');
            notifications.forEach(notification => {
                notification.style.display = 'none';
            });
        }, 5000);
    </script>
    
</body>
</html>