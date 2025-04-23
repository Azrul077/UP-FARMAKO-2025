<?php
// hapus_jadwal.php
include 'koneksi.php';

// Ambil parameter id dari URL
$id_jadwal = $_GET['id'];

// Hapus jadwal berdasarkan id_jadwal
mysqli_query($conn, "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'");

// Redirect kembali ke halaman kelola
header("Location: kelola_jadwal.php");
exit;
?>
