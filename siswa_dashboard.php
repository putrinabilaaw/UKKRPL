<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Siswa</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Dashboard CSS -->
    <link rel="stylesheet" href="assets/css/siswa.css">
</head>
<body>

<!-- Navbar -->
<nav class="dash-navbar">
    <div class="dash-logo">SASS</div>

    <div class="dash-user">
        <div class="dash-user-info">
            <span class="dash-name">Budi Santoso</span>
            <span class="dash-role">Siswa • XII RPL 1</span>
        </div>
        <a href="logout.php" class="dash-logout">
            <i class="fas fa-power-off"></i>
        </a>
    </div>
</nav>

<!-- Content -->
<main class="container dash-content">
    <div class="row g-4">
        <!-- Form Aspirasi -->
        <div class="col-lg-4">
            <div class="dash-card">
                <h5 class="dash-card-title">
                    <i class="fas fa-pen-nib text-primary"></i> Buat Pengaduan
                </h5>

                <form id="aspForm">
                    <div class="mb-3">
                        <label class="dash-label">Kategori</label>
                        <select id="kat" class="dash-input">
                            <option>Fasilitas Kelas</option>
                            <option>Alat Olahraga</option>
                            <option>Laboratorium</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="dash-label">Lokasi</label>
                        <input id="lok" type="text" class="dash-input" placeholder="Contoh: Ruang 10" required>
                    </div>

                    <div class="mb-3">
                        <label class="dash-label">Keterangan</label>
                        <textarea id="ket" rows="3" class="dash-input" placeholder="Ceritakan detail kerusakan..." required></textarea>
                    </div>

                    <button type="submit" class="dash-btn">
                        Kirim Sekarang
                    </button>
                </form>
            </div>
        </div>

        <!-- Riwayat -->
        <div class="col-lg-8">
            <h5 class="mb-3 fw-bold">Riwayat Pengaduan</h5>

            <div id="listAspirasi" class="d-flex flex-column gap-3">
                <!-- Card -->
                <div class="dash-card">
                    <div class="dash-card-head">
                        <div>
                            <span class="dash-meta">Ruang 10 • Fasilitas Kelas</span>
                            <h6 class="fw-bold mb-0">AC Tidak Dingin</h6>
                        </div>
                        <span class="badge-status pending">Menunggu</span>
                    </div>

                    <p class="dash-desc">
                        "AC di bagian pojok belakang mengeluarkan suara bising dan tidak mengeluarkan udara dingin."
                    </p>

                    <div class="dash-card-foot">
                        <span>9 Feb 2026</span>
                        <div class="dash-action">
                            <button class="edit">Edit</button>
                            <button class="delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
document.getElementById('aspForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const lok = lok.value;
    const kat = kat.value;
    const ket = ket.value;

    const html = `
        <div class="dash-card">
            <div class="dash-card-head">
                <div>
                    <span class="dash-meta">${lok} • ${kat}</span>
                    <h6 class="fw-bold mb-0">Laporan Baru</h6>
                </div>
                <span class="badge-status pending">Menunggu</span>
            </div>
            <p class="dash-desc">"${ket}"</p>
            <div class="dash-card-foot">
                <span>Baru saja</span>
                <div class="dash-action">
                    <button class="edit">Edit</button>
                    <button class="delete">Hapus</button>
                </div>
            </div>
        </div>
    `;

    document.getElementById('listAspirasi').insertAdjacentHTML('afterbegin', html);
    this.reset();
});
</script>

</body>
</html>
