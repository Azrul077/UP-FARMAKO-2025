<?php
include 'koneksi.php';

// Ambil ID jadwal dari URL
$id_jadwal = $_GET['id'];

// Ambil data jadwal berdasarkan id_jadwal
$query = mysqli_query($conn, "SELECT * FROM jadwal WHERE id_jadwal = '$id_jadwal'");
$data = mysqli_fetch_assoc($query);

// Ambil data semua kereta untuk dropdown
$kereta = mysqli_query($conn, "SELECT * FROM kereta");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kereta       = $_POST['id_kereta'];
    $asal            = $_POST['asal'];
    $tujuan          = $_POST['tujuan'];
    $tgl_berangkat   = $_POST['tgl_berangkat'];
    $waktu_berangkat = $_POST['waktu_berangkat'];
    $waktu_tiba      = $_POST['waktu_tiba'];

    mysqli_query($conn, "UPDATE jadwal SET 
        id_kereta = '$id_kereta',
        asal = '$asal',
        tujuan = '$tujuan',
        tgl_berangkat = '$tgl_berangkat',
        waktu_berangkat = '$waktu_berangkat',
        waktu_tiba = '$waktu_tiba'
        WHERE id_jadwal = '$id_jadwal'
    ");

    header("Location: kelola_jadwal.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Jadwal Keberangkatan</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Nama Kereta</label>
            <select name="id_kereta" class="form-control" required>
                <option value="">-- Pilih Kereta --</option>
                <?php while ($row = mysqli_fetch_assoc($kereta)) : ?>
                    <option value="<?= $row['id_kereta'] ?>" <?= $row['id_kereta'] == $data['id_kereta'] ? 'selected' : '' ?>>
                        <?= $row['nama_kereta'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Stasiun Asal</label>
            <input type="text" name="asal" class="form-control" value="<?= $data['asal'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Stasiun Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="<?= $data['tujuan'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Keberangkatan</label>
            <input type="date" name="tgl_berangkat" class="form-control" value="<?= $data['tgl_berangkat'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jam Berangkat</label>
            <input type="time" name="waktu_berangkat" class="form-control" value="<?= $data['waktu_berangkat'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Jam Tiba</label>
            <input type="time" name="waktu_tiba" class="form-control" value="<?= $data['waktu_tiba'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="kelola_jadwal.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
