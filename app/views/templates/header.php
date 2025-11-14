<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Keuangan Pribadi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/keuangan_pribadi/public/assets/css/style.css">
</head>
<body>

<header class="app-header">
    <div class="brand">
        <span class="brand-logo">💰</span>
        <span class="brand-name">MyFin | Keuangan Pribadi</span>
    </div>

    <!-- tombol mobile -->
    <button class="btn-toggle-sidebar" id="toggleSidebar">
        ☰
    </button>
</header>

<div class="app-layout">

    <!-- SIDEBAR -->
    <aside class="app-sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="/keuangan_pribadi/public/index.php">Dashboard</a></li>
                <li><a href="/keuangan_pribadi/public/transactions/index.php">Transaksi</a></li>
                <li><a href="/keuangan_pribadi/public/categories/index.php">Kategori</a></li>
                <li><a href="/keuangan_pribadi/public/reports/index.php">Laporan</a></li>

                <!-- menu admin -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="/keuangan_pribadi/public/admin/users.php">Kelola User</a></li>
                <?php endif; ?>

                <li><a href="/keuangan_pribadi/public/logout.php" style="color:#ef4444;">Logout</a></li>
            </ul>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="app-main">
