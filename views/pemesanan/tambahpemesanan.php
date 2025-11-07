<!-- ====== HEADER HALAMAN ====== -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Form Tambah Pemesanan Gedung</h1>
      </div>
    </div>
  </div>
</section>

<!-- ====== FORM TAMBAH PEMESANAN ====== -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Tambah Pemesanan Baru</h3>
      </div>

      <form action="db/dbpemesanan.php?proses=tambah" method="POST" id="formPemesanan">
        <div class="card-body">

          <!-- === PILIH PEMESAN === -->
          <div class="form-group">
            <label><strong>Nama Pemesan</strong></label>
            <table class="table table-bordered table-striped text-sm">
              <thead class="bg-light">
                <tr>
                  <th>Nama</th>
                  <th>Asal</th>
                  <th>No. HP</th>
                  <th class="text-center">Pilih</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $pemesan = mysqli_query($koneksi, "
                  SELECT p.id_pemesan, p.nama_pemesan, a.nama_asal, p.hp_pemesan
                  FROM pemesan p
                  LEFT JOIN asal a ON p.id_asal = a.id_asal
                  ORDER BY p.nama_pemesan ASC
                ");
                while ($row = mysqli_fetch_assoc($pemesan)) :
                ?>
                  <tr>
                    <td><?= htmlspecialchars($row['nama_pemesan'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['nama_asal'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($row['hp_pemesan'] ?? '-') ?></td>
                    <td class="text-center">
                      <input type="radio" name="id_pemesan" value="<?= $row['id_pemesan'] ?>" required>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>

          <hr>

          <!-- === PILIH ADMIN PENANGGUNG JAWAB === -->
          <div class="form-group">
            <label><strong>Admin Penanggung Jawab</strong></label>
            <select name="id_admin" class="form-control" required>
              <option value="">-- Pilih Admin --</option>
              <?php
              $admin = mysqli_query($koneksi, "SELECT id_admin, nama_admin FROM admin ORDER BY nama_admin ASC");
              while ($a = mysqli_fetch_assoc($admin)) :
              ?>
                <option value="<?= $a['id_admin'] ?>"><?= htmlspecialchars($a['nama_admin'] ?? '') ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <hr>

          <!-- === INFORMASI TANGGAL PEMESANAN === -->
          <div class="row">
            <div class="col-md-4">
              <label><strong>Tanggal Pemesanan</strong></label>
              <input type="date" name="tanggal_pemesanan" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
            </div>
            <div class="col-md-4">
              <label><strong>Metode Pembayaran</strong></label>
              <select name="metode_pembayaran" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="tunai">Tunai</option>
                <option value="transfer">Transfer</option>
              </select>
            </div>
            <div class="col-md-4">
              <label><strong>Status Pembayaran</strong></label>
              <select name="status_pembayaran" class="form-control" required>
                <option value="belum bayar">Belum Bayar</option>
                <option value="lunas">Lunas</option>
              </select>
            </div>
          </div>

          <hr>

          <!-- === DETAIL PEMESANAN GEDUNG === -->
          <div class="form-group">
            <label><strong>Detail Pemesanan Gedung</strong></label>
            <div id="daftarGedung">
              <div class="row gedung-item mb-3 align-items-end">
                <div class="col-md-3">
                  <label>Gedung</label>
                  <select name="id_gedung[]" class="form-control selectGedung" required>
                    <option value="">-- Pilih Gedung --</option>
                    <?php
                    $gedung = mysqli_query($koneksi, "SELECT id_gedung, nama_gedung, harga FROM gedung ORDER BY nama_gedung ASC");
                    while ($g = mysqli_fetch_assoc($gedung)) :
                      $nama = htmlspecialchars($g['nama_gedung'] ?? '');
                    ?>
                      <option value="<?= $g['id_gedung'] ?>" data-harga="<?= $g['harga'] ?>">
                        <?= $nama ?> - Rp <?= number_format($g['harga'], 0, ',', '.') ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>
                <div class="col-md-2">
                  <label>Harga</label>
                  <input type="text" class="form-control hargaGedung" name="harga[]" readonly>
                </div>
                <div class="col-md-2">
                  <label>Tanggal Sewa</label>
                  <input type="date" name="tanggal_sewa[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                  <label>Mulai</label>
                  <input type="time" name="waktu_mulai[]" class="form-control" required>
                </div>
                <div class="col-md-2">
                  <label>Selesai</label>
                  <input type="time" name="waktu_selesai[]" class="form-control" required>
                </div>
                <div class="col-md-1 text-center">
                  <button type="button" class="btn btn-danger btnHapusGedung"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            </div>
            <button type="button" id="btnTambahGedung" class="btn btn-sm btn-primary mt-2">
              <i class="fas fa-plus"></i> Tambah Gedung
            </button>
          </div>

          <hr>

          <!-- === TOTAL PEMBAYARAN === -->
          <div class="form-group text-right">
            <h4><strong>Total Pembayaran:</strong> <span id="totalHarga">Rp 0</span></h4>
            <input type="hidden" name="total_pembayaran" id="inputTotal">
          </div>
        </div>

        <!-- === FOOTER FORM === -->
        <div class="card-footer text-right">
          <button type="reset" class="btn btn-warning">Reset</button>
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="index.php?halaman=pemesanan" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- ====== SCRIPT TAMBAH / HAPUS GEDUNG + HITUNG TOTAL ====== -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const daftar = document.getElementById('daftarGedung');
  const template = daftar.querySelector('.gedung-item');
  const totalSpan = document.getElementById('totalHarga');
  const inputTotal = document.getElementById('inputTotal');

  function hitungTotal() {
    let total = 0;
    document.querySelectorAll('.hargaGedung').forEach(h => {
      const val = parseFloat(h.value.replace(/[^\d]/g, '')) || 0;
      total += val;
    });
    totalSpan.textContent = 'Rp ' + total.toLocaleString('id-ID');
    inputTotal.value = total.toFixed(2);
  }

  // saat memilih gedung, isi harga otomatis
  document.addEventListener('change', e => {
    if (e.target.classList.contains('selectGedung')) {
      const harga = e.target.selectedOptions[0].dataset.harga || 0;
      const item = e.target.closest('.gedung-item');
      const inputHarga = item.querySelector('.hargaGedung');
      inputHarga.value = parseInt(harga).toLocaleString('id-ID');
      hitungTotal();
    }
  });

  // tambah gedung baru
  document.getElementById('btnTambahGedung').addEventListener('click', () => {
    const clone = template.cloneNode(true);
    clone.querySelectorAll('input').forEach(i => i.value = '');
    clone.querySelectorAll('select').forEach(s => s.selectedIndex = 0);
    daftar.appendChild(clone);
  });

  // hapus baris gedung
  document.addEventListener('click', e => {
    if (e.target.closest('.btnHapusGedung')) {
      const items = document.querySelectorAll('.gedung-item');
      if (items.length > 1) {
        e.target.closest('.gedung-item').remove();
        hitungTotal();
      } else {
        alert('Minimal satu gedung harus dipesan.');
      }
    }
  });
});
</script>
