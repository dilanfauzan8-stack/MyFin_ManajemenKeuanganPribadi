<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="auth-body">

<div class="auth-container">
    <h2>Buat Akun Baru</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="process_register.php" method="POST">
        <input type="text" name="fullname" placeholder="Nama Lengkap" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="btn-primary" style="width:100%;">Daftar</button>
    </form>

    <p class="auth-note">
        Sudah punya akun?
        <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>
