<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "../koneksi.php";

$proses = $_GET['proses'] ?? '';

if ($proses == 'tambah') {
    $nama_admin = $_POST['nama_admin'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $hp_admin = $_POST['hp_admin'] ?? '';

    // Upload foto
    $foto = '';
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "../uploads/admin/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $foto = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO admin (nama_admin, username, password, hp_admin, foto)
            VALUES ('$nama_admin', '$username', '$password', '$hp_admin', '$foto')";
    mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

    header("Location: ../views/admin/admin.php?status=tambah_sukses");
    exit();
}

elseif ($proses == 'edit') {
    if (empty($_POST['id_admin'])) {
        die("Error: ID admin tidak ditemukan!");
    }

    $id_admin = mysqli_real_escape_string($koneksi, $_POST['id_admin']);
    $nama_admin = $_POST['nama_admin'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $hp_admin = $_POST['hp_admin'] ?? '';

    // Ambil data lama
    $dataLama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT foto FROM admin WHERE id_admin='$id_admin'"));

    // Jika ada upload foto baru
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "../uploads/admin/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $fotoBaru = time() . "_" . basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $fotoBaru;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);

        // Hapus foto lama jika ada
        if (!empty($dataLama['foto']) && file_exists($target_dir . $dataLama['foto'])) {
            unlink($target_dir . $dataLama['foto']);
        }

        $foto_sql = ", foto='$fotoBaru'";
    } else {
        $foto_sql = "";
    }

    // Jika password kosong, jangan ubah
    if (!empty($password)) {
        $pass_sql = ", password='$password'";
    } else {
        $pass_sql = "";
    }

    $sql = "UPDATE admin SET 
                nama_admin='$nama_admin',
                username='$username',
                hp_admin='$hp_admin'
                $pass_sql
                $foto_sql
            WHERE id_admin='$id_admin'";

    mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));
    header("Location: ../views/admin/admin.php?status=edit_sukses");
    exit();
}

elseif ($proses == 'hapus') {
    $id_admin = $_GET['id_admin'] ?? '';
    if ($id_admin == '') die("Error: ID admin tidak ditemukan!");

    $result = mysqli_query($koneksi, "SELECT foto FROM admin WHERE id_admin='$id_admin'");
    $data = mysqli_fetch_assoc($result);
    if (!empty($data['foto']) && file_exists("../uploads/admin/" . $data['foto'])) {
        unlink("../uploads/admin/" . $data['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin='$id_admin'") or die(mysqli_error($koneksi));
    header("Location: ../views/admin/admin.php?status=hapus_sukses");
    exit();
}

else {
    echo "Proses tidak dikenal!";
}
?>
