<?php
include "koneksi.php";
$id = $_GET['id'];

mysqli_query($conn, "UPDATE pemesanan SET status_bayar = 'Sudah Bayar' WHERE id_pemesanan = '$id'");
header("Location: pembayaran.php");
exit;
