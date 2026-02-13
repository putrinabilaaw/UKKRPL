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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    :root {
        --primary-blue: #2b6df2;
        --bg-light: #f4f7fa;
        --white: #ffffff;
        --text-muted: #95a5a6;
        --success-green: #27ae60;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-light);
        margin: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
    }

    /* --- Navbar --- */
    .dash-navbar {
        background: var(--white);
        padding: 12px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
        z-index: 1000;
    }

    .dash-logo {
        font-weight: 800;
        font-size: 22px;
        color: var(--primary-blue);
        text-decoration: none;
    }

    .dash-user {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .dash-user-info {
        text-align: right;
        line-height: 1.2;
    }

    .dash-name {
        display: block;
        font-weight: 700;
        font-size: 14px;
    }

    .dash-role {
        font-size: 11px;
        color: var(--primary-blue);
        font-weight: 600;
    }

    .dash-logout {
        color: #e74c3c;
        font-size: 18px;
        text-decoration: none;
    }

    /* --- Main Layout --- */
    .wrapper {
        display: flex;
        flex: 1;
        overflow: hidden;
    }

    /* --- Sidebar --- */
    .dash-sidebar {
        width: 350px;
        background: var(--white);
        border-right: 1px solid #eee;
        padding: 30px;
        overflow-y: auto;
    }

    .sidebar-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dash-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 8px;
        display: block;
    }

    .dash-input {
        width: 100%;
        padding: 12px 15px;
        background: #f8f9fb;
        border: 1px solid #eee;
        border-radius: 8px;
        font-size: 14px;
        margin-bottom: 15px;
        outline: none;
    }

    .dash-btn {
        width: 100%;
        padding: 14px;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }

    /* --- Content Area --- */
    .content-area {
        flex: 1;
        padding: 40px;
        overflow-y: auto;
    }

    .dash-card {
        background: var(--white);
        border-radius: 4px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #eee;
        position: relative;
        transition: all 0.3s ease;
    }

    /* Animasi Keluar Saat Hapus */
    .fade-out {
        opacity: 0;
        transform: scale(0.9);
    }

    .dash-card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .dash-meta {
        font-size: 12px;
        color: var(--primary-blue);
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-status {
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 800;
    }

    .pending {
        background: #fff9e6;
        color: #f39c12;
    }

    .dash-desc {
        font-size: 15px;
        color: #333;
        margin: 15px 0;
        line-height: 1.5;
    }

    .dash-feedback {
        background: #f8f9fb;
        border-left: 4px solid var(--primary-blue);
        padding: 15px;
        margin-top: 15px;
        margin-bottom: 15px;
        border-radius: 4px;
        display: none;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dash-card-foot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f1f1f1;
        padding-top: 15px;
        font-size: 12px;
        color: var(--text-muted);
    }

    .dash-action button {
        border: none;
        background: none;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        margin-left: 15px;
        transition: 0.2s;
        cursor: pointer;
    }

    .tanggapan-btn {
        color: var(--success-green);
    }

    .edit {
        color: var(--primary-blue);
    }

    .delete {
        color: #e74c3c;
    }

    .delete:hover {
        opacity: 0.7;
    }
    </style>
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
                            pada hari Rabu besok."</p>
                    </div>
                    <div class="dash-card-foot">
                        <span>Diunggah pada: 9 Feb 2026</span>
                        <div class="dash-action">
                            <button class="tanggapan-btn" onclick="toggleFeedback('feedback-1')">
                                <i class="fas fa-comment-dots me-1"></i> Tanggapan
                            </button>
                            <button class="edit" onclick="window.location.href='edit_pengaduan_siswa.php'">Edit</button>
                            <button class="delete" onclick="confirmDelete(this)">Hapus</button>
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
                        <p class="feedback-text">"Pekerjaan telah selesai. Ring basket baru sudah dipasang."</p>
                    </div>
                    <div class="dash-card-foot">
                        <span>Diunggah pada: 1 Feb 2026</span>
                        <div class="dash-action">
                            <button class="tanggapan-btn" onclick="toggleFeedback('feedback-2')">
                                <i class="fas fa-comment-dots me-1"></i> Tanggapan
                            </button>
                            <button class="edit" onclick="window.location.href='edit_pengaduan_siswa.php'">Edit</button>
                            <button class="delete" onclick="confirmDelete(this)">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
    function toggleFeedback(id) {
        const feedbackDiv = document.getElementById(id);
        feedbackDiv.style.display = (feedbackDiv.style.display === "none" || feedbackDiv.style.display === "") ?
            "block" : "none";
    }

    // FUNGSI KONFIRMASI HAPUS
    function confirmDelete(button) {
        const card = button.closest('.dash-card'); // Mengambil card terkait

        Swal.fire({
            title: 'Hapus Pengaduan?',
            text: "Apakah anda yakin mau menghapus pengaduan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Tambahkan animasi keluar
                card.classList.add('fade-out');

                // Tunggu animasi selesai baru hapus dari DOM
                setTimeout(() => {
                    card.remove();
                    Swal.fire({
                        title: 'Terhapus!',
                        text: 'Pengaduan Anda telah berhasil dihapus.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }, 300);
            }
        });
    }
    </script>

    <script src="assets/js/siswa.js"></script>

</body>

</html>