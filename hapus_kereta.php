<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus dulu semua jadwal yang menggunakan kereta ini
    $hapusJadwal = mysqli_query($conn, "DELETE FROM jadwal WHERE id_kereta = $id");

    // Baru hapus data kereta
    $hapusKereta = mysqli_query($conn, "DELETE FROM kereta WHERE id_kereta = $id");

    if ($hapusKereta) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='kelola_kereta.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data kereta'); window.location.href='kelola_kereta.php';</script>";
    }
} else {
    header("Location: kelola_kereta.php");
}
?>
