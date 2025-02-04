<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ruang Baca Teknik Komputer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card-text.description {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            height: 4.5rem;
            /* Fixed height for description */
        }

        .book-card {
            height: 330px;
            /* Fixed height for cards */
            display: flex;
            flex-direction: column;
        }

        .book-card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .modal-blur {
            backdrop-filter: blur(12px);
        }

        .card-info {
            margin-top: auto;
        }
    </style>

</head>

<body class="bg-gray-900">
    <!-- Hero Section with Video -->
    <div class="relative min-h-[60vh] flex items-center">
        <!-- Video Background with Enhanced Gradient Overlay -->
        <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover">
            <source src="{{ asset('videos/video.MP4') }}" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/90 via-black/70 to-blue-900/90"></div>

        <!-- Main Content -->
        <div class="relative container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-5xl lg:text-7xl font-bold mb-8 leading-tight">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-grey to-blue-300">
                        Ruang Baca Teknik Komputer
                    </span>
                </h1>

                <!-- Search Bar -->
                <form id="recommendationForm" class="relative max-w-2xl mx-auto">
                    @csrf
                    <div class="backdrop-blur-md bg-white/10 p-1 flex">
                        <input type="text" id="description" name="description"
                            placeholder="Cari rekomendasi buku disini.."
                            class="w-full bg-transparent text-white placeholder-white/60 px-4 py-3 focus:outline-none"
                            required>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
