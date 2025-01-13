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
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        .title {
            margin-bottom: 20px;
        }

        .card-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 250px;
            text-align: center;
        }

        .card h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #ffec99;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }

        .social-icons a {
            color: #fff;
            text-decoration: none;
            font-size: 1 rem;
            transition: transform 0.3s, color 0.3s;
        }

        .social-icons a:hover {
            transform: scale(1.2);
            color: #ffec99;
        }

        .footer {
            margin-top: 30px;
            font-size: 0.9rem;
            color: #ddd;
        }

        .footer a {
            color: #ffec99;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
    <!-- Include Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="title">Credits</h1>
    <div class="card-container">
        <!-- Card 1 -->
        <div class="card">
            <h2>Fadhil Hadrian Azzami</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/fadhilhadrian" target="_blank"><i class="bi bi-linkedin"></i>Linkedin<i
                        class="fab fa-linkedin"></i></a>
                <a href="https://instagram.com/fadhilhadrian" target="_blank"><i class="bi bi-instagram"></i>Instagram<i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="card">
            <h2>Fikri Abdurrohim Ibnu Prabowo</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/fikriabdurrohim" target="_blank"><i
                        class="bi bi-linkedin"></i>Linkedin<i class="fab fa-linkedin"></i></a>
                <a href="https://instagram.com/fikriabdurrohim" target="_blank"><i
                        class="bi bi-linkedin"></i>Instagram<i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="card">
            <h2>Putrandi Agung Prabowo</h2>
            <div class="social-icons">
                <a href="https://linkedin.com/in/putrandiagung" target="_blank"><i class="bi bi-linkedin"></i>Linkedin<i
                        class="fab fa-linkedin"></i></a>
                <a href="https://instagram.com/putrandiagung" target="_blank"><i class="bi bi-linkedin"></i>Instagram<i
                        class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Developed with ❤️ by <a href="/">Team S1T24K06</a></p>
    </div>
</body>

</html>
