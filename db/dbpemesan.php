<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Perubahan path include sesuai dengan lokasi file ini (asumsi file ini berada di folder 'db')
include "../koneksi.php";

$proses = isset($_GET['proses']) ? $_GET['proses'] : '';

// --- PROSES TAMBAH DATA PEMESAN ---
if ($proses == 'tambah') {

    // Ambil data dari POST
    $id_pemesan = $_POST['id_pemesan'] ?? '';
    $nama_pemesan = $_POST['nama_pemesan'] ?? '';
    $desa_pemesan = $_POST['desa_pemesan'] ?? '';
    $kec_pemesan  = $_POST['kec_pemesan'] ?? '';
    $hp_pemesan   = $_POST['hp_pemesan'] ?? '';

    // Ambil data Foto
    $foto_name = $_FILES['foto']['name'] ?? '';
    $foto_tmp  = $_FILES['foto']['tmp_name'] ?? '';
    // Ganti ke folder foto pemesan Anda yang benar
    $folder    = "../assets/foto_pemesan/";

    // Proses upload foto
    if (!empty($foto_name)) {
        // Beri nama unik untuk foto
        $foto_name = time() . '_' . basename($foto_name);
        move_uploaded_file($foto_tmp, $folder . $foto_name);
    } else {
        $foto_name = "";
    }

    // Sanitize data sebelum query (Penting untuk Keamanan!)
    
    $nama_pemesan_clean = mysqli_real_escape_string($koneksi, $nama_pemesan);
    $desa_pemesan_clean = mysqli_real_escape_string($koneksi, $desa_pemesan);
    $kec_pemesan_clean  = mysqli_real_escape_string($koneksi, $kec_pemesan);
    $hp_pemesan_clean   = mysqli_real_escape_string($koneksi, $hp_pemesan);
    $foto_name_clean    = mysqli_real_escape_string($koneksi, $foto_name);

    // Simpan ke database
    $query = "INSERT INTO pemesan (nama_pemesan, desa_pemesan, kec_pemesan, hp_pemesan, foto)
              VALUES ('$nama_pemesan_clean', '$desa_pemesan_clean', '$kec_pemesan_clean', '$hp_pemesan_clean', '$foto_name_clean')";
    
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    // Redirect setelah berhasil
    echo "<script>
            alert('Data pemesan berhasil ditambahkan!');
            window.location='../index.php?halaman=pemesan';
          </script>";
    exit;

// --- PROSES EDIT DATA PEMESAN ---
} elseif ($proses == 'edit') {

    if (!isset($_POST['id_pemesan'])) {
        die("Error: id_pemesan tidak ditemukan di form edit!");
    }

    // Ambil data dari POST
    $id_pemesan   = $_POST['id_pemesan'];
    $nama_pemesan = $_POST['nama_pemesan'];
    $desa_pemesan = $_POST['desa_pemesan'];
    $kec_pemesan  = $_POST['kec_pemesan'];
    $hp_pemesan   = $_POST['hp_pemesan'];

    $foto_name = $_FILES['foto']['name'] ?? '';
    $foto_tmp  = $_FILES['foto']['tmp_name'] ?? '';
    // Ganti ke folder foto pemesan Anda yang benar
    $folder    = "../assets/foto_pemesan/";

    // Ambil data lama (untuk hapus foto lama)
    $old_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM pemesan WHERE id_pemesan='$id_pemesan'"));

    // Jika upload foto baru
    if (!empty($foto_name)) {
        // Beri nama unik untuk foto
        $foto_name = time() . '_' . basename($foto_name);
        move_uploaded_file($foto_tmp, $folder . $foto_name);

        // Hapus foto lama jika ada
        if (!empty($old_data['foto']) && file_exists($folder . $old_data['foto'])) {
            unlink($folder . $old_data['foto']);
        }

        $foto_query = ", foto='".mysqli_real_escape_string($koneksi, $foto_name)."'";
    } else {
        $foto_query = "";
    }

    // Sanitize data teks sebelum query
    $nama_pemesan_clean = mysqli_real_escape_string($koneksi, $nama_pemesan);
    $desa_pemesan_clean = mysqli_real_escape_string($koneksi, $desa_pemesan);
    $kec_pemesan_clean  = mysqli_real_escape_string($koneksi, $kec_pemesan);
    $hp_pemesan_clean   = mysqli_real_escape_string($koneksi, $hp_pemesan);
    $id_pemesan_clean   = mysqli_real_escape_string($koneksi, $id_pemesan);

    // Update data
    $query = "UPDATE pemesan SET 
                nama_pemesan='$nama_pemesan_clean',
                desa_pemesan='$desa_pemesan_clean',
                kec_pemesan='$kec_pemesan_clean',
                hp_pemesan='$hp_pemesan_clean'
                $foto_query
              WHERE id_pemesan='$id_pemesan_clean'";
               
    // Redirect setelah berhasil
    echo "<script>
            alert('Data pemesan berhasil diupdate!');
            window.location='../index.php?halaman=pemesan';
          </script>";
    exit;

// --- PROSES HAPUS DATA PEMESAN ---
if ($proses == 'hapus') {

    // Pastikan parameter id ada
    if (!isset($_GET['idpemesan']) && !isset($_GET['id_pemesan'])) {
        die("Error: id pemesan tidak ditemukan!");
    }

    // Ambil dan sanitasi id
    $id_pemesan = isset($_GET['idpemesan']) ? $_GET['idpemesan'] : $_GET['id_pemesan'];
    $id_pemesan = mysqli_real_escape_string($koneksi, $id_pemesan);

    // Path folder foto
    $folder = "../assets/foto_pemesan/";

    // Hapus data reservasi terkait (jika ada relasi)
    mysqli_query(
        $koneksi,
        "DELETE FROM reservasi WHERE id_pemesan='$id_pemesan'"
    ) or die("Error hapus reservasi: " . mysqli_error($koneksi));

    // Ambil nama file foto lama
    $get_foto = mysqli_fetch_assoc(
        mysqli_query($koneksi, "SELECT foto FROM pemesan WHERE id_pemesan='$id_pemesan'")
    );

    // Hapus file foto jika ada
    if (!empty($get_foto['foto'])) {
        $path = $folder . $get_foto['foto'];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    // Hapus data pemesan
    mysqli_query(
        $koneksi,
        "DELETE FROM pemesan WHERE id_pemesan='$id_pemesan'"
    ) or die("Error hapus pemesan: " . mysqli_error($koneksi));

    // Redirect dengan pesan sukses
    echo "<script>
        alert('Data pemesan dan data reservasi terkait berhasil dihapus!');
        window.location.href = '../index.php?halaman=pemesan';
    </script>";
    exit;
}

} else {
    // Proses tidak dikenali
    die("Error: proses tidak dikenali!");
}
?>