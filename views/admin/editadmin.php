<?php
// Pastikan koneksi sudah disertakan
include "../../koneksi.php";

// Ambil ID admin dari URL
$id_admin = isset($_GET['id_admin']) ? $_GET['id_admin'] : '';

if ($id_admin == '') {
    die("<div class='alert alert-danger'>ID admin tidak ditemukan!</div>");
}

// Ambil data admin dari database
$query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_admin'");
$admin = mysqli_fetch_assoc($query);

if (!$admin) {
    die("<div class='alert alert-danger'>Data admin tidak ditemukan di database!</div>");
}

// Tentukan foto default
$fotoAdmin = !empty($admin['foto']) ? "../../uploads/admin/" . $admin['foto'] : "../../assets/img/default.png";
?>

<!-- ===========================================================
     HALAMAN EDIT ADMIN
=========================================================== -->
<section class="content">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-gradient-primary text-white">
      <div class="row align-items-center">
        <div class="col">
          <h5 class="m-0"><i class="fas fa-user-edit me-2"></i> Edit Admin</h5>
        </div>
        <div class="col text-end">
          <a href="admin.php" class="btn btn-light btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
          </a>
        </div>
      </div>
    </div>

    <div class="card-body">
      <form action="../../db/dbadmin.php?proses=edit" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_admin" value="<?= htmlspecialchars($admin['id_admin']); ?>">

        <div class="form-group mb-3">
          <label for="nama_admin">Nama Admin</label>
          <input type="text" class="form-control" id="nama_admin" name="nama_admin"
                 value="<?= htmlspecialchars($admin['nama_admin']); ?>" required>
        </div>

        <div class="form-group mb-3">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username"
                 value="<?= htmlspecialchars($admin['username']); ?>" required>
        </div>

        <div class="form-group mb-3">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password"
                 placeholder="Kosongkan jika tidak ingin mengubah password">
        </div>

        <div class="form-group mb-3">
          <label for="hp_admin">Nomor HP</label>
          <input type="text" class="form-control" id="hp_admin" name="hp_admin"
                 value="<?= htmlspecialchars($admin['hp_admin']); ?>" required>
        </div>

        <div class="form-group mb-3">
          <label for="foto">Foto Admin</label>
          <div class="mb-2">
            <img src="<?= $fotoAdmin; ?>" alt="Foto Admin" 
                 class="img-thumbnail border"
                 style="width:120px; height:120px; object-fit:cover;">
          </div>
          <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
          <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>

        <div class="text-end">
          <button type="reset" class="btn btn-warning btn-sm">
            <i class="fa fa-retweet"></i> Reset
          </button>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save"></i> Simpan Perubahan
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
