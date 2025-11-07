<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header bg-gradient-primary mb-3">
      <div class="row">
        <div class="col tekstebal">
          <strong>
            <h5 style="font-family:Arial, Helvetica, sans-serif;">Halaman Data Kategori</h5>
          </strong>
        </div>
      </div>
    </div>

    <div class="card-body">

      <!-- FORM TAMBAH KATEGORI -->
      <div class="card card-warning mb-4 text-xs">
        <div class="card-header bg-gradient-warning">
          <h6 class="card-title text-white"><i class="fas fa-plus-circle"></i> Tambah Kategori</h6>
        </div>
        <div class="card-body">
          <form action="db/dbkategori.php?proses=tambah" method="POST">
            <div class="form-group">
              <label for="namakategori">Nama Kategori</label>
              <input type="text" class="form-control" id="namakategori" name="namakategori" placeholder="Masukkan nama kategori" required>
            </div>

            <div class="card-footer text-right mt-2">
              <button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-retweet"></i> Reset</button>
              <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- END FORM TAMBAH -->

      <!-- TABEL DATA KATEGORI -->
      <div class="card-header bg-gradient-warning mb-2">
        <h6 class="card-title text-white"><i class="fas fa-list"></i> Daftar Kategori</h6>
      </div>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped text-sm">
          <thead class="bg-light">
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "koneksi.php"; // hanya untuk menampilkan data

            $no = 1;
            $sql = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori");
            while ($data = mysqli_fetch_array($sql)) {
              echo "
              <tr>
                <td>$no</td>
                <td>$data[nama_kategori]</td>
                <td>
                  <a href='index.php?halaman=editkategori&idkategori=$data[id_kategori]' class='btn btn-sm btn-success' title='Edit'><i class='fa fa-pencil-alt'></i></a>
                  <a href='db/dbkategori.php?proses=hapus&idkategori=$data[id_kategori]' class='btn btn-sm btn-danger' title='Hapus' onclick=\"return confirm('Yakin ingin menghapus data ini?')\"><i class='fa fa-trash'></i></a>
                </td>
              </tr>
              ";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- END TABEL -->

    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <small>Data Kategori - Aplikasi Pemesanan gedung</small>
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->
