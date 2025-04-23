<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pemesan = $_POST['nama_pemesan'];
    $id_kereta = $_POST['id_kereta']; 
    $tanggal_berangkat = $_POST['tanggal'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $tujuan = $_POST['tujuan'];

    
    $status_bayar = 'belum bayar';
    $waktu_pemesanan = date('Y-m-d H:i:s'); 

    
    $query = "INSERT INTO pemesanan 
              (nama_pemesan, id_kereta, tanggal_berangkat, jumlah_tiket, tujuan, status_bayar, waktu_pemesanan) 
              VALUES 
              ('$nama_pemesan', '$id_kereta', '$tanggal_berangkat', '$jumlah_tiket', '$tujuan', '$status_bayar', '$waktu_pemesanan')";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Tiket berhasil dipesan!'); window.location='kelola_pemesanan.php';</script>";
    } else {
        echo "Gagal memesan tiket: " . mysqli_error($conn);
    }
} else {
    echo "Metode tidak valid.";
}
?>
