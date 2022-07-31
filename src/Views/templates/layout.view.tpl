<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="es">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Softwarelat | Admin</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/dist/css/adminlte.min.css" />

    <!-- jQuery -->
    <script src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- JSGrid JS -->
    <script src="https://unpkg.com/gridjs-jquery/dist/gridjs.development.js"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" />

    <style>
      .gridjs-pages>button { color: #6b7280; } .error { color: red; } .content { padding: 1rem !important; } @media (min-width: 576px) { #containerForm { width: 100%; } } @media
      (min-width: 768px) { #containerForm { width: 40%; } }
    </style>

  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper d-flex flex-column min-vh-100">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?page=index" class="nav-link">Inicio</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php?page=admin_productos" class="nav-link">Productos</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mi Cuenta
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#"><i class="fas fa-user-circle"></i> &nbsp;&nbsp; Perfil</a>
              <a class="dropdown-item" href="#"><i class="fas fa-question"></i>&nbsp;&nbsp; Another Option</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp; Cerrar Sesión</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8" />
          <span class="brand-text font-weight-light">Softwarelat Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
              <a href="#" class="d-block">Usuario</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="index.php?page=admin_productos" class="nav-link">
                  <i class="nav-icon fas fa-boxes"></i>
                  <p>
                    &nbsp;&nbsp;&nbsp;Productos
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=admin_categorias" class="nav-link">
                  <i class="nav-icon fas fa-tags"></i>
                  <p>
                    &nbsp;&nbsp;&nbsp;Categorías
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=admin_ClavesDetalles" class="nav-link">
                  <i class="fas fa-key"></i>
                  <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Claves
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        {{{page_content}}}
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
      <footer class="main-footer mt-auto">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          ICONOS DE REDES
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022 <a href="">Softwarelat Honduras</a>.</strong>
        Todos los derechos reservados.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- Bootstrap 4 -->
    <script src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/dist/js/adminlte.min.js"></script>
  </body>

</html>