<?php
// db/dbpemesanan.php
require_once 'koneksi.php';

function getAllPemesan() {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM pemesan ORDER BY id_pemesan DESC");
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function getPemesanById($id) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM pemesan WHERE id_pemesan = $id");
    return mysqli_fetch_assoc($result);
}

function tambahPemesan($data) {
    global $conn;
    $nama = htmlspecialchars($data['nama_pemesan']);
    $desa = htmlspecialchars($data['desa_pemesan']);
    $kec  = htmlspecialchars($data['kec_pemesan']);
    $hp   = htmlspecialchars($data['hp_pemesan']);
    $id_asal = htmlspecialchars($data['id_asal']);

    // upload foto jika ada
    $foto = null;
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = time() . '_' . basename($_FILES['foto']['name']);
        $target = 'assets/img/pemesan/' . $namaFile;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $foto = $namaFile;
        }
    }

    $query = "INSERT INTO pemesan (nama_pemesan, desa_pemesan, kec_pemesan, hp_pemesan, id_asal, foto)
              VALUES ('$nama', '$desa', '$kec', '$hp', '$id_asal', '$foto')";
    return mysqli_query($conn, $query);
}

function ubahPemesan($data) {
    global $conn;
    $id   = $data['id_pemesan'];
    $nama = htmlspecialchars($data['nama_pemesan']);
    $desa = htmlspecialchars($data['desa_pemesan']);
    $kec  = htmlspecialchars($data['kec_pemesan']);
    $hp   = htmlspecialchars($data['hp_pemesan']);
    $id_asal = htmlspecialchars($data['id_asal']);

    $fotoQuery = "";
    if (!empty($_FILES['foto']['name'])) {
        $namaFile = time() . '_' . basename($_FILES['foto']['name']);
        $target = 'assets/img/pemesan/' . $namaFile;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            $fotoQuery = ", foto='$namaFile'";
        }
    }

    $query = "UPDATE pemesan SET 
                nama_pemesan='$nama',
                desa_pemesan='$desa',
                kec_pemesan='$kec',
                hp_pemesan='$hp',
                id_asal='$id_asal'
                $fotoQuery
              WHERE id_pemesan=$id";
    return mysqli_query($conn, $query);
}

function hapusPemesan($id) {
    global $conn;
    $pemesan = getPemesanById($id);
    if ($pemesan && !empty($pemesan['foto'])) {
        $file = 'assets/img/pemesan/' . $pemesan['foto'];
        if (file_exists($file)) unlink($file);
    }
    return mysqli_query($conn, "DELETE FROM pemesan WHERE id_pemesan = $id");
}
?>
