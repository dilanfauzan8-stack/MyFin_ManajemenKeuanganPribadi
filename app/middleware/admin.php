<?php
if ($_SESSION['role'] !== 'admin') {
    header("Location: /keuangan_pribadi/public/index.php");
    exit;
}
