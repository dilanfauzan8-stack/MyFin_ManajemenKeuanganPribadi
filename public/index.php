<?php
require_once "../app/middleware/auth.php";
require_once "../app/config/db.php";
include "../app/views/templates/header.php";

// Total pemasukan
$stmt = $pdo->prepare("
    SELECT SUM(t.amount) 
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    WHERE t.user_id = ? AND c.type = 'income'
");
$stmt->execute([$_SESSION['user_id']]);
$total_income = $stmt->fetchColumn() ?? 0;

// Total pengeluaran
$stmt = $pdo->prepare("
    SELECT SUM(t.amount) 
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    WHERE t.user_id = ? AND c.type = 'expense'
");
$stmt->execute([$_SESSION['user_id']]);
$total_expense = $stmt->fetchColumn() ?? 0;

// Saldo
$balance = $total_income - $total_expense;
?>
<section class="page-header">
    <h1>Dashboard Keuangan</h1>
    <p>Halo, <strong><?= $_SESSION['fullname']; ?></strong> 👋</p>

    <p>Ringkasan keuangan pribadi Anda hari ini.</p>
</section>

<section class="cards-grid">
    <article class="card card-income">
        <h2>Total Pemasukan</h2>
        <p class="amount">Rp <?php echo number_format($total_income, 0, ',', '.'); ?></p>
        <p class="subtitle">Bulan ini</p>
    </article>

    <article class="card card-expense">
        <h2>Total Pengeluaran</h2>
        <p class="amount">Rp <?php echo number_format($total_expense, 0, ',', '.'); ?></p>
        <p class="subtitle">Bulan ini</p>
    </article>

    <article class="card card-balance">
        <h2>Saldo</h2>
        <p class="amount">Rp <?php echo number_format($balance, 0, ',', '.'); ?></p>
        <p class="subtitle"><?php echo $balance >= 0 ? 'Keuangan Sehat 😊' : 'Perlu Dikontrol ⚠️'; ?></p>
    </article>
</section>

<section class="page-section">
    <header class="section-header">
        <h2>Grafik Sederhana</h2>
        <p>Perbandingan pemasukan dan pengeluaran.</p>
    </header>
    <canvas id="financeChart" width="400" height="220"></canvas><script>
const canvas = document.getElementById('financeChart');
if (canvas) {
    const ctx = canvas.getContext('2d');

    // Data asli dari PHP
    const income = <?= $total_income ?>;
    const expense = <?= $total_expense ?>;

    const max = Math.max(income, expense) || 1;
    const incomeHeight = (income / max) * (canvas.height - 40);
    const expenseHeight = (expense / max) * (canvas.height - 40);

    const barWidth = 60;
    const gap = 40;
    const baseY = canvas.height - 20;

    // background
    ctx.fillStyle = 'rgba(15,23,42,0.9)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // income bar
    ctx.fillStyle = '#4ade80';
    ctx.fillRect(60, baseY - incomeHeight, barWidth, incomeHeight);

    // expense bar
    ctx.fillStyle = '#f97373';
    ctx.fillRect(60 + barWidth + gap, baseY - expenseHeight, barWidth, expenseHeight);

    // labels
    ctx.fillStyle = '#e5e7eb';
    ctx.font = '12px system-ui';
    ctx.fillText('Pemasukan', 60, baseY + 10);
    ctx.fillText('Pengeluaran', 60 + barWidth + gap, baseY + 10);
}
</script>
</section>

<section class="page-section">
    <header class="section-header">
        <h2>Tips Keuangan</h2>
    </header>
    <ul class="tips-list">
        <li>Catat semua pemasukan dan pengeluaran harian.</li>
        <li>Bedakan antara kebutuhan dan keinginan.</li>
        <li>Sisihkan minimal 10% pemasukan untuk tabungan.</li>
    </ul>
</section>

<?php
include __DIR__ . '/../app/views/templates/footer.php';
?>
