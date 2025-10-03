<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == 'admin123') {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kumpulan Resep</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container { max-width: 400px; margin: 80px auto; padding: 40px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); text-align: center; }
        .login-container h2 { color: var(--primary); margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; text-align: left; }
        .form-group label { display: block; margin-bottom: 6px; font-weight: 500; }
        .form-group input { width: 100%; padding: 10px 14px; border-radius: var(--radius); border: 1.5px solid #ccc; font-size: 1rem; box-sizing: border-box; }
        .error-message { color: #d9534f; margin-bottom: 16px; }
        .back-link { margin-top: 20px; display: block; color: #555; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Login Administrator</h2>
            <?php if ($error): ?>
                <p class="error-message"><?= $error ?></p>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
             <p style="margin-top:20px; font-size: 0.9em; color: #555;">Gunakan <b>admin</b> & <b>admin123</b></p>
            
             <a href="index.php" class="back-link">Kembali</a>
             </div>
    </div>
</body>
</html>