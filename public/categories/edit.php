<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die("Kategori tidak ditemukan!");
}
?>

<section class="page-header">
    <h1>Edit Kategori</h1>
</section>

<section class="page-section">
<form action="update.php" method="POST" class="form-basic">
    
    <input type="hidden" name="id" value="<?= $category['id'] ?>">

    <label>Nama Kategori</label>
    <input type="text" name="name" required value="<?= htmlspecialchars($category['name']) ?>">

    <label>Jenis</label>
    <select name="type" required>
        <option value="income" <?= $category['type']=='income'?'selected':'' ?>>Pemasukan</option>
        <option value="expense" <?= $category['type']=='expense'?'selected':'' ?>>Pengeluaran</option>
    </select>

    <button type="submit" class="btn-primary">Update</button>
</form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
