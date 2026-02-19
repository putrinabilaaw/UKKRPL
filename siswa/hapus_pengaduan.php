<?php
session_start();
require_once "../config.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = intval($_GET['id']);

$q = mysqli_query($conn, "
    SELECT si.foto, sa.foto_selesai
    FROM sarana_input_aspirasi si
    LEFT JOIN sarana_aspirasi sa 
    ON si.id_pelaporan = sa.id_pelaporan
    WHERE si.id_pelaporan='$id'
");

$data = mysqli_fetch_assoc($q);

if ($data) {

    if (!empty($data['foto']) && file_exists("../assets/img/" . $data['foto'])) {
        unlink("../assets/img/" . $data['foto']);
    }

    if (!empty($data['foto_selesai']) && file_exists("../assets/img/" . $data['foto_selesai'])) {
        unlink("../assets/img/" . $data['foto_selesai']);
    }

    mysqli_query($conn, "DELETE FROM sarana_aspirasi WHERE id_pelaporan='$id'");
    mysqli_query($conn, "DELETE FROM sarana_input_aspirasi WHERE id_pelaporan='$id'");
}

header("Location: dashboard.php");
exit;
?>
