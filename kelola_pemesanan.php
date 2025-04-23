<?php
include "koneksi.php";  // Menghubungkan ke database

// Ambil data pesanan tiket dari database
$query = "SELECT * FROM pemesanan";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan Tiket Kereta</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Daftar Pemesanan Tiket Kereta</h1>
        
        <!-- Tabel Daftar Pemesanan -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>ID Kereta</th>
                    <th>Tanggal Berangkat</th>
                    <th>Jumlah Tiket</th>
                    <th>Tujuan</th>
                    <th>Status Pembayaran</th>
                    <th>Waktu Pemesanan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data pesanan satu per satu
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama_pemesan'] . "</td>";
                    echo "<td>" . $row['id_kereta'] . "</td>";
                    echo "<td>" . $row['tanggal_berangkat'] . "</td>";
                    echo "<td>" . $row['jumlah_tiket'] . "</td>";
                    echo "<td>" . $row['tujuan'] . "</td>";
                    echo "<td>" . $row['status_bayar'] . "</td>";
                    echo "<td>" . $row['waktu_pemesanan'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Menutup koneksi
mysqli_close($conn);
?>
