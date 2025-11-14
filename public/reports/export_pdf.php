<?php
session_start();
require_once "../../app/middleware/auth.php";
require_once "../../app/config/db.php";
require_once "../../app/libraries/fpdf.php";

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

// total income
$stmt = $pdo->prepare("
    SELECT SUM(t.amount)
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where AND c.type = 'income'
");
$stmt->execute($params);
$total_income = $stmt->fetchColumn() ?? 0;

// total expense
$stmt = $pdo->prepare("
    SELECT SUM(t.amount)
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where AND c.type = 'expense'
");
$stmt->execute($params);
$total_expense = $stmt->fetchColumn() ?? 0;

$balance = $total_income - $total_expense;

// ambil detail transaksi
$stmt = $pdo->prepare("
    SELECT t.date, c.name AS category_name, c.type, t.amount, t.description
    FROM transactions t
    JOIN categories c ON c.id = t.category_id
    $where
    ORDER BY t.date ASC
");
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ================== PDF GENERATION ==================
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);

$pdf->Cell(0,10,'Laporan Keuangan Pribadi',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,'Nama: ' . $_SESSION['fullname'],0,1);
if ($from || $to) {
    $pdf->Cell(0,6,'Periode: ' . ($from ?: '-') . ' s/d ' . ($to ?: '-'),0,1);
}
$pdf->Ln(4);

// ringkasan
$pdf->SetFont('Arial','B',11);
$pdf->Cell(60,7,'Total Pemasukan',1,0);
$pdf->Cell(60,7,'Total Pengeluaran',1,0);
$pdf->Cell(60,7,'Saldo',1,1);

$pdf->SetFont('Arial','',11);
$pdf->Cell(60,7,'Rp '.number_format($total_income,0,',','.'),1,0);
$pdf->Cell(60,7,'Rp '.number_format($total_expense,0,',','.'),1,0);
$pdf->Cell(60,7,'Rp '.number_format($balance,0,',','.'),1,1);

$pdf->Ln(5);

// tabel detail
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,7,'Tanggal',1);
$pdf->Cell(35,7,'Kategori',1);
$pdf->Cell(25,7,'Jenis',1);
$pdf->Cell(35,7,'Nominal',1);
$pdf->Cell(70,7,'Deskripsi',1);
$pdf->Ln();

$pdf->SetFont('Arial','',9);
if (empty($rows)) {
    $pdf->Cell(190,7,'Tidak ada data transaksi.',1,1,'C');
} else {
    foreach ($rows as $r) {
        $pdf->Cell(25,6,$r['date'],1);
        $pdf->Cell(35,6,substr($r['category_name'],0,15),1);
        $pdf->Cell(25,6, $r['type']=='income'?'Masuk':'Keluar',1);
        $pdf->Cell(35,6,'Rp '.number_format($r['amount'],0,',','.'),1);
        $pdf->Cell(70,6,substr($r['description'],0,35),1);
        $pdf->Ln();
    }
}

$pdf->Output('I','laporan_keuangan.pdf');
exit;
