<?php
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM pemesan");
?>

<div class="container-fluid">
  <div class="card shadow-sm">
    <div class="card-header bg-gradient-primary text-white">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="m-0"><i class="fas fa-book-reader me-2"></i> Daftar Pemesan</h5>
        <a href="index.php?halaman=tambahpemesan" class="btn btn-light btn-sm">
          <i class="fas fa-plus"></i> Tambah Pemesan
        </a>
      </div>
    </div>

    <div class="card-body table-responsive">
      <table class="table table-bordered table-hover text-nowrap">
        <thead class="thead-dark">
          <tr class="text-center">
            <th style="width: 5%">NO</th>
            <th>Nama_pemesan</th>
            <th>desa_pemesan</th>
            <th>kec_pemesan</th>
            <th>hp_pemesan</th>
            <th>foto</th>
            <th style="width: 15%">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id_pemesan = 1;
          while ($data = mysqli_fetch_assoc($query)) {
            // Amankan agar tidak error jika kolom tidak ada
            $id_pemesan_db = isset($data['id_pemesan']) ? htmlspecialchars($data['id_pemesan']) : '-';
            $nama_pemesan  = isset($data['nama_pemesan']) ? htmlspecialchars($data['nama_pemesan']) : '-';
            $desa_pemesan  = isset($data['desa_pemesan']) ? htmlspecialchars($data['desa_pemesan']) : '-';
            $kec_pemesan   = isset($data['kec_pemesan']) ? htmlspecialchars($data['kec_pemesan']) : '-';
            $hp_pemesan    = isset($data['hp_pemesan']) ? htmlspecialchars($data['hp_pemesan']) : '-';
            $foto    = isset($data['foto']) ? htmlspecialchars($data['foto']) : '-';
          ?>
            <tr>
              <td class="text-center"><?= $id_pemesan++; ?></td>
              <td><?= $nama_pemesan; ?></td>
              <td><?= $desa_pemesan; ?></td>
              <td><?= $kec_pemesan; ?></td>
              <td><?= $hp_pemesan; ?></td>
              <td><?= $foto; ?></td>
              <td class="text-center">
                <a href="index.php?halaman=editpemesan&idpemesan=<?= $id_pemesan_db; ?>" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="hapus_pemesan.php?id=<?= $id_pemesan_db; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>