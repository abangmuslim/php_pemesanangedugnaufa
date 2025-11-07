<?php
include 'koneksi.php';

// Jika tombol simpan ditekan
if (isset($_POST['simpan'])) {
  $nama_kategori = htmlspecialchars($_POST['nama_kategori']);

  if ($nama_kategori == "") {
    $pesan = '<div class="alert alert-danger mt-3">Semua field wajib diisi!</div>';
  } else {
    $query = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori,) 
                                    VALUES ('$nama_kategori')");
    if ($query) {
      echo "<script>alert('Kategori berhasil ditambahkan!'); window.location='kategori.php';</script>";
      exit;
    } else {
      $pesan = '<div class="alert alert-danger mt-3">Gagal menambahkan kategori: ' . mysqli_error($koneksi) . '</div>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori - Pemesan Gedung aufa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Pemesan Gedung aufa</a>
  </div>
</nav>

<div class="container mt-5">
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="m-0"><i class="fas fa-plus-circle me-2"></i>Tambah Kategori</h4>
      <a href="kategori.php" class="btn btn-light btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <div class="card-body">
      <?php if (!empty($pesan)) echo $pesan; ?>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan nama kategori" required>
        </div>

        <button type="submit" name="simpan" class="btn btn-success">
          <i class="fas fa-save me-2"></i> Simpan
        </button>
        <a href="kategori.php" class="btn btn-secondary">
          <i class="fas fa-times me-2"></i> Batal
        </a>
      </form>
    </div>
  </div>
</div>
</body>
</html>
