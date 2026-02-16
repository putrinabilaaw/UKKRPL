
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
