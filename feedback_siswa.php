<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SASS - Edit Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/feedback_siswa.css">
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

    <script src="assets/js/feedback_siswa.js"></script>

</body>

</html>