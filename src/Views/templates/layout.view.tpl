<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href="/{{BASE_DIR}}/public/imgs/imagesPublic/favicon.png" type="image/x-icon">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet">

  <title>Softwarelat Honduras</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css" />

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/tooplate-main.css">
  <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/owl.css">

  <script src="/{{BASE_DIR}}/vendor/almasaeed2010/adminlte/plugins/jquery/jquery.min.js"></script>

  <!-- Start of Async Callbell Code -->
  <script>
    window.callbellSettings = {
      token: "NNNwXdenGkrrVwjd3W3mXX1h"
    };
  </script>
  <script>
    (function(){var w=window;var ic=w.callbell;if(typeof ic==="function"){ic('reattach_activator');ic('update',callbellSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Callbell=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://dash.callbell.eu/include/'+window.callbellSettings.token+'.js';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
  </script>
  <!-- End of Async Callbell Code -->

  <!-- JSGrid JS -->
  <script src="https://unpkg.com/gridjs-jquery/dist/gridjs.development.js"></script>
  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" />

</head>

<body>

  <!-- Pre Header -->
  <div id="pre-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <span>Licencias de software, juegos, programas y soporte de TI.</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="index.php?page=index"><img id="img-header" style="width: 375px; height: auto;"
          src="/{{BASE_DIR}}/public/imgs/imagesPublic/logo_transparent.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php?page=index">Inicio
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=productos_lista&pag=1">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=pages_about">Sobre Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=pages_contact">Contáctanos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=orders_orders"><i style="font-size: x-large;" class="fas fa-shopping-bag"></i></a>
          </li>
          <li id="last" style="margin-left: -7px; margin-right: -7px;" class="nav-item">
            <a class="nav-link" href="index.php?page=orders_cartItems"><i style="font-size: x-large;" class="fas fa-shopping-cart"></i></a>
          </li>
 
            {{if login}}
              {{with login}}
              <input type="hidden" id="isLogeado" value="true">
                <li class="nav-item">
                  <a class="nav-link" href="index.php?page=sec_logout"><i style="font-size: x-large;" class="fas fa-sign-out-alt"></i></i></a>
                </li>
                <p class="nav-link">¡BIENVENIDO(a), <a class="nav-link-user" href="index.php?page=pages_infouser"> {{userName}}! </a></p>
              {{endwith login}}
            {{endif login}}
        </ul>
      </div>
    </div>
  </nav>

  <div style="margin-top: 50px;">
    {{{page_content}}}
  </div>

  <!-- Footer Starts Here -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="logo">
            <img style="width: 200px; height: auto;" src="/{{BASE_DIR}}/public/imgs/imagesPublic/logo_transparent.png"
              alt="">
          </div>
        </div>
        <div class="col-md-12">
          <div class="footer-menu">
            <ul>
              <li><a href="index.php?page=index">Inicio</a></li>
              <li><a href="index.php?page=index">Ayuda</a></li>
              <li><a href="index.php?page=index">Política de Privacidad</a></li>
              <li><a href="https://docs.google.com/document/d/e/2PACX-1vQ-Mtgb85cKyrrVWfaFSIyabkZIaoFNdSs4M47Qk7vZojso1AJO-p9sV_qJLR42Z0WTEHBEU63PiCPc/pub" target="_blank">Términos y Condiciones</a></li>
              <li><a href="index.php?page=pages_contact">Contáctanos</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-12">
          <div class="social-icons">
            <ul>
              <li><a href="https://www.facebook.com/softwarelat" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              <li><a href="https://www.instagram.com/softwarelat_/" target="_blank"><i class="fab fa-instagram"></i></a></li>
              <li><a href="https://api.whatsapp.com/send?phone=50498753532" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer Ends Here -->

  <!-- Sub Footer Starts Here -->
  <div class="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright-text">

          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Sub Footer Ends Here --> 

  <!-- Bootstrap core JavaScript -->
  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>


  <!-- Additional Scripts -->
  <script src="/{{BASE_DIR}}/public/scripts/custom.js"></script>
  <script src="/{{BASE_DIR}}/public/scripts/owl.js"></script>
  <script src="/{{BASE_DIR}}/public/scripts/isotope.js"></script>
  <script src="/{{BASE_DIR}}/public/scripts/flex-slider.js"></script>

  <script>
    $(document).ready(function () {
      $("<p>Copyright &copy; " + new Date().getFullYear() + " Softwarelat Honduras</p>").insertAfter(".copyright-text");
      
      if($("#isLogeado").val() == undefined) {
        $(`<li class="nav-item">
                <a class="nav-link" id="loginIcon" href="index.php?page=sec_login"><i style="font-size: x-large;" class="fas fa-user"></i></a>
              </li>`).insertAfter("#last");
        $("#navbarResponsive").css({ left: "40%" });
      }
      else{
        $("#loginIcon").empty();
      }
      
      
    });
  </script>


</body>

</html>