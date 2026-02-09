<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Dashboard Admin</title>

    <!-- Bootstrap (grid & table helper) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Admin Dashboard CSS -->
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<!-- Navbar -->
<nav class="admin-navbar">
    <div class="admin-logo">
        SASS <span>Admin</span>
    </div>

    <div class="admin-nav-right">
        <input type="text" class="admin-search" placeholder="Cari laporan...">
        <a href="logout.php" class="admin-logout">Keluar</a>
    </div>
</nav>

<!-- Content -->
<main class="container admin-content">
    <div class="admin-header">
        <div>
            <h1>Kelola Aspirasi</h1>
            <p>Semua Pengaduan Masuk</p>
        </div>

        <div class="admin-filter">
            <button class="active">Semua</button>
            <button class="pending">Menunggu</button>
            <button class="done">Selesai</button>
        </div>
    </div>

    <!-- Table -->
    <div class="admin-card">
        <table class="table admin-table">
            <thead>
                <tr>
                    <th>Informasi Pelapor</th>
                    <th>Detail Pengaduan</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Budi Santoso</strong>
                        <div class="meta">2024001 • XII RPL 1</div>
                    </td>
                    <td>
                        <div class="loc">Ruang 10</div>
                        <div class="desc">AC Tidak Dingin dan berisik...</div>
                    </td>
                    <td>
                        <span class="status pending">Menunggu</span>
                    </td>
                    <td class="text-center">
                        <button class="btn-action primary"
                            onclick="alert('Buka modal tanggapan (simulasi)')">
                            Tanggapi
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Siti Aminah</strong>
                        <div class="meta">2024002 • XI MM</div>
                    </td>
                    <td>
                        <div class="loc">Lap. Basket</div>
                        <div class="desc">Ring basket copot sebelah...</div>
                    </td>
                    <td>
                        <span class="status done">Selesai</span>
                    </td>
                    <td class="text-center">
                        <button class="btn-action disabled">
                            Detail
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
