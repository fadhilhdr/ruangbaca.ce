<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="mx-5 mt-5">
    <div class="card mb-3 ">
        <div class="container-fluid my-5">
            <form id="recommendForm" ">
                <div class="mb-3">
                    <label for="description" class="form-label">Keyword</label>
                    <input type="text" class="form-control" id="description" placeholder="Enter Keyword to Search" autofocus>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>

        <div id="result">

        </div>

        <script>
            document.getElementById('recommendForm').onsubmit = async function(event) {
                event.preventDefault();

                // Reset result container
                const resultContainer = document.getElementById('result');
                resultContainer.innerHTML = '';

                const description = document.getElementById('description').value;

                try {
                    const response = await fetch('/recommend-books', { // Endpoint ke Laravel
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pastikan ada CSRF Token jika pakai Blade
                        },
                        body: JSON.stringify({
                            description
                        })
                    });

                    const result = await response.json();

                    if (result.status === 'error') {
                        resultContainer.innerHTML = `
                            <div class="alert alert-danger" role="alert">
                                ${result.message || 'Terjadi kesalahan saat mengambil data'}
                            </div>
                        `;
                        return;
                    }

                    if (!result.recommendations || result.recommendations.length === 0) {
                        resultContainer.innerHTML = `
                            <div class="alert alert-warning" role="alert">
                                Tidak ada buku yang cocok dengan deskripsi yang Anda masukkan.
                            </div>
                        `;
                        return;
                    }

                    result.recommendations.forEach(book => {
                        const bookCard = `
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Judul: ${book.title}</h5>
                                    <p class="card-text">Tahun Terbit: ${book.published_year}</p>
                                    <p class="card-text">Rating: ${book.average_rating}</p>
                                    <p class="card-text">Deskripsi: ${book.description}</p>
                                    <p class="text-muted">Similarity Score: ${book.similarity_score.toFixed(2)}</p>
                                </div>
                            </div>
                        `;
                        resultContainer.innerHTML += bookCard;
                    });

                } catch (error) {
                    resultContainer.innerHTML = `
                        <div class="alert alert-danger" role="alert">
                            Terjadi kesalahan dalam mengambil data. Silakan coba lagi.
                        </div>
                    `;
                    console.error('Error:', error);
                }
            };
        </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
