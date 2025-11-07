<section class="content">
  <div class="card shadow-sm">
    <div class="card-header bg-primary">
      <h3 class="card-title text-white m-0">Tambah pemesan</h3>
    </div>

    <form action="db/dbpemesan.php?proses=tambah" method="POST" enctype="multipart/form-data">
      <div class="card-body">

        <div class="form-group mb-3">
          <label for="nama_pemesan" class="fw-bold">Nama pemesan</label>
          <input type="text" class="form-control" id="nama_pemesan" name="nama_pemesan"
            placeholder="Masukkan nama_pemesan" required>
        </div>

        <div class="form-group mb-3">
          <label for="desa_pemesan" class="fw-bold">desa_pemesan</label>
          <input type="text" class="form-control" id="desa_pemesan" name="desa_pemesan"
            placeholder="Masukkan desa_pemesan" required>
        </div>

        <div class="form-group mb-3">
          <label for="kec_pemesan" class="fw-bold">kec_pemesan</label>
          <input type="text" class="form-control" id="kec_pemesan" name="kec_pemesan"
            placeholder="Masukkan kec_pemesan" required>
        </div>

        <div class="form-group mb-3">
          <label for="hp_pemesan" class="fw-bold"> hp_pemesan</label>
          <input type="text" class="form-control" id="hp_pemesan" name="hp_pemesan"
            placeholder="Masukkan hp_pemesan" required>
        </div>

        <div class="form-group mb-4">
          <label for="foto" class="fw-bold"> foto </label>
          <input type="file" class="form-control mt-2" id="foto" name="foto" accept="image/*">
        </div>

      </div>

      <div class="card-footer text-right">
        <button type="reset" class="btn btn-warning mr-2">
          <i class="fa fa-retweet"></i> Reset
        </button>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-save"></i> Simpan pemesan
        </button>
      </div>
    </form>
  </div>
</section>
