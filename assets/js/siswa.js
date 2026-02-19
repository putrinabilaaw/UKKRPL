console.log("JS SISWA KELOAD");


function toggleFeedback(id) {
    const feedbackDiv = document.getElementById(id);
    feedbackDiv.style.display =
        (feedbackDiv.style.display === "none" || feedbackDiv.style.display === "")
            ? "block"
            : "none";
}

function confirmDelete(button) {
    const card = button.closest('.dash-card');

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
            card.classList.add('fade-out');

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

function showDetail(keterangan, fotoAwal, feedback, fotoSelesai) {

    let html = `<p><b>Keterangan:</b><br>${keterangan}</p>`;

    if (fotoAwal && fotoAwal !== 'assets/img/') {
        html += `
            <p><b>Bukti Awal:</b></p>
            <img src="${fotoAwal}" style="max-width:100%;border-radius:8px;margin-bottom:10px;">
        `;
    }

    if (feedback) {
        html += `
            <p><b>Feedback Admin:</b><br>${feedback}</p>
        `;
    }

    if (fotoSelesai && fotoSelesai !== 'assets/img/') {
        html += `
            <p><b>Bukti Selesai:</b></p>
            <img src="${fotoSelesai}" style="max-width:100%;border-radius:8px;">
        `;
    }

    Swal.fire({
        title: 'Detail Pengaduan',
        html: html,
        width: 600,
        confirmButtonText: 'Tutup'
    });
}

document.addEventListener("click", function(e) {
    if (e.target.classList.contains("detail-btn")) {

        const ket = e.target.dataset.ket;
        const foto = e.target.dataset.foto;
        const feedback = e.target.dataset.feedback;
        const fotoSelesai = e.target.dataset.fotoselesai;

        showDetail(ket, foto, feedback, fotoSelesai);
    }
});
