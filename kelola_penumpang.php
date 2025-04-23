<?php
require_once '../auth.php';
require_role('admin');
require_once '../koneksi.php';

$filter_query = "";
$params = [];

if (!empty($_GET['tanggal'])) {
    $filter_query .= " AND j.tanggal = ?";
    $params[] = $_GET['tanggal'];
}

if (!empty($_GET['kereta'])) {
    $filter_query .= " AND k.nama_kereta LIKE ?";
    $params[] = "%" . $_GET['kereta'] . "%";
}

$query = "
SELECT p.*, u.name AS nama_user, u.email, j.tanggal, j.jam_berangkat, j.jam_tiba, k.nama_kereta
FROM pemesanan p
JOIN users u ON p.user_id = u.id
JOIN jadwal j ON p.jadwal_id = j.id
JOIN kereta k ON j.id_kereta = k.id
WHERE 1=1 $filter_query
ORDER BY p.created_at DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$pemesanan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Penumpang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .title { font-weight: bold; font-size: 2rem; margin-bottom: 20px; }
    .badge-success { background-color: #28a745; }
    .badge-pending { background-color: #ffc107; color: #212529; }
    .badge-cancelled { background-color: #dc3545; }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="title">Daftar Penumpang</h1>
    <a href="dashboard.php" class="btn btn-outline-secondary">← Dashboard</a>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <form method="get" class="row g-3">
        <div class="col-md-4">
          <label for="tanggal" class="form-label">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $_GET['tanggal'] ?? '' ?>">
        </div>
        <div class="col-md-4">
          <label for="kereta" class="form-label">Nama Kereta</label>
          <input type="text" name="kereta" id="kereta" class="form-control" placeholder="Contoh: Argo Bromo" value="<?= $_GET['kereta'] ?? '' ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary me-2">Terapkan Filter</button>
          <a href="lihat_pengguna.php" class="btn btn-secondary me-2">Reset</a>
          <a href="cetak_pdf.php?<?= http_build_query($_GET) ?>" target="_blank" class="btn btn-success">Cetak PDF</a>
        </div>
      </form>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Penumpang</th>
          <th>Email</th>
          <th>Kereta</th>
          <th>Tanggal</th>
          <th>Jam Berangkat</th>
          <th>Jumlah Tiket</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($pemesanan) > 0): ?>
          <?php foreach ($pemesanan as $i => $p): ?>
            <tr>
              <td><?= $i+1 ?></td>
              <td><?= htmlspecialchars($p['nama_user']) ?></td>
              <td><?= htmlspecialchars($p['email']) ?></td>
              <td><?= htmlspecialchars($p['nama_kereta']) ?></td>
              <td><?= $p['tanggal'] ?></td>
              <td><?= $p['jam_berangkat'] ?></td>
              <td><?= $p['jumlah_tiket'] ?></td>
              <td>
  <?php if (strtolower($p['status']) === 'berhasil'): ?>
    <span class="badge bg-success">Terverifikasi</span>
  <?php else: ?>
    <form action="verifikasi_pemesanan.php" method="post" onsubmit="return confirm('Yakin ingin memverifikasi pemesanan ini?');">
      <input type="hidden" name="pemesanan_id" value="<?= $p['id'] ?>">
      <button type="submit" class="btn btn-sm btn-warning">Verifikasi</button>
    </form>
  <?php endif; ?>
</td>

            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Data tidak ditemukan</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>