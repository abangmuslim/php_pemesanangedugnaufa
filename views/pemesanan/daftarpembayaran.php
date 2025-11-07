<?php
// ===============================================
// DAFTAR PEMBAYARAN - aplikasi pemesanangedungaufa
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

// ambil semua pemesanan beserta status pembayaran
$query = mysqli_query($koneksi, "
    SELECT 
        p.id_pemesanan,
        p.id_pemesan,
        pem.nama_pemesan,
        p.status_pembayaran,
        COUNT(dp.id_detailpemesanan) AS jumlah_gedung,
        p.total_pembayaran
    FROM pemesanan p
    JOIN pemesan pem ON p.id_pemesan = pem.id_pemesan
    LEFT JOIN detailpemesanan dp ON dp.id_pemesanan = p.id_pemesanan
    GROUP BY p.id_pemesanan, p.id_pemesan, pem.nama_pemesan, p.status_pembayaran, p.total_pembayaran
    ORDER BY p.id_pemesanan DESC
");
?>

<div class="container-fluid px-4 mt-4">

    <div class="card card-solid shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Pemesanan Gedung</strong>
            <a href="index.php?halaman=tambahpemesanan" class="btn btn-light btn-sm float-right">
                <i class="fas fa-plus"></i> Tambah Pemesanan
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-bordered table-hover table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemesan</th>
                            <th class="text-center">Jumlah Gedung</th>
                            <th>Total Pembayaran</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Detail</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; if($query && mysqli_num_rows($query) > 0): ?>
                            <?php while ($p = mysqli_fetch_assoc($query)): ?>
                                <?php 
                                    $status = strtolower($p['status_pembayaran']);
                                    switch ($status) {
                                        case 'lunas': $badge = 'badge-success'; break;
                                        case 'belum bayar': $badge = 'badge-warning'; break;
                                        default: $badge = 'badge-secondary'; break;
                                    }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($p['nama_pemesan']) ?></td>
                                    <td class="text-center"><?= $p['jumlah_gedung'] ?></td>
                                    <td class="text-right font-weight-bold"><?= formatRupiah($p['total_pembayaran']) ?></td>
                                    <td class="text-center"><span class="badge <?= $badge ?>"><?= ucfirst($p['status_pembayaran']) ?></span></td>
                                    <td class="text-center">
                                        <a href="index.php?halaman=detailpemesanan&id=<?= $p['id_pemesanan'] ?>" class="btn btn-info btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <?php if($status == 'belum bayar'): ?>
                                            <a href="index.php?halaman=prosespembayaran&id_pemesanan=<?= $p['id_pemesanan'] ?>" class="btn btn-success btn-sm" title="Proses Pembayaran">
                                                <i class="fas fa-credit-card"></i> Bayar
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada aksi</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data pemesanan gedung.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- ====== DataTables JS ====== -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
