<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php?halaman=dashboard" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Pemesanan Gedung</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User Panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Aufa Maulidina Hanim</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Cari menu..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Dashboard -->
        <li class="nav-item">
          <a href="index.php?halaman=dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Data Admin -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
              Kelola Admin
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="index.php?halaman=admin" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar Admin</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=tambahadmin" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah Admin</p></a></li>
          </ul>
        </li>

        <!-- Data Pemesan -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Pemesan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="index.php?halaman=pemesan" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar Pemesan</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=tambahpemesan" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah Pemesan</p></a></li>
          </ul>
        </li>

        <!-- Data Gedung -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-building"></i>
            <p>
              Data Gedung
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="index.php?halaman=gedung" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar Gedung</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=tambahgedung" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah Gedung</p></a></li>
          </ul>
        </li>

        <!-- Kategori Gedung -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Kategori Gedung
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="index.php?halaman=kategori" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar Kategori</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=tambahkategori" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah Kategori</p></a></li>
          </ul>
        </li>

        <!-- Pemesanan -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>
              PEMESANAN
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item"><a href="index.php?halaman=daftarpemesanan" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar pemesanan</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=tambahpemesanan" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Tambah pemesanan</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=daftarpembayaran" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Daftar Pembayaran</p></a></li>
            <li class="nav-item"><a href="index.php?halaman=prosespembayaran" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Proses Pembayaran</p></a></li>
          </ul>
        </li>

        <!-- Logout -->
        <li class="nav-item">
          <a href="logout.php" class="nav-link text-danger">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
