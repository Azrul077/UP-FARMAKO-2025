<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kereta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Kelola Data Kereta</h2>
    <a href="tambah_kereta.php" class="btn btn-primary mb-3">+ Tambah Kereta</a>
    <a href="admin_dashboard.php" class="btn btn-secondary mb-3">← Kembali</a>

    <table class="table table-bordered table-striped" id="datatablesSimple">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Kereta</th>
                <th>Jenis</th>
                <th>Jumlah Kursi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = "SELECT * FROM kereta";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . htmlspecialchars($row['nama_kereta']) . "</td>
                        <td>" . htmlspecialchars($row['jenis']) . "</td>
                        <td>" . htmlspecialchars($row['kapasitas']) . "</td>
                        <td>
                            <a href='edit_kereta.php?id=" . $row['id_kereta'] . "' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='hapus_kereta.php?id=" . $row['id_kereta'] . "' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                        </td>
                      </tr>";
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
