<?php
// Ambil ID gedung dari URL
$id_gedung = $_GET['id_gedung'];

// Ambil data gedung lama
$q = mysqli_query($koneksi, "SELECT * FROM gedung WHERE id_gedung='$id_gedung'");
$r = mysqli_fetch_assoc($q);
?>

<h3>Edit Data Gedung</h3>

<form action="db/dbgedung.php?proses=edit" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_gedung" value="<?= $r['id_gedung']; ?>">

    <table cellpadding="6">
        <tr>
            <td width="150">Kategori</td>
            <td>
                <select name="id_kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori_q = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                    while ($kat = mysqli_fetch_array($kategori_q)) {
                        $selected = ($kat['id_kategori'] == $r['id_kategori']) ? 'selected' : '';
                        echo "<option value='$kat[id_kategori]' $selected>$kat[nama_kategori]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Nama Gedung</td>
            <td><input type="text" name="nama_gedung" class="form-control" value="<?= htmlspecialchars($r['nama_gedung']); ?>" required></td>
        </tr>
        <tr>
            <td>Kapasitas</td>
            <td><input type="number" name="kapasitas" class="form-control" value="<?= $r['kapasitas']; ?>" required></td>
        </tr>
        <tr>
            <td>Harga (Rp)</td>
            <td><input type="number" name="harga" class="form-control" step="0.01" value="<?= $r['harga']; ?>" required></td>
        </tr>
        <tr>
            <td>Fasilitas</td>
            <td><textarea name="fasilitas" class="form-control" rows="4" required><?= htmlspecialchars($r['fasilitas']); ?></textarea></td>
        </tr>
        <tr>
            <td>Foto Lama</td>
            <td>
                <?php if (!empty($r['foto']) && file_exists("views/gedung/fotogedung/" . $r['foto'])) { ?>
                    <img src="views/gedung/fotogedung/<?= $r['foto']; ?>" alt="Foto Gedung" width="120" style="border-radius:6px; border:1px solid #ccc;">
                <?php } else { ?>
                    <em>Tidak ada foto</em>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Ganti Foto</td>
            <td><input type="file" name="foto" class="form-control-file" accept="image/*"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">💾 Update</button>
                <a href="index.php?halaman=gedung" class="btn btn-secondary">↩️ Kembali</a>
            </td>
        </tr>
    </table>
</form>
