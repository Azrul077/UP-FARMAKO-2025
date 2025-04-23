<?php
include "koneksi.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: pembayaran");
    exit();
}

if (!isset($_SESSION['pemesanan_id'])) {
    header("Location: tiket_saya.php");
    exit();
}

$pemesanan_id = $_SESSION['pemesanan_id'];
$stmt = $pdo->prepare("SELECT * FROM pemesanan WHERE id = ?");
$stmt->execute([$pemesanan_id]);
$pemesanan = $stmt->fetch();

if (!$pemesanan) {
    header("Location: tiket_saya.php");
    exit();
}

$jadwalStmt = $pdo->prepare("
    SELECT j.*, k.nama_kereta 
    FROM jadwal j
    JOIN kereta k ON j.id_kereta = k.id
    WHERE j.id = ?
");
$jadwalStmt->execute([$pemesanan['jadwal_id']]);
$jadwal = $jadwalStmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pembayaran Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      border-radius: 16px;
      padding: 20px;
      border: none;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .info-label {
      font-weight: 600;
      color: #555;
    }
    .info-value {
      font-size: 16px;
      color: #333;
    }
    .btn-group {
      gap: 15px;
    }
    .section-title {
      font-size: 26px;
      font-weight: 700;
      color: #007bff;
    }
    .info-value {
      font-weight: bold;
      font-size: 16px;
    }
    .btn-outline-secondary {
      background-color: #f1f5f9;
      color: #6b7280;
      border-radius: 8px;
      padding: 10px 20px;
      text-decoration: none;
    }
    .btn-outline-secondary:hover {
      background-color: #e2e8f0;
      color: #4b5563;
    }
    .btn-primary {
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 8px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background-color: #2563eb;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <div class="text-center mb-4">
      <h2 class="section-title">Konfirmasi & Pembayaran Tiket</h2>
      <p class="text-muted">Periksa kembali data tiket Anda sebelum melanjutkan ke pembayaran.</p>
    </div>

    <div class="card mx-auto" style="max-width: 800px;">
      <div class="row mb-3">
        <div class="col-md-6 mb-2">
          <span class="info-label">ID Pemesanan:</span><br>
          <span class="info-value"><?= $pemesanan['id'] ?></span>
        </div>
        <div class="col-md-6 mb-2">
          <span class="info-label">Nama Pemesan:</span><br>
          <span class="info-value"><?= htmlspecialchars($pemesanan['nama_pemesan'] ?? 'Tidak diketahui') ?></span>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6 mb-2">
          <span class="info-label">Kereta:</span><br>
          <span class="info-value"><?= htmlspecialchars($jadwal['nama_kereta']) ?></span>
        </div>
        <div class="col-md-6 mb-2">
          <span class="info-label">Rute:</span><br>
          <span class="info-value"><?= htmlspecialchars($jadwal['asal']) ?> → <?= htmlspecialchars($jadwal['tujuan']) ?></span>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6 mb-2">
          <span class="info-label">Tanggal Keberangkatan:</span><br>
          <span class="info-value"><?= htmlspecialchars($jadwal['tanggal']) ?></span>
        </div>
        <div class="col-md-6 mb-2">
          <span class="info-label">Waktu:</span><br>
          <span class="info-value"><?= htmlspecialchars($jadwal['jam_berangkat']) ?> - <?= htmlspecialchars($jadwal['jam_tiba']) ?></span>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-md-6 mb-2">
          <span class="info-label">Jumlah Tiket:</span><br>
          <span class="info-value"><?= $pemesanan['jumlah_tiket'] ?></span>
        </div>
        <div class="col-md-6 mb-2">
          <span class="info-label">Kursi:</span><br>
          <span class="info-value"><?= htmlspecialchars($pemesanan['kursi'] ?? '-') ?></span>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-12">
          <span class="info-label">Total Harga:</span><br>
          <span class="info-value text-danger fw-bold fs-5">Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></span>
        </div>
      </div>

      <form action="metode_pembayaran.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="pemesanan_id" value="<?= $pemesanan['id'] ?>">

  <div class="mb-3">
    <label for="metode" class="form-label">Metode Pembayaran</label>
    <select name="metode" id="metode" class="form-select" required>
      <option value="">-- Pilih Metode --</option>
      <option value="transfer_bank">Bca: 1234567890 a/n E-Tiket Kereta</option>
      <option value="e-wallet">Dana: 1234567890 a/n E-Tiket Kereta</option>
      <option value="kartu_kredit">Gopay: 1234567890 a/n E-Tiket Kereta</option>
    </select>
  </div>

  <div class="mb-4">
    <label for="bukti_transfer" class="form-label">Unggah Bukti Pembayaran</label>
    <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>
  </div>

  <div class="d-flex justify-content-between">
    <!-- Tombol Kembali -->
    <a href="booking_kursi.php?jadwal_id=<?= $jadwal['id'] ?>" class="btn btn-outline-secondary w-48">
      Kembali
    </a>

    <!-- Tombol Bayar Sekarang -->
    <button type="submit" class="btn btn-primary w-48">
      Bayar Sekarang
    </button>
  </div>
</form>

    </div>
  </div>
  <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pemesanan_id = $_POST['pemesanan_id'];
    $metode = $_POST['metode'];
    $jumlah = $pemesanan['total_harga'];
    $status = 'menunggu';
    $bukti_transfer = '';

    // Validasi dan upload file
    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $ext = pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('bukti_') . '.' . $ext;
        $filePath = $uploadDir . $filename;

        // Validasi ekstensi file
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array(strtolower($ext), $allowed)) {
            move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $filePath);
            $bukti_transfer = $filename;
        } else {
            echo "<script>alert('Format file tidak didukung. Gunakan JPG/PNG/WebP.');</script>";
        }
    }

    // Masukkan ke database
    if ($bukti_transfer) {
        $stmt = $pdo->prepare("INSERT INTO pembayaran (pemesanan_id, metode, jumlah, status, bukti_transfer) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$pemesanan_id, $metode, $jumlah, $status, $bukti_transfer]);

        echo "<script>alert('Pembayaran berhasil dikirim! Menunggu konfirmasi.'); window.location.href='tiket_saya.php';</script>";
    }
}
?>

</body>
</html>