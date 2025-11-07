<?php
include 'koneksi.php'; // atau sesuaikan path

$query = mysqli_query($koneksi, "SELECT * FROM admin");
// while ($data = mysqli_fetch_assoc($query)) {
//     echo $data['namaadmin'] . "<br>";
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'pages/header.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <?php include 'pages/navbar.php'; ?>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <?php include 'pages/sidebar.php'; ?>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <?php
        // index.php
        if (isset($_GET['halaman'])) {
          $halaman = $_GET['halaman'];

          switch ($halaman) {
            // Bagian admin
            case "admin":
              include("views/admin/admin.php");
              break;

            case "tambahadmin":
              include("views/admin/tambahadmin.php");
              break;
            case "editadmin":
              include("views/admin/editadmin.php");
              break;
              case "tampiladmin":
              include("views/admin/tampiladmin.php");
              break;

            // Bagian gedung
            case "gedung":
              include("views/gedung/gedung.php");
              break;
            case "tambahgedung":
              include("views/gedung/tambahgedung.php");
              break;
            case "editgedung":
              include("views/gedung/editgedung.php");
              break;


            // Bagian kategori
            case "kategori":
              include("views/kategori/kategori.php");
              break;
            case "tambahkategori":
              include("views/kategori/tambahkategori.php");
              break;
            case "editkategori":
              include("views/kategori/editkategori.php");
              break;

            // Bagian pemesan
            case "pemesan":
              include("views/pemesan/pemesan.php");
              break;
            case "tambahpemesan":
              include("views/pemesan/tambahpemesan.php");
              break;
            case "editpemesan":
              include("views/pemesan/editpemesan.php");
              break;

            // Bagian pemesan
            case "pemesanan":
              include("views/pemesanan/pemesanan.php");
              break;
            case "tambahpemesanan":
              include("views/pemesanan/tambahpemesanan.php");
              break;
            case "editpemesanan":
              include("views/pemesanan/editpemesanan.php");
              break;

            //halaman dashboard
            case "dashboard";
              include("views/dashboard.php");
              break;
            case "home";
              include("views/dashboard.php");
              break;

            case "default";
              include("views/notfound.php");
          }
        } else {
          include("views/notfound.php");
        }
        ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">r
      <?php include 'pages/footer.php'; ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>