<?php
// ===============================================
// DAFTAR PEMESANAN GEDUNG - aplikasi pemesanangedungaufa
// ===============================================

// pastikan koneksi sudah tersedia
if (!isset($koneksi)) {
    include_once "../../koneksi.php";
}

// fungsi format rupiah
if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

$no = 1;

// ======================================================
// Query utama daftar pemesanan
// ======================================================
$query = mysqli_query($koneksi, "
  SELECT 
      p.id_pemesanan,
      ps.nama_pemesan,
      a.nama_admin,
      p.metode_pembayaran,
      p.status_pembayaran,
      p.total_pembayaran
  FROM pemesanan p
  JOIN pemesan ps ON p.id_pemesan = ps.id_pemesan
  JOIN admin a ON p.id_admin = a.id_admin
  ORDER BY p.id_pemesanan DESC
");
?>

<div class="card card-solid shadow-sm">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Daftar Pemesanan Gedung</h3>
        <a href="index.php?halaman=tambahpemesanan" class="btn btn-light btn-sm float-right">
            <i class="fas fa-plus"></i> Tambah Pemesanan
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th width="5%">No</th>
                        <th>Pemesan</th>
                        <th>Admin</th>
                        <th>Gedung yang Dipesan</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Total Pembayaran</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_assoc($query)) {
                            $id = $data['id_pemesanan'];
                            $status = strtolower($data['status_pembayaran']);

                            // ambil daftar gedung yang dipesan (dari detailpemesanan)
                            $gedungList = [];
                            $qGedung = mysqli_query($koneksi, "
                                SELECT g.nama_gedung 
                                FROM detailpemesanan d
                                JOIN gedung g ON d.id_gedung = g.id_gedung
                                WHERE d.id_pemesanan = '$id'
                            ");
                            while ($rowG = mysqli_fetch_assoc($qGedung)) {
                                $gedungList[] = htmlspecialchars($rowG['nama_gedung']);
                            }
                            $daftarGedung = !empty($gedungList) ? implode(', ', $gedungList) : '-';

                            // badge status
                            switch ($status) {
                                case 'lunas':
                                    $badge = 'badge-success';
                                    break;
                                case 'belum bayar':
                                    $badge = 'badge-warning';
                                    break;
                                case 'batal':
                                case 'dibatalkan':
                                    $badge = 'badge-danger';
                                    break;
                                default:
                                    $badge = 'badge-secondary';
                                    break;
                            }
                    ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($data['nama_pemesan']) ?></td>
                                <td><?= htmlspecialchars($data['nama_admin']) ?></td>
                                <td><?= $daftarGedung ?></td>
                                <td><?= ucfirst($data['metode_pembayaran']) ?></td>
                                <td><span class="badge <?= $badge ?>"><?= ucfirst($data['status_pembayaran']) ?></span></td>
                                <td class="text-right font-weight-bold"><?= formatRupiah($data['total_pembayaran']) ?></td>

                                <td class="text-nowrap text-center">
                                    <!-- Detail -->
                                    <a href="index.php?halaman=detailpemesanan&id=<?= $id ?>" 
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Proses Pembayaran -->
                                    <?php if ($status == 'belum bayar') : ?>
                                        <a href="index.php?halaman=prosespembayaran&id=<?= $id ?>" 
                                           class="btn btn-success btn-sm" title="Proses Pembayaran">
                                            <i class="fas fa-credit-card"></i>
                                        </a>
                                    <?php endif; ?>

                                    <!-- Edit -->
                                    <a href="index.php?halaman=editpemesanan&id=<?= $id ?>" 
                                       class="btn btn-warning btn-sm" title="Edit Pemesanan">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Hapus -->
                                    <a href="db/dbpemesanan.php?proses=hapus&id=<?= $id ?>"
                                       onclick="return confirm('Yakin ingin menghapus data pemesanan ini?')"
                                       class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="8" class="text-center">Tidak ada data pemesanan gedung.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
