
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
   