<?php
  $nombre="inicia sesión";
  session_start();
  if(isset($_SESSION['idusuario'])){
    $nombre = $_SESSION['nombre'];
  }
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script type="text/javascript" src="js/js.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"></script>
    <title>INICIO</title>
  </head>

<body class=" ">
  <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light fixed-top " style="background-color: black; ">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
      aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand" href="index.html">
      <span class="text-warning titulo"> EASY LOAN</span>
    </a>
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class=" nav-item active">
          <a class="nav-link nav-a" href="html/servicios.html"> SERVICIOS </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link nav-a" href="html/conocenos.html">SOBRE NOSOTROS</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link nav-a" href="html/nivel.html">NIVELES</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link nav-a" href="html/prestamista.php">PRESTAMISTA <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link nav-a" href="html/prestamo.php">PRESTATARIO</a>
        </li>

        <li class="nav-item active">
          <div class="btn-group mb-0 bg-transparent">
            <button type="button" class="btn bg-transparent text-white dropdown-toggle  " data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <label for="" class="nav-a">HOLA</label>
              <label for="" class="nav-a"> <?=$_SESSION['nombre']; ?> </label>
            </button>
            <div class="dropdown-menu bg-transparent text-white">
              <a class="dropdown-item text-white " href="html/perfil.php">Perfil</a>
              <a class="dropdown-item text-white" href="html/cambiarcontraseña.php">Cambiar Contraseña</a>
              <div class="dropdown-divider text-white"></div>
              <a class="dropdown-item text-white" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
            </div>
          </div>
        </li>
      </ul>

    </div>
  </nav>
  <section class="mt-5">
    <div class="index-primera-parte bg-white">
      <br><br><br><br> <br><br><br><br><br><br>
      <h1 class="text-center text-white  mt-3 mb-5 text-index-titulo"> TE AYUDAMOS A OBTENER UN PRÉSTAMO DE MANERA
        SENCILLA </h1>

      <div class="row justify-content-center">
        <div class=" text-center justify-content-center">
          <button class="btn btn-purple text-white mb-5"   onclick="location.href='html/conocenos.html'"> CONÓCENOS
          </button>
          <button class="btn btn-warning  mb-5" onclick="location.href='html/iniciarsesion.php'"> INICIA SESION </button>
        </div>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br>
    </div>
    <div class="container-fluid mt-5">
      <div class="container">
        <div class="row ">
          <div class="col-md-4 text-center cuadros-oferta-1 text-justify">
            <h1>ANDA CONÓCE TU PAÍS</h1>
            <div class="prevPhotoPerfil mt-3">
              <img src="recursos/VIAJARON.jpg" class="rounded-circle">
            </div>
            <div class="mt-3 mb-3">
              <h2 class="text-justify">
                !ELLOS CUMPLIERON SU SUEÑO Y CONOCIERON MACHU PICCHU!
              </h2>
            </div>
          </div>

          <div class="col-md-4 text-center cuadros-oferta-2 text-justify">
            <h1>TU PROPIO NEGOCIO</h1>
            <div class="prevPhotoPerfil mt-3">
              <img src="recursos/NEGOCIO.jpg" class="rounded-circle">
            </div>
            <div class="mt-3 mb-3">
              <h2 class="text-justify">
                !ELLA LOGRÓ ABRIR SU PROPIO RESTAURANTE, FELICITACIONES CLAUDIA!
              </h2>
            </div>
          </div>

          <div class="col-md-4 text-center cuadros-oferta-3">
            <h1>INVIERTE TU DINERO</h1>
            <div class="prevPhotoPerfil mt-3">
              <img src="recursos/INVIRTIENDO.jpg" class="rounded-circle">
            </div>
            <div class="mt-3 mb-3">
              <h2 class="text-justify">
                !ÉL TRABAJA DESDE SU CASA DANDO PRÉSTAMOS, UNA GRAN INVERSIÓN!
              </h2>
            </div>
          </div>
        </div>


      </div>

      <div class="row cuadro1">
        <div class="col-lg-12 p-5 ">
          <div class="row mb-5">
            <h1 class="text-white font-weight-light ">Conoce los agradable </h1> &nbsp <h1
              class=" font-weight-bold text-white"> beneficios de unirte</h1>
          </div>
          <div class="row justify-content-between">
            <div class="col-lg-3 cuadritoAbajo mb-3">
              <h1>HAZ PRÉSTAMOS VIRTUALES</h1>
              <p class="text-white-50"> Ya no necesitas hacer largas colas, con un simple click realizaste tu préstamo</p>
            </div>
            <div class="col-lg-3 cuadritoAbajo mb-3">
                <h1>INVIERTE CON POCO</h1>
                <p class="text-white-50">Te damos la oportunidad de que inviertas desde 25 soles, poco a poco aumentas tu capital </p>              </div>
              <div class="col-lg-3 cuadritoAbajo mb-3">
                  <h1>INTERÉS FLEXIBLE</h1>
                  <p class="text-white-50">Los prestamistas deciden cuánto de interés quieren cobrar, el prestatario eligue cuál de las respuestas le es más favorable</p>                </div>
          </div>
        </div> 
      </div>

      <!-- parte de que se una -->
      <div class="row cuadro2">
          <div class="col-lg-4 pl-5">
            <img src="recursos/nueva-historia.png" alt="">
          </div>

          <div class="div-col-8 justify-content-center pt-5">
            <h1 class="p-2 justify-content-center ml-2">ÚNETE A LA FAMILIA DE EASY LOAN</h1>
            <div>
                <label class=" text-justify ml-2 mr-2 pl-3 pr-3">Ahora que ya sabes como trabajamos, anímate y únete a está hermosa familia. </label> <br>
                <label class=" text-justify ml-2 mr-2 pl-3 pr-3">Recuerda que en cuestión de minutos puedes hacer grandes cosas.
                  </label>
            </div>
            
            <div class="row justify-content-end mr-3">
                <button class="btn btn-outline-purple  mb-5" onclick="location.href='html/registrarse.html'"> REGISTRATE </button>
            </div>

          </div>

        </div>


    </div>


  </section>




  <footer class="page-footer font-small unique-color-dark " style="background-color: black;  color: white; ">

    <div style="background-color: #4527a0; color: white;">
      <div class="container">
        <div class="row py-4 d-flex align-items-center">
          <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
            <h6 class="mb-0">CONECTATE CON NOSOTROS EN REDES SOCIALES!</h6>
          </div>

          <div class="col-md-6 col-lg-7 text-center text-md-right">

            <a class="fb-ic">
              <i class="fab fa-facebook-f white-text mr-4"> <img src="../recursos/iconoFacebook.png" alt=""> </i>
            </a>
            <a class="tw-ic">
              <i class="fab fa-twitter white-text mr-4"> <img src="../recursos/iconoTwitter.png" alt=""> </i>
            </a>
            <a class="gplus-ic">
              <i class="fab fa-google-plus-g white-text mr-4"> <img src="../recursos/iconoYoutube.png" alt=""> </i>
            </a>
            <a class="ins-ic">
              <i class="fab fa-instagram white-text"> <img src="../recursos/iconoInstagram.png" alt=""> </i>
            </a>

          </div>

        </div>

      </div>
    </div>

    <div class="container text-center text-md-left mt-5" style="background-color: black;">

      <div class="row mt-3">

        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

          <h6 class="text-uppercase font-weight-bold">Easy Loan</h6>
          <hr class=" mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff;">
          <p class="footer-color">Compañía encargada de brindar servicios de prestamos entre personas con ubicación
            similar.</p>

        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

          <h6 class="text-uppercase font-weight-bold">Beneficios de invertir</h6>
          <hr class=" mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff;">
          <p>
            <a style=" color: white; "
              href="https://www.cuidatudinero.com/13182374/ventajas-y-desventajas-de-invertir">Ventajas y desventajas de
              invertir</a>
          </p>
          <p>
            <a style=" color: white; "
              href="https://caisaagenciadebolsa.com/articulo/invierte-bolsa-ya/1-los-beneficios-invertir/">Los
              beneficios de invertir</a>
          </p>
          <p>
            <a style=" color: white; "
              href="https://www.iahorro.com/ahorro/noticias/ventajas_y_desventajas_de_los_prestamos_personales.html">Préstamos
              personales</a>
          </p>
          <p>
            <a style=" color: white; "
              href="https://www.monografias.com/trabajos97/beneficios-prestamos/beneficios-prestamos.shtml">Beneficios
              de los préstamos</a>
          </p>

        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

          <h6 class="text-uppercase font-weight-bold">Contactanos</h6>
          <hr class=" mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff;">
          <p>
            <i class="fas fa-home mr-3"></i> Chiclayo, Balta 432, PERÚ</p>
          <p>
            <i class="fas fa-envelope mr-3"></i> easyloan@gmail.com</p>
          <p>
            <i class="fas fa-phone mr-3"></i> 979829186</p>
          <p>
            <i class="fas fa-print mr-3"></i> 945000688</p>

        </div>

      </div>

    </div>
    <div class="footer-copyright text-center py-3" style=" background-color:rgb(39, 38, 38) ;">© 2019 Copyright:
      <a href="#" style=" color: white; "> PAOLA CIEZA PS XD</a>
    </div>

  </footer>
</body>

</html>