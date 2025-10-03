<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Kumpulan Resep Tradisional</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: var(--bg);
        }
        .welcome-container {
            text-align: center;
            background: #fff;
            padding: 50px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            max-width: 600px;
        }
        .welcome-container h1 {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        .welcome-container p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 2rem;
        }
        .welcome-container .btn {
            padding: 12px 30px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Selamat Datang!</h1>
        <p>Temukan dan lestarikan kekayaan kuliner Nusantara bersama kami. Silakan masuk untuk melihat koleksi resep.</p>
        <a href="login.php" class="btn btn-primary">Mulai Sekarang</a>
    </div>
</body>
</html>