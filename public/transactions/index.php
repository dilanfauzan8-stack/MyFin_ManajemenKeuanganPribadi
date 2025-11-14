<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

/* PAGINATION */
$perPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $perPage;

/* FILTER & SEARCH */
$keyword = $_GET['q'] ?? '';
$from    = $_GET['from'] ?? '';
$to      = $_GET['to'] ?? '';

$params = [$_SESSION['user_id']];
$where  = " WHERE t.user_id = ? ";

/* FILTER TANGGAL */
if ($from !== '') {
    $where .= " AND t.date >= ? ";
    $params[] = $from;
}
if ($to !== '') {
    $where .= " AND t.date <= ? ";
    $params[] = $to;
}

/* SEARCH */
if ($keyword !== '') {
    $where .= " AND (c.name LIKE ? OR t.description LIKE ?) ";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

/* HITUNG TOTAL DATA */
$sqlCount = "
    SELECT COUNT(*) 
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where
";
$stmt = $pdo->prepare($sqlCount);
$stmt->execute($params);
$totalRows = (int)$stmt->fetchColumn();
$totalPages = $totalRows > 0 ? ceil($totalRows / $perPage) : 1;

/* AMBIL DATA PER PAGE */
$sqlData = "
    SELECT t.*, c.name AS category_name, c.type 
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where
    ORDER BY t.date DESC, t.id DESC
    LIMIT $perPage OFFSET $offset
";
$stmt = $pdo->prepare($sqlData);
$stmt->execute($params);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Transaksi</h1>
    <p>Catat pemasukan dan pengeluaran Anda.</p>
</section>

<div class="toolbar-row">

    <a href="create.php" class="btn-primary btn-inline">+ Tambah Transaksi</a>

    <form method="get" class="search-bar">
        <input type="date" name="from" value="<?= $from ?>">
        <input type="date" name="to" value="<?= $to ?>">
        <input type="text" name="q" placeholder="Cari kategori / deskripsi..." 
               value="<?= htmlspecialchars($keyword) ?>">
        <button class="btn-sm info">Filter</button>
    </form>

</div>

<section class="page-section">

<table class="table-basic">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Kategori</th>
            <th>Jenis</th>
            <th>Nominal</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php if (empty($transactions)): ?>
            <tr><td colspan="6">Belum ada transaksi yang cocok.</td></tr>
        <?php else: ?>
            <?php foreach ($transactions as $t): ?>
            <tr>
                <td><?= htmlspecialchars($t['date']) ?></td>
                <td><?= htmlspecialchars($t['category_name']) ?></td>
                <td><?= $t['type']=='income' ? 'Pemasukan' : 'Pengeluaran' ?></td>
                <td>Rp <?= number_format($t['amount'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($t['description']) ?></td>
                <td>
                    <a class="btn-sm info" href="edit.php?id=<?= $t['id'] ?>">Edit</a>
                    <a class="btn-sm danger"
                       onclick="return confirm('Yakin ingin hapus transaksi?')"
                       href="delete.php?id=<?= $t['id'] ?>">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</section>

<?php if ($totalPages > 1): ?>
<nav class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page-1 ?>&q=<?= urlencode($keyword) ?>&from=<?= $from ?>&to=<?= $to ?>">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <?php if ($i == $page): ?>
            <span class="active"><?= $i ?></span>
        <?php else: ?>
            <a href="?page=<?= $i ?>&q=<?= urlencode($keyword) ?>&from=<?= $from ?>&to=<?= $to ?>"><?= $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page+1 ?>&q=<?= urlencode($keyword) ?>&from=<?= $from ?>&to=<?= $to ?>">Next &raquo;</a>
    <?php endif; ?>
</nav>
<?php endif; ?>

<?php include "../../app/views/templates/footer.php"; ?>
