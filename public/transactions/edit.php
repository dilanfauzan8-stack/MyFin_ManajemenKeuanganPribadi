<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

$id = $_GET['id'];

// Ambil transaksi
$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id=? AND user_id=?");
$stmt->execute([$id, $_SESSION['user_id']]);
$transaction = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$transaction) {
    die("Transaksi tidak ditemukan!");
}

// Ambil kategori
$stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id=?");
$stmt->execute([$_SESSION['user_id']]);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Edit Transaksi</h1>
</section>

<section class="page-section">
<form action="update.php" method="POST" class="form-basic">

    <input type="hidden" name="id" value="<?= $transaction['id'] ?>">

    <label>Kategori</label>
    <select name="category_id" required>
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id']==$transaction['category_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($c['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Nominal</label>
    <input type="number" name="amount" required value="<?= $transaction['amount'] ?>">

    <label>Tanggal</label>
    <input type="date" name="date" required value="<?= $transaction['date'] ?>">

    <label>Deskripsi</label>
    <textarea name="description"><?= htmlspecialchars($transaction['description']) ?></textarea>

    <button type="submit" class="btn-primary">Update</button>
</form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
