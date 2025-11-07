<?php
session_start();
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Akses tidak diperbolehkan.");
}

// Ambil data dari form
$id_pemesanan = $_POST['id_pemesanan'] ?? '';
$jumlah_bayar = floatval($_POST['jumlah_bayar'] ?? 0);
$metode_bayar = $_POST['metode_bayar'] ?? '';
$foto_bukti = $_FILES['bukti_pembayaran'] ?? null;

// Validasi minimal
if (empty($id_pemesanan) || $jumlah_bayar <= 0 || empty($metode_bayar)) {
    die("Error: Data pembayaran tidak lengkap.");
}

// Ambil total_pembayaran dari tabel pemesanan
$q = mysqli_query($koneksi, "SELECT total_pembayaran FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");
if (!$q || mysqli_num_rows($q) == 0) {
    die("Error: Data pemesanan tidak ditemukan.");
}
$data = mysqli_fetch_assoc($q);
$total_pembayaran = $data['total_pembayaran'];

// Upload bukti pembayaran (opsional)
$nama_file_bukti = null;
if ($foto_bukti && isset($foto_bukti['error']) && $foto_bukti['error'] === 0) {
    $ext = pathinfo($foto_bukti['name'], PATHINFO_EXTENSION);
    $nama_file_bukti = 'buktipembayaran_' . $id_pemesanan . '_' . time() . '.' . $ext;
    $target = "../views/pemesanan/buktipembayaran/" . $nama_file_bukti;
    move_uploaded_file($foto_bukti['tmp_name'], $target);
}

// Hitung status
$status = ($jumlah_bayar >= $total_pembayaran) ? 'lunas' : 'belum bayar';

// Update tabel pemesanan
$stmt = $koneksi->prepare("
    UPDATE pemesanan 
    SET status_pembayaran = ?, 
        metode_pembayaran = ?, 
        bukti_pembayaran = ?
    WHERE id_pemesanan = ?
");
$stmt->bind_param("sssi", $status, $metode_bayar, $nama_file_bukti, $id_pemesanan);
$stmt->execute();
$stmt->close();

// Redirect
header("Location: ../index.php?halaman=daftarpembayaran&status=sukses");
exit;
?>
