<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ruang Baca Teknik Komputer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            placeholder="Cari referensi yang dibutuhkan disini"
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

    <!-- Recommendations Section -->
    <div class="container mx-auto px-4 py-12">
        <div id="recommendations" class="hidden">
            <h2 class="text-3xl font-bold text-white mb-8 text-center">Rekomendasi Buku</h2>
            <div id="recommendationList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="hidden">
            <div class="flex justify-center items-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-gray-800 text-white">
                <div class="modal-header border-gray-700">
                    <h5 class="modal-title text-xl"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer border-gray-700">
                    <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                        data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#recommendationForm').on('submit', function(e) {
                e.preventDefault();

                const description = $('#description').val();

                // Show loading spinner
                $('#loadingSpinner').removeClass('hidden');
                $('#recommendations').addClass('hidden');

                $.ajax({
                    url: '/recommendations',
                    method: 'POST',
                    data: {
                        description: description
                    },
                    success: function(response) {
                        $('#recommendationList').empty();

                        if (Array.isArray(response) && response.length > 0) {
                            response.forEach(function(book) {
                                $('#recommendationList').append(`
                                    <div class="backdrop-blur-md bg-white/10 rounded-lg overflow-hidden">
                                        <div class="p-6">
                                            <h3 class="text-xl font-semibold text-white mb-3">${book.title}</h3>
                                            <p class="text-gray-300 mb-4 description">${book.description}</p>
                                            <div class="space-y-2">
                                                <p class="text-gray-400"><span class="text-gray-300">Rating:</span> ${book.average_rating}</p>
                                                <p class="text-gray-400"><span class="text-gray-300">Tahun Terbit:</span> ${book.published_year}</p>
                                                <p class="text-gray-400"><span class="text-gray-300">Skor Kemiripan:</span> ${book.similarity_score.toFixed(2)}</p>
                                            </div>
                                            <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors"
                                                    data-book='${JSON.stringify(book)}'
                                                    onclick="showBookDetails(this)">
                                                Lihat Detail
                                            </button>
                                        </div>
                                    </div>
                                `);
                            });
                            $('#recommendations').removeClass('hidden');
                        } else {
                            $('#recommendationList').html(`
                                <div class="col-span-full text-center">
                                    <div class="backdrop-blur-md bg-white/10 rounded-lg p-6 text-white">
                                        Tidak ada rekomendasi yang ditemukan.
                                    </div>
                                </div>
                            `);
                            $('#recommendations').removeClass('hidden');
                        }
                    },
                    error: function(xhr) {
                        $('#recommendationList').html(`
                            <div class="col-span-full text-center">
                                <div class="backdrop-blur-md bg-white/10 rounded-lg p-6 text-white">
                                    Gagal mendapatkan rekomendasi. Silakan coba lagi.
                                </div>
                            </div>
                        `);
                        $('#recommendations').removeClass('hidden');
                        console.error('Error:', xhr.responseText);
                    },
                    complete: function() {
                        $('#loadingSpinner').addClass('hidden');
                    }
                });
            });
        });

        function showBookDetails(button) {
            const book = JSON.parse(button.getAttribute('data-book'));
            const modal = document.getElementById('bookDetailsModal');

            modal.querySelector('.modal-title').textContent = book.title;
            modal.querySelector('.modal-body').innerHTML = `
                <p class="mb-4"><strong>Deskripsi:</strong></p>
                <p class="text-gray-300 mb-4">${book.description}</p>
                <hr class="border-gray-700 my-4">
                <p class="text-gray-300"><strong>Rating:</strong> ${book.average_rating}</p>
                <p class="text-gray-300"><strong>Tahun Terbit:</strong> ${book.published_year}</p>
                <p class="text-gray-300"><strong>Skor Kemiripan:</strong> ${book.similarity_score.toFixed(2)}</p>
            `;

            const bookModal = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
            bookModal.show();
        }
    </script>
</body>

</html>
