<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
    :root {
        --primary-blue: #2b6df2;
        --bg-light: #f4f7fa;
        --white: #ffffff;
        --text-muted: #95a5a6;
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

    /* --- Sidebar (Form Pengaduan) --- */
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
        /* Lebih kotak */
        font-size: 14px;
        margin-bottom: 15px;
        outline: none;
    }

    .dash-input:focus {
        border-color: var(--primary-blue);
        background: white;
    }

    .dash-btn {
        width: 100%;
        padding: 14px;
        background: var(--primary-blue);
        color: white;
        border: none;
        border-radius: 8px;
        /* Lebih kotak */
        font-weight: 600;
        transition: 0.3s;
    }

    .dash-btn:hover {
        background: #1a56d1;
    }

    /* --- Content Area --- */
    .content-area {
        flex: 1;
        padding: 40px;
        overflow-y: auto;
    }

    /* --- REVISI: CARD RIWAYAT KOTAK DENGAN SHADOW SEKELILING --- */
    .dash-card {
        background: var(--white);
        border-radius: 4px;
        /* Dibuat sangat kotak/siku */
        padding: 25px;
        margin-bottom: 25px;
        /* Shadow di sekeliling (spread 10px) */
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        border: 1px solid #eee;
        position: relative;
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
        /* Kotak */
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
    }

    .edit {
        color: var(--primary-blue);
    }

    .delete {
        color: #e74c3c;
    }
    </style>
</head>

<body>

    <nav class="dash-navbar">
        <a href="#" class="dash-logo">SASS</a>
        <div class="dash-user">
            <div class="dash-user-info">
                <span class="dash-name">Budi Santoso</span>
                <span class="dash-role">Siswa • XII RPL 1</span>
            </div>
            <a href="#" class="dash-logout"><i class="fas fa-power-off"></i></a>
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

                    <div class="dash-card-foot">
                        <span>Diunggah pada: 9 Feb 2026</span>
                        <div class="dash-action">
                            <button class="edit">Edit</button>
                            <button class="delete">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>