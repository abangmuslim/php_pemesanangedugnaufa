
<section class="content">
  <div class="card shadow-sm border-0">
    
    <!-- Header Card -->
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h3 class="card-title m-0">
        <i class="fas fa-user-shield me-2"></i> Tambah Admin Baru
      </h3>
      <a href="index.php?halaman=admin" class="btn btn-light btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>

    <!-- Form Tambah Admin -->
    <form action="db/dbadmin.php?proses=tambah" method="POST" enctype="multipart/form-data">
      <div class="card-body">

        <div class="form-group mb-3">
          <label class="fw-bold">Nama Admin</label>
          <input type="text" class="form-control" name="nama_admin"
                 placeholder="Masukkan nama_admin" required>
        </div>

        <div class="form-group mb-3">
          <label class="fw-bold">Username</label>
          <input type="text" class="form-control" name="username"
                 placeholder="Masukkan username" required>
        </div>

        <div class="form-group mb-3">
          <label class="fw-bold">Password</label>
          <input type="password" class="form-control" name="password"
                 placeholder="Masukkan password" required>
        </div>

        <div class="form-group mb-3">
          <label class="fw-bold">hp_admin</label>
          <input type="text" class="form-control" name="nohp"
                 placeholder="Masukkan hp_admin" required>
        </div>

        <div class="form-group mb-4">
          <label class="fw-bold">Foto Admin</label>
          <input type="file" class="form-control" name="fotoadmin" accept="image/*">
        </div>

      </div>

      <!-- Footer Card -->
      <div class="card-footer text-end">
        <button type="reset" class="btn btn-warning me-2">
          <i class="fas fa-retweet"></i> Reset
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> Simpan Admin
        </button>
      </div>
    </form>
  </div>
</section>
