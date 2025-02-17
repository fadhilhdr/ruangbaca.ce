<div id="answer" class="container mx-auto px-4 py-12">
    {{-- Recommendations Section --}}
    <div id="recommendations" class="hidden">
        <h2 class="text-3xl font-bold text-white mb-8 text-center">Rekomendasi Buku</h2>
        <div id="recommendationList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
    </div>

    {{-- Loading Spinner --}}
    <div id="loadingSpinner" class="hidden">
        <div class="flex justify-center items-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-white"></div>
        </div>
    </div>
</div>

{{-- Book Details Modal --}}
<div id="bookDetailsModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
    role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        {{-- Modal panel --}}
        <div
            class="inline-block align-bottom bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-white modal-title" id="modal-title"></h3>
                        <div class="mt-4 modal-body text-white"></div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeModal()"
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('recommendationForm');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const description = document.getElementById('description').value;

            // Show loading spinner
            document.getElementById('loadingSpinner').classList.remove('hidden');
            document.getElementById('recommendations').classList.add('hidden');

            fetch('/recommendations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        description: description
                    })
                })
                .then(response => response.json())
                .then(response => {
                    const recommendationList = document.getElementById('recommendationList');
                    recommendationList.innerHTML = '';

                    if (Array.isArray(response) && response.length > 0) {
                        response.forEach(function(book) {
                            recommendationList.innerHTML += `
                        <div class="backdrop-blur-md bg-white/10 rounded-lg overflow-hidden">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-white mb-3">${book.title}</h3>
                                <p class="text-gray-300 mb-4 line-clamp-3">${book.description}</p>
                                <div class="space-y-2">
                                    <p class="text-gray-400"><span class="text-gray-300">Rating:</span> ${book.average_rating}</p>
                                    <p class="text-gray-400"><span class="text-gray-300">Tahun Terbit:</span> ${book.published_year}</p>
                                    <p class="text-gray-400"><span class="text-gray-300">Skor Kemiripan:</span> ${book.similarity_score.toFixed(2)}</p>
                                </div>
                                <button class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors"
                                        onclick='showBookDetails(${JSON.stringify(book)})'>
                                    Lihat Detail
                                </button>
                            </div>
                        </div>
                    `;
                        });
                        document.getElementById('recommendations').classList.remove('hidden');

                        // Scroll ke bagian rekomendasi setelah hasil ditampilkan
                        document.getElementById('answer').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    } else {
                        recommendationList.innerHTML = `
                    <div class="col-span-full text-center">
                        <div class="backdrop-blur-md bg-white/10 rounded-lg p-6 text-white">
                            Tidak ada rekomendasi yang ditemukan.
                        </div>
                    </div>
                `;
                        document.getElementById('recommendations').classList.remove('hidden');

                        // Scroll ke bagian rekomendasi jika tidak ada hasil
                        document.getElementById('answer').scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                })
                .catch(error => {
                    document.getElementById('recommendationList').innerHTML = `
                <div class="col-span-full text-center">
                    <div class="backdrop-blur-md bg-white/10 rounded-lg p-6 text-white">
                        Gagal mendapatkan rekomendasi. Silakan coba lagi.
                    </div>
                </div>
            `;
                    document.getElementById('recommendations').classList.remove('hidden');

                    // Scroll ke bagian rekomendasi jika terjadi error
                    document.getElementById('answer').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    console.error('Error:', error);
                })
                .finally(() => {
                    document.getElementById('loadingSpinner').classList.add('hidden');
                });
        });
    });

    function showBookDetails(book) {
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
        modal.classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('bookDetailsModal').classList.add('hidden');
    }
</script>
