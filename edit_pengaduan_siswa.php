<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Edit Pengaduan</title>
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
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
    }

    .edit-container {
        width: 100%;
        max-width: 600px;
        background: var(--white);
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .header-edit {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .btn-back {
        color: var(--text-muted);
        text-decoration: none;
        font-size: 20px;
        transition: 0.2s;
    }

    .btn-back:hover {
        color: var(--primary-blue);
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
        margin-bottom: 20px;
        outline: none;
    }

    .dash-input:focus {
        border-color: var(--primary-blue);
        background: white;
    }

    .footer-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .btn-custom {
        flex: 1;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: 0.3s;
    }

    .btn-save {
        background: var(--primary-blue);
        color: white;
    }

    .btn-save:hover {
        background: #1a56d1;
    }

    .btn-cancel {
        background: #fee2e2;
        color: #ef4444;
    }

    .btn-cancel:hover {
        background: #fecaca;
    }
    </style>
</head>

<body>

    <div class="edit-container">
        <div class="header-edit">
            <a href="index.html" class="btn-back"><i class="fas fa-arrow-left"></i></a>
            <h4 class="mb-0 fw-bold">Edit Pengaduan</h4>
        </div>

        <form id="editForm">
            <label class="dash-label">Kategori Sarana</label>
            <select class="dash-input" id="editKat">
                <option>Fasilitas Kelas</option>
                <option>Laboratorium</option>
                <option>Toilet</option>
                <option>Alat Olahraga</option>
            </select>

            <label class="dash-label">Lokasi Detail</label>
            <input type="text" class="dash-input" id="editLok" value="Ruang 10">

            <label class="dash-label">Keterangan Kerusakan</label>
            <textarea rows="5" class="dash-input"
                id="editKet">AC di bagian pojok belakang mengeluarkan suara bising dan tidak mengeluarkan udara dingin.</textarea>

            <div class="footer-actions">
                <button type="button" class="btn-custom btn-cancel" onclick="confirmCancel()">Batal</button>
                <button type="button" class="btn-custom btn-save" onclick="confirmSave()">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    function confirmCancel() {
        Swal.fire({
            title: 'Batalkan Edit?',
            text: "Perubahan yang belum disimpan akan hilang.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'siswa_dashboard.php'; // Kembali ke halaman utama
            }
        })
    }

    function confirmSave() {
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Apakah anda yakin menyimpan pembaruan?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2b6df2',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: 'Ya, Simpan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulasi proses simpan
                Swal.fire('Tersimpan!', 'Pengaduan berhasil diperbarui.', 'success')
                    .then(() => {
                        window.location.href = 'siswa_dashboard.php';
                    });
            }
        })
    }
    </script>

</body>

</html>