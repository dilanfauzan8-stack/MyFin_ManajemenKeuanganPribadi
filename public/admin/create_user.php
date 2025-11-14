<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/middleware/admin.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";
?>

<section class="page-header">
    <h1>Tambah User Baru</h1>
    <p>Admin dapat membuat akun user baru.</p>
</section>

<section class="page-section">
    <form action="store_user.php" method="POST" class="form-basic" style="max-width:420px;">

        <label>Nama Lengkap</label>
        <input type="text" name="fullname" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button class="btn-primary" type="submit">Simpan User</button>
    </form>
</section>

<?php include "../../app/views/templates/footer.php"; ?>
