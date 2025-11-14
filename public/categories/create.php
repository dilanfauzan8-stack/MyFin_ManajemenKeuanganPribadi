<?php
require_once "../../app/middleware/auth.php";
include "../../app/views/templates/header.php";
?>

<section class="page-header">
    <h1>Tambah Kategori</h1>
</section>

<section class="page-section">
<form action="store.php" method="POST" class="form-basic">
    
    <label>Nama Kategori</label>
    <input type="text" name="name" required placeholder="Contoh: Gaji, Makan, Transport">

    <label>Jenis</label>
    <select name="type" required>
        <option value="income">Pemasukan</option>
        <option value="expense">Pengeluaran</option>
    </select>

    <button type="submit" class="btn-primary">Simpan</button>
</form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
