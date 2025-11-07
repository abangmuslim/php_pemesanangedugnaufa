<?php
$proses = isset($_GET['proses']) ? $_GET['proses'] : '';
include "../koneksi.php"; // pastikan path koneksi benar

// TAMBAH
if ($proses == 'tambah') {
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['namakategori']);
    $deskripsi     = isset($_POST['deskripsi']) ? mysqli_real_escape_string($koneksi, $_POST['deskripsi']) : '';

    mysqli_query($koneksi, "INSERT INTO kategori SET nama_kategori='$nama_kategori'");
    header("location:../index.php?halaman=kategori");

// EDIT
} elseif ($proses == 'edit') {
    $id_kategori   = $_POST['idkategori'];
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['namakategori']);

    mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'");
    header("location:../index.php?halaman=kategori");

// HAPUS
} elseif ($proses == 'hapus') {
    $id_kategori = $_GET['idkategori'];
    mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id_kategori'");
    header("location:../index.php?halaman=kategori");
}
?>
