<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    echo "ID Pemesanan tidak ditemukan.";
    exit;
}

$id = $_GET['id'];


$query = "SELECT p.*, k.nama_kereta 
          FROM pemesanan p
          JOIN kereta k ON p.id_kereta = k.id_kereta
          WHERE p.id_pemesanan = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data pemesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Tiket</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 40px;
        }

        .ticket {
            border: 2px dashed #333;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            background-color: #fefefe;
        }

        h2 {
            text-align: center;
            color: #222;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        td {
            padding: 8px 0;
        }

        .print-btn {
            text-align: center;
            margin-top: 20px;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="ticket">
    <h2>Tiket Pemesanan Kereta</h2>
    <table>
        <tr><td><strong>ID Pemesanan</strong></td><td>: <?= $data['id_pemesanan']; ?></td></tr>
        <tr><td><strong>Nama Pemesan</strong></td><td>: <?= $data['nama_pemesan']; ?></td></tr>
        <tr><td><strong>Nama Kereta</strong></td><td>: <?= $data['nama_kereta']; ?></td></tr>
        <tr><td><strong>Tujuan</strong></td><td>: <?= $data['tujuan']; ?></td></tr>
        <tr><td><strong>Tanggal Berangkat</strong></td><td>: <?= $data['tanggal_berangkat']; ?></td></tr>
        <tr><td><strong>Jumlah Tiket</strong></td><td>: <?= $data['jumlah_tiket']; ?></td></tr>
        <tr><td><strong>Status Bayar</strong></td><td>: <?= $data['status_bayar']; ?></td></tr>
        <tr><td><strong>Waktu Pemesanan</strong></td><td>: <?= $data['waktu_pemesanan']; ?></td></tr>
    </table>

    <div class="print-btn">
        <button onclick="window.print()">🖨️ Cetak Tiket</button>
    </div>
</div>

</body>
</html>
