<?php
include "koneksi.php";
ob_start();

// Ambil data kereta untuk dropdown
$resultKereta = mysqli_query($conn, "SELECT * FROM kereta");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kereta        = $_POST['id_kereta'];
    $asal             = $_POST['asal'];
    $tujuan           = $_POST['tujuan'];
    $tgl_berangkat    = $_POST['tgl_berangkat'];
    $waktu_berangkat  = $_POST['waktu_berangkat'];
    $waktu_tiba       = $_POST['waktu_tiba'];
    $harga            = $_POST['harga'];

    // Query untuk menyimpan data tanpa id_jadwal karena itu AUTO_INCREMENT
    $query = "INSERT INTO jadwal (id_kereta, asal, tujuan, tgl_berangkat, waktu_berangkat, waktu_tiba, harga)
              VALUES ('$id_kereta', '$asal', '$tujuan', '$tgl_berangkat', '$waktu_berangkat', '$waktu_tiba', '$harga')";

    if (mysqli_query($conn, $query)) {
        header("Location: kelola_jadwal.php");
        exit;
    } else {
        // Menampilkan pesan error SQL
        echo "<div class='alert alert-danger'>Gagal menambahkan jadwal: " . mysqli_error($conn) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Jadwal Kereta</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="id_kereta" class="form-label">Nama Kereta</label>
            <select name="id_kereta" class="form-control" required>
                <option value="">-- Pilih Kereta --</option>
                <?php while ($row = mysqli_fetch_assoc($resultKereta)) : ?>
                    <option value="<?= $row['id_kereta'] ?>"><?= $row['nama_kereta'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="asal" class="form-label">Stasiun Asal</label>
            <input type="text" name="asal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tujuan" class="form-label">Stasiun Tujuan</label>
            <input type="text" name="tujuan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tgl_berangkat" class="form-label">Tanggal Keberangkatan</label>
            <input type="date" name="tgl_berangkat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="waktu_berangkat" class="form-label">Jam Berangkat</label>
            <input type="time" name="waktu_berangkat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="waktu_tiba" class="form-label">Jam Tiba</label>
            <input type="time" name="waktu_tiba" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga Tiket</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        <a href="kelola_jadwal.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
