<?php
require_once 'auth.php';
require_role('admin');
require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pemesanan_id'])) {
    $id = $_POST['pemesanan_id'];
    $stmt = $pdo->prepare("UPDATE pemesanan SET status = 'berhasil' WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: kelola_penumpang.php');
    exit;
}
?>