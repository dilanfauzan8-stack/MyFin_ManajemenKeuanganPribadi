<?php
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
include "../../app/views/templates/header.php";

/* FILTER */
$from = $_GET['from'] ?? '';
$to   = $_GET['to'] ?? '';

$params = [$_SESSION['user_id']];
$where  = " WHERE t.user_id = ? ";

if ($from !== '') {
    $where .= " AND t.date >= ? ";
    $params[] = $from;
}

if ($to !== '') {
    $where .= " AND t.date <= ? ";
    $params[] = $to;
}

/* TOTAL PEMASUKAN */
$stmt = $pdo->prepare("
    SELECT SUM(t.amount)
    FROM transactions t 
    JOIN categories c ON c.id = t.category_id
    $where AND c.type = 'income'
");
$stmt->execute($params);
$total_income = $stmt->fetchColumn() ?? 0;

/* TOTAL PENGELUARAN */
$stmt = $pdo->prepare("
    SELECT SUM(t.amount)
    FROM transactions t 
    JOIN categories c ON c.id = t.category_id
    $where AND c.type = 'expense'
");
$stmt->execute($params);
$total_expense = $stmt->fetchColumn() ?? 0;

$balance = $total_income - $total_expense;

/* REKAP PER KATEGORI */
$stmt = $pdo->prepare("
    SELECT c.name, c.type, SUM(t.amount) AS total
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where
    GROUP BY c.id
    ORDER BY total DESC
");
$stmt->execute($params);
$category_summary = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="page-header">
    <h1>Laporan Keuangan</h1>
    <p>Lihat ringkasan pemasukan dan pengeluaran Anda.</p>
</section>

<form method="get" class="search-bar" style="max-width:600px;margin-bottom:1rem;">
    <input type="date" name="from" value="<?= $from ?>">
    <input type="date" name="to" value="<?= $to ?>">
    <button class="btn-sm info">Filter</button>
    <a href="export_pdf.php?from=<?= $from ?>&to=<?= $to ?>" 
   class="btn-sm info" 
   style="margin-left: 5px;">
   Export PDF
</a>

</form>

<div class="stats-grid">

    <div class="stat-card">
        <h3>Total Pemasukan</h3>
        <p class="income">Rp <?= number_format($total_income,0,',','.') ?></p>
    </div>

    <div class="stat-card">
        <h3>Total Pengeluaran</h3>
        <p class="expense">Rp <?= number_format($total_expense,0,',','.') ?></p>
    </div>

    <div class="stat-card">
        <h3>Saldo</h3>
        <p class="balance">Rp <?= number_format($balance,0,',','.') ?></p>
    </div>

</div>

<section class="page-section">
    <h2>Ringkasan Per Kategori</h2>

    <canvas id="pieChart" width="350" height="350"></canvas>

    <table class="table-basic" style="margin-top:1rem;">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Jenis</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($category_summary)): ?>
                <tr><td colspan="3">Tidak ada data.</td></tr>
            <?php else: ?>
                <?php foreach ($category_summary as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['name']) ?></td>
                        <td><?= $c['type']=='income'?'Pemasukan':'Pengeluaran' ?></td>
                        <td>Rp <?= number_format($c['total'],0,',','.') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</section>

<script>
/* PIE CHART */
const canvas = document.getElementById("pieChart");

<?php if (!empty($category_summary)): ?>

const data = [
    <?php foreach ($category_summary as $c): ?>
        { label: "<?= $c['name'] ?>", value: <?= $c['total'] ?> },
    <?php endforeach; ?>
];

const ctx = canvas.getContext("2d");
let total = data.reduce((a,b)=>a+b.value,0);
let start = 0;

data.forEach(item => {
    let slice = (item.value / total) * Math.PI * 2;

    ctx.fillStyle = "#" + Math.floor(Math.random()*16777215).toString(16);
    ctx.beginPath();
    ctx.moveTo(175,175);
    ctx.arc(175,175,150,start,start+slice);
    ctx.closePath();
    ctx.fill();

    start += slice;
});

<?php endif; ?>
</script>

<?php include "../../app/views/templates/footer.php"; ?>
