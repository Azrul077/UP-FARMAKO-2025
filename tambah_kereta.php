<?php
include 'koneksi.php';

// Hindari error karena output sebelum header
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_kereta = htmlspecialchars($_POST['nama_kereta']);
    $jenis = htmlspecialchars($_POST['jenis']);
    $kapasitas = intval($_POST['kapasitas']);

    $query = "INSERT INTO kereta (nama_kereta, jenis, kapasitas) 
              VALUES ('$nama_kereta', '$jenis', '$kapasitas')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: kelola_kereta.php");
        exit;
    } else {
        echo "Gagal menambahkan kereta: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kereta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Kereta</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama_kereta" class="form-label">Nama Kereta</label>
            <input type="text" name="nama_kereta" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis Kereta</label>
            <select name="jenis" class="form-select" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="Eksekutif">Eksekutif</option>
                <option value="Bisnis">Bisnis</option>
                <option value="Ekonomi">Ekonomi</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Jumlah Kursi</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="kelola_kereta.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
