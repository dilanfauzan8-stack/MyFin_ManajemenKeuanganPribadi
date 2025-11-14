<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

// Ambil kategori user login
$stmt = $pdo->prepare("SELECT * FROM categories WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Tambah Transaksi</h1>
</section>

<section class="page-section">
<form action="store.php" method="POST" class="form-basic">

    <label>Kategori</label>
    <select name="category_id" required>
        <option value="">-- Pilih Kategori --</option>
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
        <?php endforeach; ?>
    </select>

    <label>Nominal</label>
    <input type="number" name="amount" required min="1">

    <label>Tanggal</label>
    <input type="date" name="date" required>

    <label>Deskripsi</label>
    <textarea name="description" placeholder="Opsional"></textarea>

    <button type="submit" class="btn-primary">Simpan</button>
</form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
