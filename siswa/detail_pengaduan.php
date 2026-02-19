<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

$query = "
SELECT 
    si.*,
    sk.ket_kategori,
    sa.status,
    sa.feedback,
    sa.foto_selesai
FROM sarana_input_aspirasi si
JOIN sarana_kategori sk ON si.id_kategori = sk.id_kategori
LEFT JOIN sarana_aspirasi sa ON si.id_pelaporan = sa.id_pelaporan
WHERE si.id_pelaporan = '$id'
";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

$status = $data['status'] ?? 'Menunggu';
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/detail_pengaduan.css">


</head>

<body>

<div class="detail-wrapper">
<div class="card shadow detail-card">

<a href="dashboard.php" class="close-btn">✕</a>

<h5 class="fw-bold mb-3">Detail Pengaduan</h5>

<div class="d-flex justify-content-between align-items-center mb-3">
    <small class="text-muted">
        <?= date('d M Y', strtotime($data['tgl_input'])); ?>
    </small>

    <?php
    $status = $data['status'] ?? 'Menunggu';
    $warna = 'bg-secondary';

    if($status == 'Proses') $warna = 'bg-warning text-dark';
    if($status == 'Selesai') $warna = 'bg-success';
    ?>

    <span class="badge <?= $warna; ?> badge-status">
        <?= strtoupper($status); ?>
    </span>
</div>

<div class="section-title">Kategori</div>
<div><?= htmlspecialchars($data['ket_kategori']); ?></div>

<div class="section-title">Lokasi</div>
<div><?= htmlspecialchars($data['lokasi']); ?></div>

<div class="section-title">Keterangan</div>
<div><?= htmlspecialchars($data['ket']); ?></div>

<?php if (!empty($data['foto'])): ?>
<div class="section-title">Bukti Awal</div>
<div class="img-wrapper">
    <img src="../assets/img/<?= $data['foto']; ?>" class="img-preview">
</div>
<?php endif; ?>

<?php if (!empty($data['feedback'])): ?>
<div class="section-title">Feedback Admin</div>
<div class="mb-2"><?= htmlspecialchars($data['feedback']); ?></div>
<?php endif; ?>

<?php if (!empty($data['foto_selesai'])): ?>
<div class="section-title">Bukti Selesai</div>
<img src="../assets/img/<?= $data['foto_selesai']; ?>" class="img-fluid img-preview">
<?php endif; ?>

<div class="text-center mt-4">
    <a href="dashboard.php" class="btn btn-outline-secondary btn-sm">
        ← Kembali
    </a>
</div>

</div>
</div>

</body>
</html>
