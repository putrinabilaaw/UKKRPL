<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --primary-blue: #2b6df2;
        --bg-light: #f4f7fa;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-light);
        color: #2d3436;
    }

    /* Navbar Styling */
    .admin-navbar {
        background: #fff;
        padding: 15px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }

    .admin-logo {
        font-weight: 800;
        font-size: 22px;
        color: var(--primary-blue);
    }

    .admin-logo span {
        color: #1e272e;
        font-weight: 400;
    }

    /* Container Content */
    .admin-content {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 25px;
    }

    h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .subtitle {
        color: #95a5a6;
        font-size: 14px;
    }

    /* REVISI: FILTER STATUS DI KANAN ATAS */
    .status-filter-group {
        display: flex;
        gap: 8px;
        background: #fff;
        padding: 6px;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .filter-btn {
        border: none;
        background: transparent;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #95a5a6;
        transition: 0.3s;
    }

    .filter-btn.active {
        background: #1e272e;
        color: #fff;
    }

    .filter-btn:hover:not(.active) {
        background: #f8f9fb;
        color: var(--primary-blue);
    }

    /* REVISI: CARD DENGAN SHADOW 5px */
    .admin-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        border: none;
        /* Shadow 5px tegas sekeliling */
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    /* Table Styling */
    .admin-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .admin-table thead th {
        background: #f8f9fb;
        border: none;
        color: #b2bec3;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px;
    }

    .admin-table tbody td {
        padding: 20px 15px;
        border-bottom: 1px solid #f1f1f1;
    }

    .meta-id {
        font-size: 12px;
        color: #95a5a6;
    }

    .category-badge {
        font-size: 11px;
        font-weight: 700;
        color: var(--primary-blue);
        background: rgba(43, 109, 242, 0.05);
        padding: 4px 8px;
        border-radius: 5px;
    }

    .status-pill {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .st-menunggu {
        background: #fff9e6;
        color: #f39c12;
    }

    .st-proses {
        background: #e8f0fe;
        color: #2b6df2;
    }

    .st-selesai {
        background: #e6f9ed;
        color: #27ae60;
    }

    .btn-action {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
    }

    .btn-tanggapi {
        background: #1e272e;
        color: white;
    }

    .btn-tanggapi:hover {
        background: var(--primary-blue);
    }
    </style>
</head>

<body>

    <nav class="admin-navbar">
        <div class="admin-logo">SASS <span>Admin</span></div>
        <div class="d-flex align-items-center gap-3">
            <span class="fw-bold" style="font-size: 14px;">Pak Admin (admin)</span>
            <a href="#" class="text-danger text-decoration-none fw-bold" style="font-size: 14px;">Logout</a>
        </div>
    </nav>

    <main class="container admin-content">
        <div class="admin-header">
            <div>
                <h1>Kelola Aspirasi</h1>
                <p class="subtitle">Data pengaduan masuk secara keseluruhan</p>
            </div>

            <div class="status-filter-group" id="filterContainer">
                <button class="filter-btn active" onclick="filterStatus('Semua', this)">Semua</button>
                <button class="filter-btn" onclick="filterStatus('Menunggu', this)">Menunggu</button>
                <button class="filter-btn" onclick="filterStatus('Proses', this)">Proses</button>
                <button class="filter-btn" onclick="filterStatus('Selesai', this)">Selesai</button>
            </div>
        </div>

        <div class="admin-card">
            <div class="table-responsive">
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
                        <tr data-status="Menunggu">
                            <td><span class="text-muted" style="font-size: 13px;">09 Feb 2026</span></td>
                            <td>
                                <div class="fw-bold">Budi Santoso</div>
                                <div class="meta-id">2024001 • XII RPL 1</div>
                            </td>
                            <td>
                                <span class="category-badge">Fasilitas Kelas</span>
                                <div class="mt-1 fw-bold text-uppercase" style="font-size: 11px;">Ruang 10</div>
                            </td>
                            <td><i class="text-muted">"AC Tidak Dingin dan berisik..."</i></td>
                            <td><span class="status-pill st-menunggu">Menunggu</span></td>
                            <td class="text-center"><button class="btn-action btn-tanggapi">Tanggapi</button></td>
                        </tr>
                        <tr data-status="Selesai">
                            <td><span class="text-muted" style="font-size: 13px;">01 Feb 2026</span></td>
                            <td>
                                <div class="fw-bold">Siti Aminah</div>
                                <div class="meta-id">2024002 • XI MM</div>
                            </td>
                            <td>
                                <span class="category-badge">Alat Olahraga</span>
                                <div class="mt-1 fw-bold text-uppercase" style="font-size: 11px;">Lap. Basket</div>
                            </td>
                            <td><i class="text-muted">"Ring basket copot..."</i></td>
                            <td><span class="status-pill st-selesai">Selesai</span></td>
                            <td class="text-center"><button class="btn-action btn-secondary" disabled>Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
    function filterStatus(status, btn) {
        // Update Button Active State
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Filter Table Rows
        const rows = document.querySelectorAll('#tableLaporan tbody tr');
        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'Semua' || rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    </script>

</body>

</html>