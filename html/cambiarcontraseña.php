<?php
    session_start();
    if(!isset($_SESSION['idusuario'])) header("location: iniciarsesion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script type="text/javascript" src="../js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.17.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <!-- wbda grafico -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <title>CAMBIAR CONTRASEÑA</title>
</head>

<body class="-fondito">
    <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light   " style="background-color: black; ">
        <a class="navbar-brand" href="../index.php">
            <!-- <img src="../recursos/icono_libreria.png" width="60" height="60" alt=""> -->
            <span class="text-warning titulo"> EASY LOAN</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">NOTICIAS <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">NIVELES</a>
                </li>
                <li class=" nav-item active">
                    <a class="nav-link nav-a" href="servicios.php"> SERVICIOS </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">HISTORIA</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">VISION</a>
                </li>
                <li class="nav-item active">
                    <div class="btn-group">
                        <button type="button" class="btn bg-transparent text-white dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Hola, <label for=""> <?=$_SESSION['nombre']; ?> </label>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="perfil.php">Perfil</a>
                            <a class="dropdown-item" href="cambiarcontraseña.php">Cambiar Contraseña</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
            aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="iniciarsesion.html" id="estesi"> <button class="btn btn-warning">INICIAR SESION</button></a>
    </nav>

    <section class="container-fluid">
        <div class="row justify-content-center mt-5 mb-5">
            <div class="col-lg-3  border border-left-3 mr-3 ml-3 p-3">
                <div class=" row justify-content-center mt-3" id="">
                    <img src="../recursos/perfiles/<?=$_SESSION['foto']?>" alt="" class="perfil_user rounded-circle">
                </div>
                <div class="row justify-content-center mt-3">
                    <span class="text-break font-weight-bold"><?=$_SESSION['nombre']?></span>
                </div>
                <div class="row justify-content-center mt-3">
                    <a href="perfil.html"> <button class="bg-warning border-0">VOLVER A PERFIL</button> </a>
                </div>
            </div>
            <div class="col-lg-7 ">
                <div class=" row justify-content-center mt-3 bg-warning  ">
                    <h1>CAMBIAR CONTRASEÑA</h1>
                </div> <br>

                <form class=" text-dark bg-light p-2 rounded-circle">
                    <div class="form-group">
                        <label for="txtclave"> CONTRASEÑA ACTUAL</label>
                        <input type="password" class="form-control" name="txtclave" id="txtclave"
                            placeholder="Ingrese su contraseña actual...">
                    </div>
                    <div class="form-group">
                        <label for="txtclave"> CONTRASEÑA NUEVA</label>
                        <input type="password" class="form-control" name="txtclave" id="txtclave"
                            placeholder="Ingrese su contraseña nueva...">
                    </div>
                    <div class="form-group">
                        <label for="txtclave"> VUELVA A ESCRIBIR</label>
                        <input type="password" class="form-control" name="txtclave" id="txtclave"
                            placeholder="Ingrese nuevamente su contraseña nueva...">
                    </div>
                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                        <div class="form-group">
                            <input type="button" value="GUARDAR" class="btn btn-warning"
                                onclick="editarPerfil()">
                        </div>
                    </div>
                </form>
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
                            <i class="fab fa-facebook-f white-text mr-4"> <img src="../recursos/iconoFacebook.png"
                                    alt=""> </i>
                        </a>
                        <a class="tw-ic">
                            <i class="fab fa-twitter white-text mr-4"> <img src="../recursos/iconoTwitter.png" alt="">
                            </i>
                        </a>
                        <a class="gplus-ic">
                            <i class="fab fa-google-plus-g white-text mr-4"> <img src="../recursos/iconoYoutube.png"
                                    alt=""> </i>
                        </a>
                        <a class="ins-ic">
                            <i class="fab fa-instagram white-text"> <img src="../recursos/iconoInstagram.png" alt="">
                            </i>
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
                    <p class="footer-color">Compañía encargada de brindar servicios de prestamos entre personas con
                        ubicación
                        similar.</p>

                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                    <h6 class="text-uppercase font-weight-bold">Beneficios de invertir</h6>
                    <hr class=" mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff;">
                    <p>
                        <a style=" color: white; "
                            href="https://www.cuidatudinero.com/13182374/ventajas-y-desventajas-de-invertir">Ventajas y
                            desventajas de
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