<?php
session_start();
if($_SESSION['acceso'] != "cliente"){header("location: iniciarsesion.php");};
/*
if(!isset($_SESSION['acceso'])){header("location: iniciarsesion.php");}
elseif($_SESSION['acceso'] != "cliente"){header("location: iniciarsesion.php");}
*/
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.css">
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="https://checkout.culqi.com/js/v3"></script>
    <script type="text/javascript" src="../js/js.js"></script>
    <script type="text/javascript" src="../js/darPrestamo.js"></script>
    <script type="text/javascript">
        window.ready = inicio();
    </script>
    <title>PRESTAMISTA</title>
</head>

<body class="bg-lightd">
    <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light fixed-top   " style="background-color: black; ">
        
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
            aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <a class="navbar-brand" href="../index.php">
            <!-- <img src="../recursos/icono_libreria.png" width="60" height="60" alt=""> -->
            <span class="text-warning titulo"> EASY LOAN</span>
        </a>
        <div class="collapse navbar-collapse  " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto  ">
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">NOTICIAS<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">CATEGORIAS</a>
                </li>
                <li class=" nav-item active">
                    <a class="nav-link nav-a" href="#"> SERVICIOS </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">HISTORIA</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">VISION</a>
                </li>
                <li class="nav-item active ">
                    <div class="btn-group">
                        <button type="button" class="btn bg-transparent text-white dropdown-toggle font-weight-bold"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="../recursos/perfiles/<?=$_SESSION['foto']; ?>" alt=""
                    class=" rounded-circle perfil_icono  " >
                            Hola, <label for=""> <?=$_SESSION['nombre']; ?> </label>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item " href="perfil.php"  >Perfil</a>
                            <a class="dropdown-item " href="cambiarcontraseña.php">Cambiar Contraseña</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " href="#" onclick="cerrarSesion()">Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>

        
        <!-- <a href="iniciarsesion.html" id="estesi"> <button class="btn btn-warning">INICIAR SESION</button></a> -->
    </nav>
    <section class="container mt-1">
        <br>
        <div class="row mt-5 border border-left-0 border-top-0 border-right-0">
            <div class="col-lg-2 justify-content-center">
                <img src="../recursos/perfiles/<?=$_SESSION['foto']; ?>" alt=""
                    class="perfil_user rounded-circle mb-3 ">
            </div>
            <div class="col-lg-10 ">
                <div class="row justify-content-end pt-3 ">
                    <!--  BOTÓN CON MODAL DE PRÉSTAMO DADO -->
                    <button type="button" class="btn btn-outline-warning mr-3" data-toggle="modal" data-target="#modalPrestamoDados"
                        data-whatever="@mdo" onclick="listarPrestamosDados()">PRÉSTAMO DADOS</button>
                   
                    <div class="modal fade" id="modalPrestamoDados" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">PRESTAMOS OTORGADOS</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="prestamosDados">
                                        
                                        
                                        
                                    </form>
                                </div>
                                <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN BOTÓN CON MODAL DE PRÉSTAMO DADO -->

                    <!--  BOTÓN CON MODAL DE NIVEL -->
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalNivel"
                        data-whatever="@mdo" onclick="mostrarNivel()">NIVEL</button>
                    <div class="modal fade" id="modalNivel" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!---->
                                <div class='modal-header'>
                                    <h1 class='modal-title' id='exampleModalLabel' class='text-lowercase'><b> Hola
                                            <label for='lblnombre'
                                                id='lblnombre'><?=$_SESSION['nombre']; ?></label>!</b></h1>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <form id="nivel">

                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN BOTÓN CON MODAL DE NIVEL -->
                </div>
            </div>
        </div> <br>


        <!-- ESPACIOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO -->

        <div class="row mb-3">
        </div>
        <div class=" ">
        <b>
                <center><label for="" class="text-warning blockquote ">ESTÁN ESPERANDO TU RESPUESTA</label></center>
            </b>
        <div class="row">
            <div class=" col-lg-3 btn-group form-group">
                        <button type="button" class="btn bg-transparent  dropdown-toggle font-weight-bold"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ORDENAR POR: </label>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(0)">TODO</button>
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(1)">MAS CUOTAS</button>
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(2)">MENOS CUOTAS</button>
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(3)">MONTO MENOR</button>
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(4)">MONTO MAYOR</button>
                            <button class="dropdown-item "  onclick="filtrarSolicitudes(5)">FECHA</button>
                        </div>
            </div>
            <div class="col-lg-9  mb-2">
                        <input
                            class="form-control form-control-range border-top-0 border-left-0 border-right-0 border-purple"
                            type="search" placeholder="BUSCAR PRESTATARIO" id="buscarSolicitud" aria-label="Search" onkeyup="buscarSolicitud()">
            </div>
        </div>
            
            
            <div id="solicitudes"class="row mb-2">
                
                
                
                   
                    

            </div>


            <div id=""></div>
            <br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br>
        </div>
<!--   MODAL DE DAR PRESTAMO -->
        <div class="modal fade" id="modalDarPrestamo" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!---->
                                <div class='modal-header'>
                                    <h1 class='modal-title' id='exampleModalLabel' class='text-lowercase'><b> Hola, cuánto interés cobrarás?
                                    </b></h1>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body' style="text-align:center">
                                    <label for="txtinteres">INTERÉS %</label><br>
                                    <input type="text" name="txtinteres" id="txtinteres" class="form-control-lg" onkeyup="validarInteres()" onkeypress="soloDecimales(event,'#txtinteres',5);validarInteres()" >
                                    <div id="msg-interes">
                                        <label class="text-danger">Especifique el porcentaje de interés</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-purple"  onclick="procesarRespuesta()">OFRECER</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCELAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
<!-- MODAL DE DAR PRESTAMO -->
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