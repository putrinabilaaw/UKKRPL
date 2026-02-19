<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] !== 'admin') {
    die("Akses ditolak!");
}


$query = "
SELECT 
    si.id_pelaporan,
    si.tgl_input,
    si.lokasi,
    si.ket,
    si.nis,
    sk.ket_kategori,
    sa.status,
    s.nama,
    s.kelas
FROM sarana_input_aspirasi si
JOIN sarana_kategori sk ON si.id_kategori = sk.id_kategori
JOIN sarana_siswa s ON si.nis = s.nis
LEFT JOIN sarana_aspirasi sa ON si.id_pelaporan = sa.id_pelaporan
ORDER BY si.tgl_input DESC
";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
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
                    admin
                </span>
            </div>
            <a href="../logout.php" class="dash-logout">
                <i class="fas fa-power-off"></i>
            </a>

        </div>
    </nav>

    <main class="container admin-content">
        <div class="admin-header">
            <div>
                <h1>Kelola Aspirasi</h1>
                <p class="subtitle">Data pengaduan masuk secara keseluruhan</p>
            </div>
            <div class="dropdown">
                <button class="btn btn-export-main dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    id="btnExportToggle">
                    <i class="fa fa-file-export me-1"></i> <span id="exportLabel">Ekspor Data</span>
                </button>
                <ul class="dropdown-menu shadow border-0">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="handleExport('Excel')"><i
                                class="fa fa-file-excel text-success me-2"></i> Excel</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="handleExport('PDF')"><i
                                class="fa fa-file-pdf text-danger me-2"></i> PDF</a></li>
                </ul>
            </div>
        </div>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon bg-blue"><i class="fas fa-inbox"></i></div>
                <div class="stat-info">
                    <p>Total Masuk</p>
                    <h4 id="count-total">0</h4>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-orange"><i class="fas fa-spinner"></i></div>
                <div class="stat-info">
                    <p>Dalam Proses</p>
                    <h4 id="count-proses">0</h4>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <p>Selesai</p>
                    <h4 id="count-selesai">0</h4>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="filter-bar-extra d-flex align-items-center flex-wrap gap-2 border-bottom pb-3">
                <div class="status-filter-group" id="filterContainer">
                    <button class="filter-btn active" data-type="Semua"
                        onclick="applyFilters('Semua', this)">Semua</button>
                    <button class="filter-btn" data-type="Menunggu"
                        onclick="applyFilters('Menunggu', this)">Menunggu</button>
                    <button class="filter-btn" data-type="Proses" onclick="applyFilters('Proses', this)">Proses</button>
                    <button class="filter-btn" data-type="Selesai"
                        onclick="applyFilters('Selesai', this)">Selesai</button>
                </div>
                <input type="date" id="fDate" class="input-custom" onchange="applyFilters()">

                <select id="fCategory" class="input-custom" onchange="applyFilters()">
                    <option value="">Semua Kategori</option>
                    <option value="Fasilitas Kelas">Fasilitas Kelas</option>
                    <option value="Alat Olahraga">Alat Olahraga</option>
                </select>

                <input type="text" id="fSearch" class="input-custom flex-grow-1" placeholder="Cari pelapor atau NIS..."
                    onkeyup="applyFilters()">
            </div>

            <div class="table-responsive mt-3">
                <table class="table admin-table" id="tableLaporan">
                    <thead>
                        <tr>
                            <th>Tgl Masuk</th>
                            <th>Pelapor</th>
                            <th>Kategori & Lokasi</th>
                            <th>Aspirasi</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>

                        <?php
                        $status = $row['status'] ?? 'Menunggu';

                        $statusClass = 'st-menunggu';
                        if ($status == 'Proses') $statusClass = 'st-proses';
                        if ($status == 'Selesai') $statusClass = 'st-selesai';
                        ?>

                        <tr 
                        data-status="<?= $status; ?>" 
                        data-tanggal="<?= $row['tgl_input']; ?>" 
                        data-kategori="<?= htmlspecialchars($row['ket_kategori']); ?>">

                        <td>
                            <span class="text-muted tgl-text" style="font-size: 13px;">
                                <?= date('d M Y', strtotime($row['tgl_input'])); ?>
                            </span>
                        </td>

                        <td>
                            <div class="fw-bold pelapor-nama">
                                <?= htmlspecialchars($row['nama']); ?>
                            </div>
                            <div class="meta-id">
                                <?= htmlspecialchars($row['nis']); ?> • <?= htmlspecialchars($row['kelas']); ?>
                            </div>
                        </td>

                        <td>
                            <span class="category-badge">
                                <?= htmlspecialchars($row['ket_kategori']); ?>
                            </span>
                            <div class="mt-1 fw-bold text-uppercase" style="font-size: 11px;">
                                <?= htmlspecialchars($row['lokasi']); ?>
                            </div>
                        </td>

                        <td>
                            <i class="text-muted">
                                "<?= htmlspecialchars($row['ket']); ?>"
                            </i>
                        </td>

                        <td>
                            <span class="status-pill <?= $statusClass; ?>">
                                <?= $status; ?>
                            </span>
                        </td>

                        <td class="text-center">
                            <button class="btn-action btn-tanggapi"
                                onclick="window.location.href='detail_pengaduan.php?id=<?= $row['id_pelaporan']; ?>'">
                                Detail
                            </button>
                        </td>

                        </tr>

                        <?php endwhile; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/admin.js"></script>
</body>

</html>