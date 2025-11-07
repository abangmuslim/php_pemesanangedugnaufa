<?php
include '../koneksi.php';

$proses = $_GET['proses'] ?? '';

/**
 * Helper: bersihkan angka format rupiah (1.500.000 -> 1500000)
 */
function cleanNumber($str) {
    if ($str === null) return 0;
    return floatval(str_replace(['.', ','], ['', '.'], $str));
}

if ($proses == 'tambah') {
    // ambil data utama
    $id_pemesan = $_POST['id_pemesan'] ?? '';
    $id_admin = $_POST['id_admin'] ?? '';
    $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
    $status_pembayaran = $_POST['status_pembayaran'] ?? '';
    $total_pembayaran = cleanNumber($_POST['total_pembayaran'] ?? 0);

    if (!$id_pemesan || !$id_admin) {
        echo "<script>alert('Lengkapi semua data terlebih dahulu.');history.back();</script>";
        exit;
    }

    // simpan pemesanan utama
    $sql = "INSERT INTO pemesanan (id_pemesan, id_admin, metode_pembayaran, status_pembayaran, total_pembayaran)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iissd", $id_pemesan, $id_admin, $metode_pembayaran, $status_pembayaran, $total_pembayaran);
    $stmt->execute();
    $id_pemesanan = $stmt->insert_id;
    $stmt->close();

    // ambil array detail
    $id_gedung_list = $_POST['id_gedung'] ?? [];
    $tanggal_sewa_list = $_POST['tanggal_sewa'] ?? [];
    $mulai_list = $_POST['waktu_mulai'] ?? [];
    $selesai_list = $_POST['waktu_selesai'] ?? [];
    $harga_list = $_POST['harga'] ?? [];
    $keperluan_list = $_POST['keperluan'] ?? [];

    foreach ($id_gedung_list as $i => $id_gedung) {
        $id_gedung = intval($id_gedung);
        $harga = cleanNumber($harga_list[$i] ?? 0);
        $tgl = mysqli_real_escape_string($koneksi, $tanggal_sewa_list[$i] ?? '');
        $mulai = mysqli_real_escape_string($koneksi, $mulai_list[$i] ?? '');
        $selesai = mysqli_real_escape_string($koneksi, $selesai_list[$i] ?? '');
        $keperluan = mysqli_real_escape_string($koneksi, $keperluan_list[$i] ?? '');

        $q = "INSERT INTO detailpemesanan
              (id_pemesanan, id_gedung, tanggal_sewa, waktu_mulai, waktu_selesai, keperluan, harga, total_harga)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($q);
        $stmt->bind_param("iisssddd", $id_pemesanan, $id_gedung, $tgl, $mulai, $selesai, $keperluan, $harga, $harga);
        $stmt->execute();
        $stmt->close();
    }

    echo "<script>alert('Data pemesanan berhasil disimpan!');window.location='../index.php?halaman=daftarpemesanan';</script>";
    exit;
}

elseif ($proses == 'edit') {
    $id_pemesanan = $_POST['id_pemesanan'] ?? '';
    $id_pemesan = $_POST['id_pemesan'] ?? '';
    $id_admin = $_POST['id_admin'] ?? '';
    $metode_pembayaran = $_POST['metode_pembayaran'] ?? '';
    $status_pembayaran = $_POST['status_pembayaran'] ?? '';
    $total_pembayaran = cleanNumber($_POST['total_pembayaran'] ?? 0);

    if (!$id_pemesanan || !$id_pemesan || !$id_admin) {
        echo "<script>alert('Lengkapi semua data terlebih dahulu.');history.back();</script>";
        exit;
    }

    // update pemesanan utama
    $sql = "UPDATE pemesanan SET id_pemesan=?, id_admin=?, metode_pembayaran=?, status_pembayaran=?, total_pembayaran=? WHERE id_pemesanan=?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("iissdi", $id_pemesan, $id_admin, $metode_pembayaran, $status_pembayaran, $total_pembayaran, $id_pemesanan);
    $stmt->execute();
    $stmt->close();

    // hapus detail lama
    $koneksi->query("DELETE FROM detailpemesanan WHERE id_pemesanan = '$id_pemesanan'");

    // insert ulang detail
    $id_gedung_list = $_POST['id_gedung'] ?? [];
    $tanggal_sewa_list = $_POST['tanggal_sewa'] ?? [];
    $mulai_list = $_POST['waktu_mulai'] ?? [];
    $selesai_list = $_POST['waktu_selesai'] ?? [];
    $harga_list = $_POST['harga'] ?? [];
    $keperluan_list = $_POST['keperluan'] ?? [];

    foreach ($id_gedung_list as $i => $id_gedung) {
        $id_gedung = intval($id_gedung);
        $harga = cleanNumber($harga_list[$i] ?? 0);
        $tgl = mysqli_real_escape_string($koneksi, $tanggal_sewa_list[$i] ?? '');
        $mulai = mysqli_real_escape_string($koneksi, $mulai_list[$i] ?? '');
        $selesai = mysqli_real_escape_string($koneksi, $selesai_list[$i] ?? '');
        $keperluan = mysqli_real_escape_string($koneksi, $keperluan_list[$i] ?? '');

        $q = "INSERT INTO detailpemesanan
              (id_pemesanan, id_gedung, tanggal_sewa, waktu_mulai, waktu_selesai, keperluan, harga, total_harga)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($q);
        $stmt->bind_param("iisssddd", $id_pemesanan, $id_gedung, $tgl, $mulai, $selesai, $keperluan, $harga, $harga);
        $stmt->execute();
        $stmt->close();
    }

    echo "<script>alert('Data pemesanan berhasil diperbarui!');window.location='../index.php?halaman=daftarpemesanan';</script>";
    exit;
}

elseif ($proses == 'hapus') {
    $id_pemesanan = intval($_GET['id'] ?? 0);
    if ($id_pemesanan <= 0) {
        echo "<script>alert('ID pemesanan tidak valid');history.back();</script>";
        exit;
    }

    $koneksi->query("DELETE FROM detailpemesanan WHERE id_pemesanan = '$id_pemesanan'");
    $hapus = $koneksi->query("DELETE FROM pemesanan WHERE id_pemesanan = '$id_pemesanan'");

    if ($hapus) {
        echo "<script>alert('Data pemesanan berhasil dihapus');window.location='../index.php?halaman=daftarpemesanan';</script>";
    } else {
        $err = mysqli_error($koneksi);
        echo "<script>alert('Gagal menghapus data pemesanan!\\nMySQL error: " . addslashes($err) . "');history.back();</script>";
    }
    exit;
}

else {
    echo "Aksi tidak dikenali.";
}
?>
