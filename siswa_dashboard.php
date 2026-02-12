<?php
session_start();

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: login.php");
    exit;
}
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
    <link rel="stylesheet" href="assets/css/siswa.css">

</head>

<body>
    <nav class="dash-navbar">
        <a href="#" class="dash-logo">SASS</a>
        <div class="dash-user">
            <div class="dash-user-info">
                <span class="dash-name">
                    <?= htmlspecialchars($_SESSION['username']); ?>
                </span>
                <span class="dash-role">
                    <?= htmlspecialchars($_SESSION['role']); ?>
                </span>
            </div>
            <a href="logout.php" class="dash-logout">
                <i class="fas fa-power-off"></i>
            </a>
        </div>
    </nav>

    <div class="wrapper">
        <aside class="dash-sidebar">
            <h5 class="sidebar-title">
                <i class="fas fa-edit text-primary"></i> Buat Pengaduan
            </h5>

            <form id="aspForm">
                <label class="dash-label">Kategori Sarana</label>
                <select id="kat" class="dash-input">
                    <option>Fasilitas Kelas</option>
                    <option>Laboratorium</option>
                    <option>Toilet</option>
                    <option>Alat Olahraga</option>
                </select>

                <label class="dash-label">Lokasi Detail</label>
                <input id="lok" type="text" class="dash-input" placeholder="Contoh: Ruang 10" required>

                <label class="dash-label">Keterangan</label>
                <textarea id="ket" rows="4" class="dash-input" placeholder="Ceritakan detail kerusakan..."
                    required></textarea>

                <button type="submit" class="dash-btn">Kirim Sekarang</button>
            </form>
        </aside>

        <main class="content-area">
            <h5 class="mb-4 fw-bold">Riwayat Pengaduan</h5>

            <div id="listAspirasi">
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div>
                            <span class="dash-meta">Ruang 10 • Fasilitas Kelas</span>
                            <h5 class="fw-bold mb-0 mt-1">AC Tidak Dingin</h5>
                        </div>
                        <span class="badge-status pending">MENUNGGU</span>
                    </div>

                    <p class="dash-desc">
                        "AC di bagian pojok belakang mengeluarkan suara bising dan tidak mengeluarkan udara dingin."
                    </p>

                    <div id="feedback-1" class="dash-feedback">
                        <span class="feedback-title"><i class="fas fa-reply me-1"></i> Tanggapan Admin:</span>
                        <p class="feedback-text">"Laporan telah kami terima. Teknisi akan dijadwalkan untuk pengecekan
                            pada hari Rabu besok. Mohon ditunggu."</p>
                    </div>

                    <div class="dash-card-foot">
                        <span>Diunggah pada: 9 Feb 2026</span>
                        <div class="dash-action">
                            <button class="tanggapan-btn" onclick="toggleFeedback('feedback-1')">
                                <i class="fas fa-comment-dots me-1"></i> Tanggapan
                            </button>
                            <button class="edit">Edit</button>
                            <button class="delete">Hapus</button>
                        </div>
                    </div>
                </div>

                <div class="dash-card">
                    <div class="dash-card-head">
                        <div>
                            <span class="dash-meta">Lapangan Basket • Alat Olahraga</span>
                            <h5 class="fw-bold mb-0 mt-1">Ring Basket Copot</h5>
                        </div>
                        <span class="badge-status bg-success text-white">SELESAI</span>
                    </div>

                    <p class="dash-desc">
                        "Ring basket di sebelah utara sudah sangat goyang dan akhirnya copot saat jam olahraga tadi
                        pagi."
                    </p>

                    <div id="feedback-2" class="dash-feedback">
                        <span class="feedback-title"><i class="fas fa-reply me-1"></i> Tanggapan Admin:</span>
                        <p class="feedback-text">"Pekerjaan telah selesai. Ring basket baru sudah dipasang dan diperkuat
                            bautnya. Terima kasih atas laporannya."</p>
                    </div>

                    <div class="dash-card-foot">
                        <span>Diunggah pada: 1 Feb 2026</span>
                        <div class="dash-action">
                            <button class="tanggapan-btn" onclick="toggleFeedback('feedback-2')">
                                <i class="fas fa-comment-dots me-1"></i> Tanggapan
                            </button>
                            <button class="edit" disabled style="opacity: 0.5; cursor: not-allowed;">Edit</button>
                            <button class="delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/siswa.js"></script>
</body>
</html>