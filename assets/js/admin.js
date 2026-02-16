
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

    // FUNGSI FILTER YANG SUDAH DIREVISI TOTAL
    function applyFilters(status, btn) {
        // Update UI tombol status jika ada perubahan
        if (status) {
            activeStatus = status;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        // Ambil semua kriteria filter
        const dateVal = document.getElementById('fDate').value;
        const catVal = document.getElementById('fCategory').value;
        const searchVal = document.getElementById('fSearch').value.toLowerCase();

        // Jalankan filter pada tabel
        document.querySelectorAll('#tableLaporan tbody tr').forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            const rowDate = row.getAttribute('data-tanggal');
            const rowCat = row.getAttribute('data-kategori');
            const rowText = row.innerText.toLowerCase();

            // Logika pencocokan (Masing-masing filter harus TRUE)
            const matchStatus = (activeStatus === 'Semua' || rowStatus === activeStatus);
            const matchDate = (!dateVal || rowDate === dateVal);
            const matchCat = (!catVal || rowCat === catVal); // Perbaikan: membandingkan dengan catVal
            const matchSearch = (!searchVal || rowText.includes(searchVal));

            // Jika semua filter cocok, tampilkan barisnya
            if (matchStatus && matchDate && matchCat && matchSearch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
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
  