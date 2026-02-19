<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
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
    s.nama,
    s.kelas,
    sa.status,
    sa.feedback,
    sa.foto_selesai
FROM sarana_input_aspirasi si
JOIN sarana_kategori sk ON si.id_kategori = sk.id_kategori
JOIN sarana_siswa s ON si.nis = s.nis
LEFT JOIN sarana_aspirasi sa ON si.id_pelaporan = sa.id_pelaporan
WHERE si.id_pelaporan = '$id'
";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $status = $_POST['status'];
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    $foto_selesai = $data['foto_selesai'];

    if (!empty($_FILES['foto_selesai']['name'])) {
        $folder = "../assets/img/";
        $namaBaru = time() . "_" . $_FILES['foto_selesai']['name'];
        move_uploaded_file($_FILES['foto_selesai']['tmp_name'], $folder . $namaBaru);
        $foto_selesai = $namaBaru;
    }

    $cek = mysqli_query($conn, "SELECT * FROM sarana_aspirasi WHERE id_pelaporan='$id'");

    if (mysqli_num_rows($cek) > 0) {

        mysqli_query($conn, "
            UPDATE sarana_aspirasi 
            SET status='$status',
                feedback='$feedback',
                foto_selesai='$foto_selesai'
            WHERE id_pelaporan='$id'
        ");

    } else {

        mysqli_query($conn, "
            INSERT INTO sarana_aspirasi 
            (id_pelaporan, status, feedback, foto_selesai)
            VALUES
            ('$id', '$status', '$feedback', '$foto_selesai')
        ");
    }

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Detail Aspirasi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/detail_pengaduan.css">
</head>

<body>

<div class="detail-wrapper">
<div class="card shadow detail-card">

<a href="dashboard.php" class="close-btn">✕</a>

<h5 class="fw-bold mb-3">Detail Aspirasi</h5>

<div class="section-title">Pelapor</div>
<div><?= $data['nama']; ?> • <?= $data['kelas']; ?></div>

<div class="section-title">Kategori</div>
<div><?= $data['ket_kategori']; ?></div>

<div class="section-title">Lokasi</div>
<div><?= $data['lokasi']; ?></div>

<div class="section-title">Keterangan</div>
<div><?= $data['ket']; ?></div>

<?php if (!empty($data['foto'])): ?>
<div class="section-title">Bukti Awal</div>
<div class="img-wrapper">
    <img src="../assets/img/<?= $data['foto']; ?>" class="img-preview">
</div>
<?php endif; ?>

<hr>

<form method="POST" enctype="multipart/form-data">

<div class="section-title">Status</div>
<select name="status" class="form-control" required>
    <option value="Menunggu" <?= ($data['status']=='Menunggu')?'selected':''; ?>>Menunggu</option>
    <option value="Proses" <?= ($data['status']=='Proses')?'selected':''; ?>>Proses</option>
    <option value="Selesai" <?= ($data['status']=='Selesai')?'selected':''; ?>>Selesai</option>
</select>

<div class="section-title">Feedback</div>
<textarea name="feedback" class="form-control" rows="3"><?= $data['feedback']; ?></textarea>

<?php if (!empty($data['foto_selesai'])): ?>
<div class="section-title">Bukti Selesai</div>
<div class="img-wrapper">
    <img src="../assets/img/<?= $data['foto_selesai']; ?>" class="img-preview">
</div>
<?php endif; ?>

<div class="section-title">Upload Bukti Selesai</div>
<input type="file" name="foto_selesai" class="form-control">

<div class="text-center mt-4">
    <button type="submit" class="btn btn-primary">
        Simpan Perubahan
    </button>
</div>

</form>

</div>
</div>

</body>
</html>
