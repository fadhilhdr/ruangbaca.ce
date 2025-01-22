<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <title>Credits</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://i.pinimg.com/736x/44/cd/03/44cd030734b7002cf3281355ac1cd4ba.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #fff;
        }

        .card-container {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .card h2 {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #333;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }

        .social-icons a {
            color: #333;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #ddd;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card-container">
        <!-- Card 1 -->
        <div class="card">
            <h2>Fadhil Hadrian Azzami</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/fadhilhadrian" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://instagram.com/fadhilhadrian" target="_blank"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="card">
            <h2>Fikri Abdurrohim Ibnu Prabowo</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/fikriabdurrohim" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://instagram.com/fikriabdurrohim" target="_blank"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="card">
            <h2>Putrandi Agung Prabowo</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/putrandiagung" target="_blank"><i class="bi bi-linkedin"></i></a>
                <a href="https://instagram.com/putrandiagung" target="_blank"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Developed with ❤️ by <a href="/">Team S1T24K06</a></p>
    </div>
</body>

</html>
