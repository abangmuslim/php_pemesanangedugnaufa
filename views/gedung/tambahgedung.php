<h3>Tambah Data Gedung</h3>

<form action="db/dbgedung.php?proses=tambah" method="post" enctype="multipart/form-data">
    <table cellpadding="6">
        <tr>
            <td width="150">Kategori</td>
            <td>
                <select name="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    // koneksi sudah di-handle di index.php
                    $q = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                    while ($r = mysqli_fetch_array($q)) {
                        echo "<option value='$r[id_kategori]'>$r[nama_kategori]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nama Gedung</td>
            <td><input type="text" name="nama_gedung" class="form-control" placeholder="Masukkan nama gedung" required></td>
        </tr>
        <tr>
            <td>Kapasitas</td>
            <td><input type="number" name="kapasitas" class="form-control" placeholder="Masukkan kapasitas" required></td>
        </tr>
        <tr>
            <td>Harga (Rp)</td>
            <td><input type="number" name="harga" class="form-control" step="0.01" placeholder="Masukkan harga sewa" required></td>
        </tr>
        <tr>
            <td>Fasilitas</td>
            <td>
                <textarea name="fasilitas" class="form-control" rows="4" placeholder="Contoh: AC, Sound System, Proyektor, dll" required></textarea>
            </td>
        </tr>
        <tr>
            <td>Foto Gedung</td>
            <td><input type="file" name="foto" class="form-control-file" accept="image/*"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-success">💾 Simpan</button>
                <a href="index.php?halaman=gedung" class="btn btn-secondary">↩️ Kembali</a>
            </td>
        </tr>
    </table>
</form>
