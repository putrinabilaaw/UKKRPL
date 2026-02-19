<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
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
    sk.ket_kategori
FROM sarana_input_aspirasi si
JOIN sarana_kategori sk ON si.id_kategori = sk.id_kategori
WHERE si.id_pelaporan = '$id'
";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $ket = mysqli_real_escape_string($conn, $_POST['ket']);

    if (!empty($_FILES['foto']['name'])) {

        $folder = "../assets/img/";
        $namaBaru = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $namaBaru);

        mysqli_query($conn, "
            UPDATE sarana_input_aspirasi 
            SET lokasi='$lokasi', ket='$ket', foto='$namaBaru'
            WHERE id_pelaporan='$id'
        ");

    } else {

        mysqli_query($conn, "
            UPDATE sarana_input_aspirasi 
            SET lokasi='$lokasi', ket='$ket'
            WHERE id_pelaporan='$id'
        ");
    }

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/detail_pengaduan.css">

</head>

<body>

<div class="detail-wrapper">
<div class="card shadow detail-card">

<a href="dashboard.php" class="close-btn">✕</a>

<h5 class="fw-bold mb-3">Edit Pengaduan</h5>

<form method="POST" enctype="multipart/form-data">

<div class="section-title">Kategori</div>
<div><?= htmlspecialchars($data['ket_kategori']); ?></div>

<div class="section-title">Lokasi</div>
<input type="text" 
name="lokasi" 
class="form-control" 
value="<?= htmlspecialchars($data['lokasi']); ?>" required>

<div class="section-title">Keterangan</div>
<textarea name="ket" 
rows="4" 
class="form-control" required><?= htmlspecialchars($data['ket']); ?></textarea>

<?php if (!empty($data['foto'])): ?>
<div class="section-title">Foto Saat Ini</div>
<div class="img-wrapper">
    <img src="../assets/img/<?= $data['foto']; ?>" class="img-preview">
</div>
<?php endif; ?>

<div class="section-title">Ganti Foto (Opsional)</div>
<input type="file" name="foto" class="form-control" accept="image/*">

<div class="text-center mt-4">
    <button type="submit" class="btn btn-primary btn-sm px-4">
        Simpan
    </button>
    <a href="dashboard.php" class="btn btn-outline-secondary btn-sm ms-2">
        ← kembali
    </a>
</div>

</form>

</div>
</div>

</body>
</html>

