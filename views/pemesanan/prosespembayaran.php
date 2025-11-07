<?php
// views/pemesanan/prosespembayaran.php
date_default_timezone_set('Asia/Jakarta');

// Pastikan GET id_pemesanan ada
if (!isset($_GET['id_pemesanan'])) {
    echo "<script>alert('ID pemesanan tidak ditemukan!'); window.location='index.php?halaman=daftarpembayaran';</script>";
    exit;
}

$idpemesanan = intval($_GET['id_pemesanan']);

// Ambil data pemesan dan pemesanan
$q = mysqli_query($koneksi, "
    SELECT p.*, pm.nama_pemesan
    FROM pemesanan p
    JOIN pemesan pm ON p.id_pemesan = pm.id_pemesan
    WHERE p.id_pemesanan = '$idpemesanan'
");
if (mysqli_num_rows($q) == 0) {
    echo "<script>alert('Data pemesanan tidak ditemukan!'); window.location='index.php?halaman=daftarpembayaran';</script>";
    exit;
}
$pemesanan = mysqli_fetch_assoc($q);

// Ambil detail gedung yang dipesan
$qDetail = mysqli_query($koneksi, "
    SELECT dp.*, g.nama_gedung, g.harga
    FROM detailpemesanan dp
    JOIN gedung g ON dp.id_gedung = g.id_gedung
    WHERE dp.id_pemesanan = '$idpemesanan'
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Proses Pembayaran Gedung</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container-fluid px-4 mt-4">

    <div class="alert alert-warning">
        <h3>Sedang memproses pembayaran dari
            <strong><?= htmlspecialchars($pemesanan['nama_pemesan']) ?></strong>
        </h3>
    </div>

    <form method="POST" action="db/dbpembayaran.php" enctype="multipart/form-data">
        <input type="hidden" name="id_pemesanan" value="<?= $idpemesanan ?>">
        <input type="hidden" name="tanggal_bayar" value="<?= date('Y-m-d') ?>">

        <!-- Tabel Detail Gedung -->
        <div class="table-responsive">
            <table class="table table-bordered w-100">
                <thead class="bg-info text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Gedung</th>
                        <th>Tanggal Sewa</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    $totalBayar = 0; 
                    while ($d = mysqli_fetch_assoc($qDetail)): 
                        $totalBayar += $d['harga']; 
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($d['nama_gedung']) ?></td>
                            <td><?= $d['tanggal_sewa'] ?></td>
                            <td><?= $d['waktu_mulai'] ?></td>
                            <td><?= $d['waktu_selesai'] ?></td>
                            <td>Rp<?= number_format($d['harga'],0,",",".") ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Form Pembayaran -->
        <div class="row align-items-center mt-4 text-center">
            <!-- Total Bayar -->
            <div class="col-md-3">
                <label class="fw-bold d-block fs-6">Total Bayar</label>
                <span id="total-bayar" class="badge bg-info text-white fs-4 fw-bold px-4 py-3 d-block">
                    Rp<?= number_format($totalBayar,0,",",".") ?>
                </span>
                <input type="hidden" name="total_bayar" id="total-bayar-input" value="<?= $totalBayar ?>">
            </div>

            <!-- Jumlah Bayar -->
            <div class="col-md-3">
                <label class="fw-bold d-block fs-6">Jumlah Bayar</label>
                <input type="number" name="jumlah_bayar" id="jumlah-bayar" class="form-control form-control-lg text-center" min="0" value="<?= $totalBayar ?>" required>
            </div>

            <!-- Metode Pembayaran -->
            <div class="col-md-3">
                <label class="fw-bold d-block fs-6">Metode Pembayaran</label>
                <select name="metode_bayar" class="form-control" required>
                    <option value="">--Pilih Metode--</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <!-- Bukti Pembayaran -->
            <div class="col-md-3">
                <label class="fw-bold d-block fs-6">Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" class="form-control">
            </div>

            <!-- Tunggakan & Kembalian -->
            <div class="col-md-6 mt-3">
                <label class="fw-bold d-block fs-6">Tunggakan</label>
                <span id="tunggakan" class="badge bg-danger text-white fs-4 fw-bold px-4 py-2 d-block">Rp0</span>
                <input type="hidden" id="input-tunggakan" name="tunggakan">
            </div>
            <div class="col-md-6 mt-3">
                <label class="fw-bold d-block fs-6">Kembalian</label>
                <span id="kembalian" class="badge bg-success text-white fs-4 fw-bold px-4 py-2 d-block">Rp0</span>
            </div>
        </div>

        <div class="mt-4 text-end">
            <a href="index.php?halaman=daftarpembayaran" class="btn btn-secondary btn-sm">Kembali</a>
            <button type="submit" class="btn btn-success btn-sm">Simpan Pembayaran</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const totalBayar = parseInt(document.getElementById('total-bayar-input').value);
    const jumlahBayarEl = document.getElementById('jumlah-bayar');
    const tunggakanEl = document.getElementById('tunggakan');
    const kembalianEl = document.getElementById('kembalian');
    const inputTunggakan = document.getElementById('input-tunggakan');

    const formatRupiah = num => 'Rp' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    const hitung = () => {
        const dibayar = parseInt(jumlahBayarEl.value) || 0;
        const tunggakan = Math.max(totalBayar - dibayar,0);
        const kembalian = Math.max(dibayar - totalBayar,0);

        tunggakanEl.textContent = formatRupiah(tunggakan);
        kembalianEl.textContent = formatRupiah(kembalian);
        inputTunggakan.value = tunggakan;
    };

    jumlahBayarEl.addEventListener('input', hitung);
    hitung();
});
</script>
</body>
</html>
