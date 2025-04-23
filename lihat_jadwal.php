<?php
include "koneksi.php";

// Ambil data jadwal, dan join ke tabel kereta biar bisa tampilkan nama keretanya
$query = "SELECT jadwal.*, kereta.nama_kereta 
          FROM jadwal 
          JOIN kereta ON jadwal.id_kereta = kereta.id_kereta";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Jadwal Kereta</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 18px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .back-link a {
            text-decoration: none;
            color: #28a745;
        }
    </style>
</head>
<body>

<h2>Daftar Jadwal Kereta</h2>

<table>
    <tr>
        <th>ID Jadwal</th>
        <th>ID Kereta</th>
        <th>Stasiun Asal</th>
        <th>Stasiun Tujuan</th>
        <th>Tanggal Berangkat</th>
        <th>Waktu Berangkat</th>
        <th>Waktu Tiba</th>
        <th>Harga</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_jadwal']; ?></td>
            <td><?= $row['id_kereta']; ?></td>
            <td><?= $row['asal']; ?></td>
            <td><?= $row['tujuan']; ?></td>
            <td><?= $row['tgl_berangkat']; ?></td>
            <td><?= $row['waktu_berangkat']; ?></td>
            <td><?= $row['waktu_tiba']; ?></td>
            <td><?= $row['harga'];?></td>
        </tr>
    <?php } ?>
</table>

<div class="back-link">
    <a href="user_dashboard.php">← Kembali ke Beranda</a>
</div>

</body>
</html>
