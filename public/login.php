<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Manajemen Keuangan Pribadi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="auth-body">

<div class="auth-container">
    <h2>Login</h2>

    <!-- Notifikasi error -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Notifikasi sukses -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert success">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <form action="process_login.php" method="POST" id="formLogin">

        <input type="text" id="username" name="username" placeholder="Username" required>

        <input type="password" id="password" name="password" placeholder="Password" required>

        <!-- checkbox remember me -->
        <label class="remember-me">
            <input type="checkbox" name="remember" value="1">
            Ingat Saya
        </label>

        <button class="btn-primary" style="width:100%;">Login</button>
    </form>

    <p class="auth-note" style="margin-top:10px;">
        Belum punya akun?
        <a href="register.php">Daftar disini</a>
    </p>
</div>

</body>
</html>
