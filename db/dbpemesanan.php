<?php
// File: db/dbpemesanan.php
include '../koneksi.php';

$proses = $_GET['proses'] ?? '';

if ($proses == 'tambah') {
    // Ambil data dari form
    $id_pemesan = $_POST['id_pemesan'];
    $id_admin = 1; // bisa diganti dari session admin login
    $tanggal_pemesanan = date('Y-m-d');
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $total_pembayaran = $_POST['total_pembayaran'];
    $status_pembayaran = ($metode_pembayaran == 'tunai') ? 'lunas' : 'belum bayar';

    // Upload bukti pembayaran (jika ada)
    $bukti = '';
    if (!empty($_FILES['bukti_pembayaran']['name'])) {
        $namaFile = time() . '_' . $_FILES['bukti_pembayaran']['name'];
        $tmp = $_FILES['bukti_pembayaran']['tmp_name'];
        $folder = "../views/pemesanan/buktipembayaran/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        move_uploaded_file($tmp, $folder . $namaFile);
        $bukti = $namaFile;
    }

    // Simpan ke tabel pemesanan
    $q1 = mysqli_query($koneksi, "INSERT INTO pemesanan 
        (id_pemesan, id_admin, tanggal_pemesanan, total_pembayaran, status_pembayaran, metode_pembayaran, bukti_pembayaran)
        VALUES ('$id_pemesan', '$id_admin', '$tanggal_pemesanan', '$total_pembayaran', '$status_pembayaran', '$metode_pembayaran', '$bukti')
    ");

    // Ambil ID pemesanan yang baru dibuat
    $id_pemesanan = mysqli_insert_id($koneksi);

    // Simpan ke tabel detailpemesanan
    $id_gedung = $_POST['id_gedung'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $keperluan = $_POST['keperluan'];
    $harga = $_POST['harga'];
    $total_harga = $_POST['total_pembayaran'];

    $q2 = mysqli_query($koneksi, "INSERT INTO detailpemesanan 
        (id_pemesanan, id_gedung, tanggal_sewa, waktu_mulai, waktu_selesai, keperluan, harga, total_harga)
        VALUES ('$id_pemesanan', '$id_gedung', '$tanggal_sewa', '$waktu_mulai', '$waktu_selesai', '$keperluan', '$harga', '$total_harga')
    ");

    if ($q1 && $q2) {
        echo "<script>alert('Data pemesanan berhasil disimpan');window.location='../index.php?halaman=pemesanan';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data pemesanan');history.back();</script>";
    }

} elseif ($proses == 'edit') {
    $id_pemesanan = $_POST['id_pemesanan'];
    $id_gedung = $_POST['id_gedung'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $waktu_mulai = $_POST['waktu_mulai'];
    $waktu_selesai = $_POST['waktu_selesai'];
    $keperluan = $_POST['keperluan'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $total_pembayaran = $_POST['total_pembayaran'];
    $status_pembayaran = $_POST['status_pembayaran'];

    // Upload bukti baru jika diubah
    $bukti = $_POST['bukti_lama'];
    if (!empty($_FILES['bukti_pembayaran']['name'])) {
        $namaFile = time() . '_' . $_FILES['bukti_pembayaran']['name'];
        $tmp = $_FILES['bukti_pembayaran']['tmp_name'];
        $folder = "../views/pemesanan/buktipembayaran/";
        if (!is_dir($folder)) mkdir($folder, 0777, true);
        move_uploaded_file($tmp, $folder . $namaFile);
        $bukti = $namaFile;
    }

    // Update pemesanan
    $q1 = mysqli_query($koneksi, "UPDATE pemesanan SET 
        metode_pembayaran='$metode_pembayaran',
        total_pembayaran='$total_pembayaran',
        status_pembayaran='$status_pembayaran',
        bukti_pembayaran='$bukti'
        WHERE id_pemesanan='$id_pemesanan'
    ");

    // Update detail
    $q2 = mysqli_query($koneksi, "UPDATE detailpemesanan SET 
        id_gedung='$id_gedung',
        tanggal_sewa='$tanggal_sewa',
        waktu_mulai='$waktu_mulai',
        waktu_selesai='$waktu_selesai',
        keperluan='$keperluan',
        harga='$total_pembayaran',
        total_harga='$total_pembayaran'
        WHERE id_pemesanan='$id_pemesanan'
    ");

    if ($q1 && $q2) {
        echo "<script>alert('Data pemesanan berhasil diperbarui');window.location='../index.php?halaman=pemesanan';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');history.back();</script>";
    }

} elseif ($proses == 'hapus') {
    $id_pemesanan = $_GET['id'];

    // Hapus detail terlebih dahulu
    mysqli_query($koneksi, "DELETE FROM detailpemesanan WHERE id_pemesanan='$id_pemesanan'");
    // Hapus utama
    $hapus = mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_pemesanan='$id_pemesanan'");

    if ($hapus) {
        echo "<script>alert('Data pemesanan berhasil dihapus');window.location='../index.php?halaman=pemesanan';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');history.back();</script>";
    }

} else {
    echo "Aksi tidak dikenali.";
}
?>
