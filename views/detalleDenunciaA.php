<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detalle denuncia | Administrador</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/css/adminlte.min.css">
  <link rel="stylesheet" href="./assets/css/detDen.css">
  <!-- MAPA-->
  <link rel="stylesheet" href="./assets/css/detDenApi.css">

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="./verDenuncias.php" class="nav-link">Volver a ver denuncias</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="./index.php" class="brand-link">
        <img src="./assets/img/logoFondo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">AYUDITICAS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="https://secrecyjewels.es/blog/wp-content/uploads/2022/10/esencia-de-una-persona.jpg"
              class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info text-white">
            <p>Nombre Administrador</p>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
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
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Páginas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Página Principal</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./redSocial.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Red Social</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h1 class="ml-5 mt-3">Detalle de la denuncia</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section id="confirmCampana" class="container text-center">
        <!-- formulario-->
        <form method="post" action="" id="formDenuncia">
          <div class="row gx-5">
            <div class="col">
              <!-- id denuncia-->
              <?php
              $idDen = $_POST['idDenuncia'];
              echo "<input type='hidden' value='" . $idDen . "' id='idDenunciaEsp' name='idDenunciaEsp'>";
              ?>
              <!-- tipo de denuncia-->
              <label for="tipoDenuncia" class="form-label text-white">
                <h3>Tipo denuncia</h3>
              </label>
              <input class="form-control" id="tipoDenuncia" name="tipoDenuncia" readonly>
            </div>
            <div class="col">
              <!-- imagen-->
              <label class="text-white">
                <h3>Imágen</h3>
              </label>
              <div class="imgDenunciaContainer">
                <img id="imgDenuncia" name="imgDenuncia" src="" alt="Vista previa de la imagen">
              </div>
            </div>
          </div>
          <div class="row gx-5">
            <div class="col">
              <!-- detalle-->
              <label for="detalle" class="form-label text-white">
                <h3>Detalle</h3>
              </label>
              <textarea class="form-control" name="detalle" id="detalle" rows="4" readonly></textarea>
            </div>
            <div class="col">
              <!-- ubicación (PENDIENTE)-->
              <label for="ubicacion" class="form-label text-white">
                <h3 class="mt-1">Ubicación</h3>
              </label>
              <br>
              <div id="map" class="m-2 ml-5">
                <gmp-map center="40.731,-73.997" zoom="8" map-id="DEMO_MAP_ID">
                  <gmp-advanced-marker></gmp-advanced-marker>
              </div>
            </div>
          </div>
        </form>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">© 2024 Copyright
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

</body>
<!-- jquery-->
<script src="./assets/js/jquery.min.js"></script>
<!-- bootstrap-->
<script src="./assets/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./assets/js/adminlte.min.js"></script>
<!-- ver denuncias-->
<script src="./assets/js/detalleDen.js"></script>
<!-- MAPA-->
<script async
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkOC08uDEy_YWwrv9IGqWQiQHSwIVqY7I&loading=async&callback=initMap&libraries=marker&v=beta&solution_channel=GMP_CCS_reversegeocoding_v3"></script>

</html>