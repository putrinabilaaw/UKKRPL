<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$qUser = mysqli_query($conn, "SELECT nis FROM sarana_siswa WHERE id_user='$id_user'");
$userData = mysqli_fetch_assoc($qUser);
$nis_login = $userData['nis'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_kategori = $_POST['id_kategori'];
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $ket = mysqli_real_escape_string($conn, $_POST['ket']);
    $tgl = date("Y-m-d");

    $namaFile = $_FILES['foto']['name'];
    $tmpFile = $_FILES['foto']['tmp_name'];

    $folder = "../assets/img/";
    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $namaBaru = time() . "_" . $namaFile;
    move_uploaded_file($tmpFile, $folder . $namaBaru);

    mysqli_query($conn, "INSERT INTO sarana_input_aspirasi 
    (nis,id_kategori,lokasi,ket,foto,tgl_input) 
    VALUES 
    ('$nis_login','$id_kategori','$lokasi','$ket','$namaBaru','$tgl')");

    header("Location: dashboard.php");
    exit;
}

$query = "
SELECT 
    si.id_pelaporan,
    si.tgl_input,
    si.lokasi,
    si.ket,
    si.foto,
    sk.ket_kategori,
    sa.status,
    sa.feedback,
    sa.foto_selesai
FROM sarana_input_aspirasi si
JOIN sarana_kategori sk ON si.id_kategori = sk.id_kategori
LEFT JOIN sarana_aspirasi sa ON si.id_pelaporan = sa.id_pelaporan
WHERE si.nis = '$nis_login'
ORDER BY si.tgl_input DESC
";


$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SASS - Dashboard Siswa</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/siswa.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<nav class="dash-navbar">
    <a href="#" class="dash-logo">SASS</a>
    <div class="dash-user">
        <div class="dash-user-info">
            <span class="dash-name"><?= htmlspecialchars($_SESSION['username']); ?></span>
            <span class="dash-role">Siswa</span>
        </div>
        <a href="../logout.php" class="dash-logout">
            <i class="fas fa-power-off"></i>
        </a>
    </div>
</nav>

<div class="wrapper">
<aside class="dash-sidebar">
<h5 class="sidebar-title">
<i class="fas fa-edit text-primary"></i> Buat Pengaduan
</h5>

<form method="POST" enctype="multipart/form-data">
    <label class="dash-label">Kategori Sarana</label>
    <select name="id_kategori" class="dash-input" required>
        <?php
        $kategori = mysqli_query($conn,"SELECT * FROM sarana_kategori");
        while($k = mysqli_fetch_assoc($kategori)){
            echo "<option value='".$k['id_kategori']."'>".$k['ket_kategori']."</option>";
        }
        ?>
    </select>

    <label class="dash-label">Lokasi Detail</label>
    <input name="lokasi" type="text" class="dash-input" placeholder="Contoh: Ruang 10" required>

    <label class="dash-label">Keterangan</label>
    <textarea name="ket" rows="4" class="dash-input" placeholder="Ceritakan detail kerusakan..." required></textarea>

    <label class="dash-label">Upload Bukti Foto</label>
    <input type="file" name="foto" class="dash-input" accept="image/*" required>

    <button type="submit" class="dash-btn">Kirim Sekarang</button>
</form>
</aside>

<main class="content-area">
<h5 class="mb-4 fw-bold">Riwayat Pengaduan</h5>

<div id="listAspirasi">
<?php while($row = mysqli_fetch_assoc($result)): ?>

<?php
$status = $row['status'] ?? 'Menunggu';

$badgeClass = 'pending';
if ($status == 'Proses') $badgeClass = 'processing';
if ($status == 'Selesai') $badgeClass = 'bg-success text-white';
?>

<div class="dash-card">
    <div class="dash-card-head">
        <div>
            <span class="dash-meta">
                <?= htmlspecialchars($row['lokasi']); ?> • <?= htmlspecialchars($row['ket_kategori']); ?>
            </span>
            <h5 class="fw-bold mb-0 mt-1">
                <?= htmlspecialchars($row['ket']); ?>
            </h5>
            <?php if (!empty($row['foto'])): ?>
                <img src="../assets/img/<?= $row['foto']; ?>" 
                    style="max-width:150px; margin-top:10px; border-radius:8px;">
            <?php endif; ?>

        </div>
        <span class="badge-status <?= $badgeClass; ?>">
            <?= strtoupper($status); ?>
        </span>
    </div>

    <p class="dash-desc">
        "<?= htmlspecialchars($row['ket']); ?>"
    </p>

    <?php if (!empty($row['feedback'])): ?>
    <div id="feedback-<?= $row['id_pelaporan']; ?>" 
         class="dash-feedback" 
         style="display:none;">
        <span class="feedback-title">
            <i class="fas fa-reply me-1"></i> Feedback Admin:
        </span>
        <p class="feedback-text">
            "<?= htmlspecialchars($row['feedback']); ?>"
        </p>
    </div>
    <?php endif; ?>

    <div class="dash-card-foot">
        <span>Diunggah pada: <?= date('d M Y', strtotime($row['tgl_input'])); ?></span>

        <div class="dash-action">

            <?php if (!empty($row['feedback'])): ?>
            <button class="tanggapan-btn" 
                onclick="toggleFeedback('feedback-<?= $row['id_pelaporan']; ?>')">
                Feedback
            </button>
            <?php endif; ?>

            <button class="detail"
            onclick="window.location.href='detail_pengaduan.php?id=<?= $row['id_pelaporan']; ?>'">
            Detail
            </button>

            <button class="edit"
            onclick="window.location.href='edit_pengaduan.php?id=<?= $row['id_pelaporan']; ?>'">
            Edit
            </button>


            <button class="delete"
            onclick="if(confirm('Yakin mau hapus pengaduan ini?')) 
            window.location.href='hapus_pengaduan.php?id=<?= $row['id_pelaporan']; ?>'">
            Hapus
            </button>


        </div>
    </div>
</div>

<?php endwhile; ?>
</div>

</main>
</div>

<script src="../assets/js/siswa.js"></script>
</body>
</html>
