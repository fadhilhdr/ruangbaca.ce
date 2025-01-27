<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Ruang Baca CE - UNDIP') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .main {
            flex: 1 0 auto; 
        }

        .footer {
            flex-shrink: 0; 
        }

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
    <div class="min-h-screen flex flex-col">
        <x-navbar />

        <main class="flex-grow mt-16">
            {{ $slot }}
        </main>
        
        <x-footer />
    </div>

    @stack('scripts')
</body>
</html>