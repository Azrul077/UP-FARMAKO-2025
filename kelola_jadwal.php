<?php
include "koneksi.php";

// Ambil data jadwal dari database
$query = "SELECT jadwal.id_jadwal, kereta.nama_kereta, jadwal.asal, jadwal.tujuan, 
                 jadwal.tgl_berangkat, jadwal.waktu_berangkat, jadwal.waktu_tiba, jadwal.harga
          FROM jadwal
          JOIN kereta ON jadwal.id_kereta = kereta.id_kereta";
$resultJadwal = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Kelola Jadwal Keberangkatan</h2>
    <a href="tambah_jadwal.php" class="btn btn-primary mb-3">+ Tambah Jadwal</a>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>
    <table class="table table-bordered table-striped" id="datatablesSimple"><thead class="table-dark">
    <tr>
        <th>No</th>
        <th>Nama Kereta</th>
        <th>Stasiun Asal</th>
        <th>Stasiun Tujuan</th>
        <th>Tanggal</th>
        <th>Jam Berangkat</th>
        <th>Jam Tiba</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($resultJadwal)) {
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama_kereta'] ?></td>
            <td><?= $row['asal'] ?></td>
            <td><?= $row['tujuan'] ?></td>
            <td><?= $row['tgl_berangkat'] ?></td>
            <td><?= $row['waktu_berangkat'] ?></td>
            <td><?= $row['waktu_tiba'] ?></td>
            <td>Rp<?= number_format($row['harga'], 0, '', '') ?></td>
            <td>
                <a href="edit_jadwal.php?id=<?= $row['id_jadwal'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="hapus_jadwal.php?id=<?= $row['id_jadwal'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">Hapus</a>
            </td>
        </tr>
    <?php
    }
    ?>
</tbody>

    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
<script>
    new simpleDatatables.DataTable("#datatablesSimple");
</script>
</body>
</html>
