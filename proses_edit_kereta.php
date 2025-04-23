<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_kereta'];
    $nama_kereta = $_POST['nama_kereta'];
    $jenis = $_POST['jenis'];


    $query = "UPDATE kereta SET nama_kereta = '$nama_kereta', jenis = '$jenis' WHERE id_kereta = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data kereta berhasil diupdate'); window.location='kelola_kereta.php';</script>";
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
} else {
    echo "Metode tidak diperbolehkan.";
}
?>
