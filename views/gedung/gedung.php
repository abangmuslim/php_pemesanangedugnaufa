
<h3>Data Gedung</h3>
<a href="index.php?halaman=tambahgedung" class="btn btn-primary mb-3">+ Tambah Gedung</a>

<table border="1" cellspacing="0" cellpadding="8" width="100%">
    <tr style="background-color:#f2f2f2;">
        <th>No</th>
        <th>Kategori</th>
        <th>Nama Gedung</th>
        <th>Kapasitas</th>
        <th>Harga</th>
        <th>Fasilitas</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $query = mysqli_query($koneksi, "SELECT g.*, k.nama_kategori 
                                    FROM gedung g 
                                    LEFT JOIN kategori k ON g.id_kategori = k.id_kategori
                                    ORDER BY g.id_gedung DESC");
    while ($data = mysqli_fetch_array($query)) {
    ?>
        <tr>
            <td align="center"><?= $no++; ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td><?= $data['nama_gedung']; ?></td>
            <td align="center"><?= $data['kapasitas']; ?></td>
            <td align="right">Rp <?= number_format($data['harga'], 0, ',', '.'); ?></td>
            <td><?= nl2br($data['fasilitas']); ?></td>
            <td align="center">
                <?php if ($data['foto'] != '') { ?>
                    <img src="views/gedung/fotogedung/<?= $data['foto']; ?>" width="100">
                <?php } else { ?>
                    <em>Tidak ada foto</em>
                <?php } ?>
            </td>
            <td align="center">
                <a href="index.php?halaman=editgedung&id_gedung=<?= $data['id_gedung']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="db/dbgedung.php?proses=hapus&id_gedung=<?= $data['id_gedung']; ?>" 
                   onclick="return confirm('Yakin ingin menghapus gedung ini?')" 
                   class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
    <?php } ?>
</table>
