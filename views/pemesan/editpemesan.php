<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Pastikan koneksi ke database sudah benar
include "../koneksi.php";

// Ambil ID pemesan dari URL (mendukung 'idpemesan' atau 'id_pemesan')
$idpemesan = $_GET['idpemesan'] ?? $_GET['id_pemesan'] ?? '';

if ($idpemesan == '') {
    die("<div class='alert alert-danger'>Error: id_pemesan tidak ditemukan di form edit!</div>");
}

// Ambil data pemesan dari database
$query = mysqli_query($koneksi, "SELECT * FROM pemesan WHERE id_pemesan='$idpemesan'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("<div class='alert alert-danger'>Data pemesan tidak ditemukan!</div>");
}
?>

<!-- Main content -->
<section class="content">
  <div class="card">
    <div class="card-header bg-gradient-primary mb-3">
      <h5 style="font-family:Arial, Helvetica, sans-serif;">Edit Data Pemesan</h5>
    </div>

    <div class="card-body">
      <form action="db/dbpemesan.php?proses=edit" method="POST">
        <!-- ID tersembunyi -->
        <input type="hidden" name="idpemesan" value="<?= htmlspecialchars($data['id_pemesan']) ?>">

        <div class="form-group">
          <label for="namapemesan">Nama Pemesan</label>
          <input type="text" class="form-control" id="namapemesan" name="namapemesan"
                 value="<?= htmlspecialchars($data['nama_pemesan']) ?>"
                 placeholder="Masukkan nama pemesan" required>
        </div>

        <div class="form-group">
          <label for="desa_pemesan">Desa Pemesan</label>
          <input type="text" class="form-control" id="desa_pemesan" name="desa_pemesan"
                 value="<?= htmlspecialchars($data['desa_pemesan']) ?>"
                 placeholder="Masukkan desa pemesan" required>
        </div>

        <div class="form-group">
          <label for="kec_pemesan">Kecamatan Pemesan</label>
          <input type="text" class="form-control" id="kec_pemesan" name="kec_pemesan"
                 value="<?= htmlspecialchars($data['kec_pemesan']) ?>"
                 placeholder="Masukkan kecamatan pemesan" required>
        </div>

        <div class="form-group">
          <label for="hp_pemesan">HP Pemesan</label>
          <input type="text" class="form-control" id="hp_pemesan" name="hp_pemesan"
                 value="<?= htmlspecialchars($data['hp_pemesan']) ?>"
                 placeholder="Masukkan nomor HP pemesan" required>
        </div>

        <div class="card-footer text-right mt-2">
          <a href="index.php?halaman=pemesan" class="btn btn-secondary btn-sm">
            <i class="fa fa-arrow-left"></i> Kembali
          </a>
          <button type="submit" class="btn btn-primary btn-sm">
            <i class="fa fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>

    <div class="card-footer">
      <small>Edit Data Pemesan - Aplikasi Pemesanan Gedung</small>
    </div>
  </div>
</section>
