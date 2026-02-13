let activeStatus = 'Semua';

function applyFilters(status, btn) {
    if (status) {
        activeStatus = status;
        const buttons = document.querySelectorAll('.filter-btn');
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }

    const dateVal = document.getElementById('fDate').value;
    const monthVal = document.getElementById('fMonth').value;
    const catVal = document.getElementById('fCategory').value;
    const searchVal = document.getElementById('fSearch').value.toLowerCase();

    const rows = document.querySelectorAll('#tableLaporan tbody tr');

    rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const rowDate = row.getAttribute('data-tanggal');
        const rowCat = row.getAttribute('data-kategori');
        const rowFullText = row.innerText.toLowerCase();
        const rowDateText = row.querySelector('.tgl-text').innerText;

        const matchStatus = (activeStatus === 'Semua' || rowStatus === activeStatus);
        const matchDate = (!dateVal || rowDate === dateVal);
        const matchMonth = (!monthVal || rowDateText.includes(monthVal));
        const matchCat = (!catVal || rowCat === catVal);
        const matchSearch = (!searchVal || rowFullText.includes(searchVal));

        row.style.display = (matchStatus && matchDate && matchMonth && matchCat && matchSearch) ? '' : 'none';
    });
}

function handleExport(type) {
    const exportLabel = document.getElementById('exportLabel');
    const exportBtn = document.getElementById('btnExportToggle');
    const icon = exportBtn.querySelector('i');

    exportLabel.innerText = type;

    if (type === 'Excel') {
        icon.className = 'fa fa-file-excel me-1';
        exportToExcel();
    } else if (type === 'PDF') {
        icon.className = 'fa fa-file-pdf me-1';
        exportToPDF();
    }
}

function exportToExcel() {
    const table = document.getElementById("tableLaporan");
    const rows = Array.from(table.querySelectorAll("tr"))
        .filter(row => row.style.display !== 'none');

    const ws_data = [];

    rows.forEach(row => {
        const cells = Array.from(row.querySelectorAll("th, td"));
        const rowData = cells.slice(0, -1).map(cell => cell.innerText.trim());
        ws_data.push(rowData);
    });

    const wb = XLSX.utils.book_new();
    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    XLSX.utils.book_append_sheet(wb, ws, "Laporan Aspirasi");
    XLSX.writeFile(wb, "Laporan_Aspirasi_SASS.xlsx");
}

function exportToPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4');

    doc.text("Laporan Aspirasi SASS", 14, 15);

    const table = document.getElementById("tableLaporan");
    const body = [];
    const rows = table.querySelectorAll("tbody tr");

    rows.forEach(row => {
        if (row.style.display !== 'none') {
            const rowData = [
                row.cells[0].innerText.trim(),
                row.cells[1].innerText.trim().replace(/\n/g, " "),
                row.cells[2].innerText.trim().replace(/\n/g, " "),
                row.cells[3].innerText.trim(),
                row.cells[4].innerText.trim()
            ];
            body.push(rowData);
        }
    });

    doc.autoTable({
        head: [['Tgl Masuk', 'Pelapor', 'Kategori & Lokasi', 'Aspirasi', 'Status']],
        body: body,
        startY: 20,
        theme: 'grid',
        headStyles: { fillColor: [43, 109, 242] }
    });

    doc.save("Laporan_Aspirasi_SASS.pdf");
}
