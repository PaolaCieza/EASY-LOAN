<?php
session_start();
if(!isset($_SESSION['idusuario'])){header("location: iniciarsesion.php");}
elseif($_SESSION['acceso'] != "cliente"){header("location: iniciarsesion.php");}

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
    <script type="text/javascript">
        window.ready = inicio();
    </script>
    <title>PRÉSTAMO</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light fixed-top   " style="background-color: black; ">
        <a class="navbar-brand" href="../index.html">
            <!-- <img src="../recursos/icono_libreria.png" width="60" height="60" alt=""> -->
            <span class="text-warning titulo"> EASY LOAN</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
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
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="iniciarsesion.php">INICIAR SESION 1</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="iniciarsesion2.php">INICIAR SESION 2</a>
                </li>
            </ul>

        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
            aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <a href="iniciarsesion.html" id="estesi"> <button class="btn btn-warning">INICIAR SESION</button></a> -->
    </nav>
    <section class="container mt-1">
        <br> 
        <div class="row mt-5 border border-left-0 border-top-0 border-right-0">
            <div class="col-lg-2 justify-content-center">
                <img src="../recursos/perfiles/<?php echo $_SESSION['foto']; ?>" alt=""
                    class="perfil_user rounded-circle mb-3">
            </div>
            <div class="col-lg-10 ">
                <div class="row justify-content-end pt-3 ">
                    <!--  BOTÓN CON MODAL DE SOLICITAR PRÉSTAMO -->
                    <button type="button" class="btn btn-outline-warning mr-3" data-whatever="@mdo" onclick="permitirSolicitud()">SOLICITAR PRÉSTAMO</button>
                    <div class="modal fade" id="modalPrestamoSoli" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">SOLICITAR
                                        NUEVO PRESTAMO</h1>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <center><img src="../recursos/perfiles/<?php echo $_SESSION['foto']; ?>"
                                                    alt="" class="rounded-circle perfil_user"></center>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">DNI</label>
                                            <input type="text" class="form-control" id="recipient-name" value="" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">CORREO</label>
                                            <input type="text" class="form-control" id="message-text" readonly></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">MONTO SOLICITAR S/</label>
                                            <input type="number" class="form-control" id="txtmonto" onkeypress="solonumeros(event,'#txtmonto',8)"></input>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">PERIODO</label> <br>
                                            <select name="periodo" id="periodo" class="border-0">
                                                <option value="" selected disabled="disabled">seleccionar</option>
                                                <option value="false">SEMANAL</option>
                                                <option value="true">MENSUAL</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">CUOTAS</label> <br>
                                            <select name="cuotas" id="periodo" class="border-0">
                                                <option value="" selected disabled="disabled">seleccionar</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">CANCELAR</button>
                                    <button type="button" class="btn btn-primary" onclick="validarSolicitud()">SOLICITAR</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN BOTÓN CON MODAL DE SOLICITAR PRÉSTAMO -->

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
                                                id='lblnombre'><?php echo $_SESSION['nombre']; ?></label>!</b></h1>
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
            <!--  BOTÓN CON MODAL DE RESPUESTAS-->
            <button type="button" class="btn btn-outline-info col-12 p-3" data-toggle="modal"
                data-target="#modalRespuestas" data-whatever="@mdo" onclick="listarRespuestas()">RESPUESTAS A LA
                SOLICITUD ACTUAL</button>
            <div class="modal fade" id="modalRespuestas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">AQUÍ TE TENEMOS
                                RESPUESTAS</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="respuestas">
                                   
                                <!-- <div class="form-group">
                            <center> <img src="../recursos/nivel1.png" alt="" width="120px"></center>
                            </div> -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN BOTÓN CON MODAL DE RESPUESTAS -->
        </div>
        <div class="bg-white p-4">
            <b>
                <center><label for="" class="text-danger blockquote">HISTORIAL DE PRÉSTAMOS</label></center>
            </b>
            <table class="table table-responsive  table-striped table-dark">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>PRESTAMISTA</th>
                        <th>MONTO</th>
                        <th>CUOTAS</th>
                        <th>ESTADO</th>
                        <th>FECHA-PRÉSTAMO</th>
                        <th>LISTA CUOTAS</th>
                        <th>PAGAR CUOTA</th>
                    </tr>
                </thead>
                <tbody id="registros">
                </tbody>
            </table>
            <div id="divpaginas"></div>
            <br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br>
        </div>

        <!--  BOTÓN CON MODAL DE LISTAR CUOTAS-->
        <div class="modal fade  " id="modaListarCuotas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  " role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">ESTÁS SON TUS CUOTAS</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <table class="table table-responsive  table-striped table-dark">
                                <thead class="">
                                    <tr>
                                        <th>NÚMERO CUOTA</th>
                                        <th>MONTO CUOTA</th>
                                        <th>FECHA VENCIMIENTO</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody id="listacuotas">

                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN BOTÓN CON MODAL DE LISTAR CUOTAS -->

        <!--  BOTÓN CON MODAL DE PAGAR CUOTAS-->
        <div class="modal fade  " id="modalPagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  " role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">PAGAR</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" id="pagarcuota">
                            
                            
                        
                        
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- FIN BOTÓN CON MODAL DE PAGAR CUOTAS -->

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