<?php
// editkategori.php

if (!isset($_GET['idkategori'])) {
    echo "<script>alert('ID kategori tidak ditemukan!'); window.location='index.php?halaman=kategori';</script>";
    exit;
}

include "koneksi.php"; // koneksi database

$idkategori = $_GET['idkategori'];

// Ambil data kategori dari database
$sql = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$idkategori'");
$data = mysqli_fetch_array($sql);

if (!$data) {
    echo "<script>alert('Data kategori tidak ditemukan!'); window.location='index.php?halaman=kategori';</script>";
    exit;
}
?>

<!-- Main content -->
<section class="content">

  <div class="card">
    <div class="card-header bg-gradient-primary mb-3">
      <h5 style="font-family:Arial, Helvetica, sans-serif;">Edit Kategori</h5>
    </div>

    <div class="card-body">
      <!-- FORM EDIT KATEGORI -->
      <div class="card card-warning mb-4 text-xs">
        <div class="card-header bg-gradient-warning">
          <h6 class="card-title text-white"><i class="fas fa-edit"></i> Edit Kategori</h6>
        </div>
        <div class="card-body">
          <form action="db/dbkategori.php?proses=edit" method="POST">
            <input type="hidden" name="idkategori" value="<?= $data['id_kategori'] ?>">
            <div class="form-group">
              <label for="namakategori">Nama Kategori</label>
              <input type="text" class="form-control" id="namakategori" name="namakategori" value="<?= htmlspecialchars($data['nama_kategori']) ?>" placeholder="Masukkan nama kategori" required>
            </div>
            <div class="card-footer text-right mt-2">
              <a href="index.php?halaman=kategori" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Update</button>
            </div>
          </form>
        </div>
      </div>
      <!-- END FORM EDIT -->
    </div>

    <div class="card-footer">
      <small>Edit Data Kategori - Aplikasi Pemesanan gedung</small>
    </div>
  </div>
</section>
<!-- /.content -->
