<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

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

    .admin-content {
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    /* --- Stats Section --- */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .stat-info h4 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .stat-info p {
        margin: 0;
        font-size: 11px;
        color: #95a5a6;
        font-weight: 700;
        text-transform: uppercase;
    }

    .bg-blue {
        background: #e8f0fe;
        color: #2b6df2;
    }

    .bg-orange {
        background: #fff4e6;
        color: #f39c12;
    }

    .bg-green {
        background: #e6f9ed;
        color: #27ae60;
    }

    /* --- REVISI: Filter Buttons Berwarna --- */
    .status-filter-group {
        display: flex;
        gap: 5px;
        background: #f1f3f5;
        padding: 5px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }

    .filter-btn {
        border: none;
        background: transparent;
        padding: 8px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        color: #7f8c8d;
        transition: 0.3s;
    }

    /* Warna saat AKTIF sesuai kategori */
    .filter-btn[data-type="Semua"].active {
        color: var(--primary-blue) !important;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .filter-btn[data-type="Menunggu"].active {
        color: #f39c12 !important;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .filter-btn[data-type="Proses"].active {
        color: #2b6df2 !important;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .filter-btn[data-type="Selesai"].active {
        color: #27ae60 !important;
        background: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Warna saat HOVER */
    .filter-btn[data-type="Menunggu"]:hover:not(.active) {
        color: #f39c12;
    }

    .filter-btn[data-type="Proses"]:hover:not(.active) {
        color: #2b6df2;
    }

    .filter-btn[data-type="Selesai"]:hover:not(.active) {
        color: #27ae60;
    }

    .admin-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    /* --- Tabel Status Pills --- */
    .status-pill {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        display: inline-block;
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

    .category-badge {
        font-size: 11px;
        font-weight: 700;
        color: var(--primary-blue);
        background: rgba(43, 109, 242, 0.05);
        padding: 4px 8px;
        border-radius: 5px;
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

    .input-custom {
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
    }

    .btn-export-main {
        background: #2b6df2;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 13px;
        font-weight: 600;
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
                        <tr data-status="Menunggu" data-tanggal="2026-02-09" data-kategori="Fasilitas Kelas">
                            <td><span class="text-muted tgl-text" style="font-size: 13px;">09 Feb 2026</span></td>
                            <td>
                                <div class="fw-bold pelapor-nama">Budi Santoso</div>
                                <div class="meta-id">2024001 • XII RPL 1</div>
                            </td>
                            <td><span class="category-badge">Fasilitas Kelas</span>
                                <div class="mt-1 fw-bold text-uppercase" style="font-size: 11px;">Ruang 10</div>
                            </td>
                            <td><i class="text-muted">"AC Tidak Dingin..."</i></td>
                            <td><span class="status-pill st-menunggu">Menunggu</span></td>
                            <td class="text-center"><button class="btn-action btn-tanggapi">Tanggapi</button></td>
                        </tr>
                        <tr data-status="Proses" data-tanggal="2026-02-10" data-kategori="Fasilitas Kelas">
                            <td><span class="text-muted tgl-text" style="font-size: 13px;">10 Feb 2026</span></td>
                            <td>
                                <div class="fw-bold pelapor-nama">Andi Wijaya</div>
                                <div class="meta-id">2024005 • XII RPL 2</div>
                            </td>
                            <td><span class="category-badge">Fasilitas Kelas</span>
                                <div class="mt-1 fw-bold text-uppercase" style="font-size: 11px;">Lab Komp</div>
                            </td>
                            <td><i class="text-muted">"Keyboard Rusak..."</i></td>
                            <td><span class="status-pill st-proses">Proses</span></td>
                            <td class="text-center"><button class="btn-action btn-tanggapi">Tanggapi</button></td>
                        </tr>
                        <tr data-status="Selesai" data-tanggal="2026-02-01" data-kategori="Alat Olahraga">
                            <td><span class="text-muted tgl-text" style="font-size: 13px;">01 Feb 2026</span></td>
                            <td>
                                <div class="fw-bold pelapor-nama">Siti Aminah</div>
                                <div class="meta-id">2024002 • XI MM</div>
                            </td>
                            <td><span class="category-badge">Alat Olahraga</span>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    let activeStatus = 'Semua';

    function updateStats() {
        const rows = document.querySelectorAll('#tableLaporan tbody tr');
        let total = rows.length;
        let proses = 0;
        let selesai = 0;
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            if (status === 'Proses') proses++;
            if (status === 'Selesai') selesai++;
        });
        document.getElementById('count-total').innerText = total;
        document.getElementById('count-proses').innerText = proses;
        document.getElementById('count-selesai').innerText = selesai;
    }

    function applyFilters(status, btn) {
        if (status) {
            activeStatus = status;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }
        const dateVal = document.getElementById('fDate').value;
        const catVal = document.getElementById('fCategory').value;
        const searchVal = document.getElementById('fSearch').value.toLowerCase();

        document.querySelectorAll('#tableLaporan tbody tr').forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const rowDate = row.getAttribute('data-tanggal');
            const rowCat = row.getAttribute('data-kategori');
            const rowText = row.innerText.toLowerCase();

            const matchStatus = (activeStatus === 'Semua' || rowStatus === activeStatus);
            const matchDate = (!dateVal || rowDate === dateVal);
            const matchCat = (!catVal || rowCat === matchCat); // Fix logic typo here
            const matchSearch = (!searchVal || rowText.includes(searchVal));

            row.style.display = (matchStatus && matchDate && (catVal === "" || rowCat === catVal) &&
                matchSearch) ? '' : 'none';
        });
    }

    window.onload = updateStats;

    function handleExport(type) {
        document.getElementById('exportLabel').innerText = "Ekspor " + type;
        if (type === 'Excel') exportToExcel();
        else if (type === 'PDF') exportToPDF();
    }

    function exportToExcel() {
        const table = document.getElementById("tableLaporan");
        const rows = Array.from(table.querySelectorAll("tr")).filter(row => row.style.display !== 'none');
        const ws_data = rows.map(row => Array.from(row.querySelectorAll("th, td")).slice(0, -1).map(cell => cell
            .innerText.trim()));
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet(ws_data);
        XLSX.utils.book_append_sheet(wb, ws, "Laporan");
        XLSX.writeFile(wb, "Laporan_Aspirasi.xlsx");
    }

    function exportToPDF() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF('l', 'mm', 'a4');
        const body = [];
        document.querySelectorAll("#tableLaporan tbody tr").forEach(row => {
            if (row.style.display !== 'none') {
                body.push([row.cells[0].innerText, row.cells[1].innerText.replace(/\n/g, " "), row.cells[2]
                    .innerText.replace(/\n/g, " "), row.cells[3].innerText, row.cells[4].innerText
                ]);
            }
        });
        doc.autoTable({
            head: [
                ['Tgl Masuk', 'Pelapor', 'Kategori', 'Aspirasi', 'Status']
            ],
            body: body,
            theme: 'grid',
            headStyles: {
                fillColor: [43, 109, 242]
            }
        });
        doc.save("Laporan_Aspirasi.pdf");
    }
    </script>
</body>

</html>