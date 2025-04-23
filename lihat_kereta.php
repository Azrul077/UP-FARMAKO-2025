<?php
include "koneksi.php";

$query = "SELECT * FROM kereta";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kereta</title>
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
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 20px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007BFF;
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
            color: #007BFF;
        }
    </style>
</head>
<body>

<h2>Daftar Kereta</h2>

<table>
    <tr>
        <th>ID Kereta</th>
        <th>Nama Kereta</th>
        <th>Jenis</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id_kereta']; ?></td>
            <td><?= $row['nama_kereta']; ?></td>
            <td><?= $row['jenis']; ?></td>
        </tr>
    <?php } ?>
</table>

<div class="back-link">
    <a href="user_dashboard.php">← Kembali ke Beranda</a>
</div>

</body>
</html>
