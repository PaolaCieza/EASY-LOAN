<?php
  session_start();
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

<body class="--fondito -badge-dark">
    <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light fixed-top " style="background-color: black; ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
            aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>       
    
        <a class="navbar-brand" href="index.php">
            <span class="text-warning titulo"> EASY LOAN</span>
        </a>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class=" nav-item active">
                    <a class="nav-link nav-a" href="html/servicios.php"> SERVICIOS </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="html/conocenos.html">SOBRE NOSOTROS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="html/nivel.php">NIVELES</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="html/prestamista.php">PRESTAMISTA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="html/prestamo.php">PRESTATARIO</a>
                </li>
                
                <li class="nav-item active">
                    <div class="btn-group mb-0 ">
                        <button type="button" class="btn bg-transparent text-white dropdown-toggle  "
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <label for="" class="nav-a">HOLA</label>
                             <label for="" class="nav-a"> <?=$_SESSION['nombre']; ?> </label>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="html/perfil.php">Perfil</a>
                            <a class="dropdown-item" href="html/cambiarcontraseña.php">Cambiar Contraseña</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
    </nav>
  <section class="mt-5">
    <div class="index-primera-parte bg-white">
      <br><br><br><br> <br><br><br><br>
      <h1 class="text-center text-dark mt-3 mb-5"> TE AYUDAMOS A OBTENER UN PRÉSTAMO DE MANERA SENCILLA </h1>

      <div class="row">
        <div class="col-4">
          <h1 class=""><br></h1>
        </div>
        <div class="col-4 text-center">
          <button class="btn btn-secondary mb-5" onclick="location.href='html/conocenos.html'"> CONÓCENOS </button>
          <button class="btn btn-warning mb-5" onclick="location.href='html/registrarse.html'"> REGISTRATE </button>
        </div>
        <div class="col-4">
          <h1> <br></h1>
        </div>
      </div>

      <br><br><br><br><br> <br><br><br><br>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="col  ml-1 mr-1">
              <div class="row offset-2 text-warning  text-center ">
                <h1>APROVECHA LAS OFERTAS QUE TE OFRECE EASY LOAN</h1>
              </div>
            </div>
            <div class="row ">
              <div class="col-md-4 text-center cuadros-oferta-1">
                <h1>OFERTA 1</h1>
                <h2>Sube al nivel 3 </h2>
                <span>
                  <br> <br><br><br><br><br><br><br><br><br><br><br>
                </span>
      
              </div>
              <div class="col-md-4 text-center cuadros-oferta-2">
                <h1>OFERTA 2</h1>
                <h2>Sube al nivel 4 </h2>
                <span>
                  <br><br><br><br><br><br><br><br><br><br><br><br>
                </span>
              </div>
              <div class="col-md-4 text-center cuadros-oferta-3">
                <h1>OFERTA 3</h1>
                <h2>Sube al nivel 5 </h2>
                <span>
                  <br> <br><br><br><br><br><br><br><br><br><br><br>
      
                </span>
              </div>
            </div>
      
            <div class="row cuadro1">
              <div class="col-sm-8  contenedor-index">
                <h1 class="text-center">PAOLA</h1>
                <h2>hbsnjk</h2>
                <h3>fgvbhjklñ</h3>
                <br><br><br><br><br> <br>
              </div>
              <div class="col-sm-4 bg-warning contenedor-index">
                <h1 class="text-center">PAOLA2</h1>
                <h2>ghbhnjmk</h2>
                <h3>vbnjmk,</h3>
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