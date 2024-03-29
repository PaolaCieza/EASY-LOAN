<?php
    session_start();
    if($_SESSION['acceso'] == "cliente"){header("location: iniciarsesion.php");};
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
    <script type="text/javascript" src="../js/js.js"></script>
    <script type="text/javascript">
        window.ready = listarNiveles();
        window.ready = formatoFoto();
    </script>
    <title>MANTENIMIENTO CLIENTE</title>
</head>

<body class="">
    <nav class="navbar navbar-dark  navbar-expand-lg  navbar-light fixed-top   " style="background-color: black; ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent "
            aria-controls="navbarSupportedContent " aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="../index.php">
            <!-- <img src="../recursos/icono_libreria.png" width="60" height="60" alt=""> -->
            <span class="text-warning titulo "> EASY LOAN</span>
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-autosdf">
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">USUARIO <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#">NIVEL</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link nav-a" href="#"> PRESTAMOS </a>
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

    </nav> <br>
    <div class="container-fluid mt-4 ">
        <div class="row mt-4 mb-5">
            <div class="col-lg-6 p-5 texto-label fondo-man-usu ">
                <center>
                    <h1 class="  font-weight-bold text-purple">
                        MANTENIMIENTO NIVEL
                    </h1>
                </center>
            </div>
            <div class="col-lg-6  p-0 ">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block" src="../recursos/cliente.jpg" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block " src="../recursos/cliente2.jpeg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block " src="../recursos/cliente4.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <section class="container mt-5 p-0  ">
        <button class="col-lg-12 mb-5 btn btn-outline-purple" data-toggle="modal" data-target="#modalNuevoNivel"
            data-whatever="@mdo">
            AGREGAR NUEVO NIVEL
        </button>
        <div id="niveles" class="row">

        </div>
        <br><br><br><br><br><br>
    </section>

    <!--  BOTÓN CON MODAL NUEVO NIVEL -->
    <div class="modal fade " id="modalNuevoNivel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-monospace text-purple" id="exampleModalLabel">NUEVO NIVEL
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation">
                        <div class="form-group border border-purple  p-3">
                            <div class="row">
                                <div class="col-lg-4 justify-content-center mb-2">
                                    <center>
                                            <div>
                                                <label for="foto">IMAGEN</label>
                                                <div class="prevPhoto">
                                                <span class="delPhoto notBlock">X</span>
                                                <label for="foto"></label>
                                                </div>
                                                <div class="upimg">
                                                <input type="file" name="foto" id="foto" required>
                                                </div>
                                                <div id="form_alert"></div>
                                            </div>
                                    </center>

                                </div>
                                <div class="col-lg-8">
                                    <form action="">
                                        <div class="form-group">
                                            <label for="txtNombre"> NOMBRE</label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtNombre" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDescripcion"> DESCRIPCIÓN </label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtDescripcion" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="txtMontoMaximo"> MONTO MÁXIMO</label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtMontoMaximo" onkeypress="soloDecimales(event,'#txtMontoMaximo',5)" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple" onclick="validarNivel()">GUARDAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BOTÓN CON MODAL DE NUEVO NIVEL -->





    <!--  BOTÓN CON MODAL EDITAR NIVEL -->
    <div class="modal fade" id="modalEditarNivel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-monospace text-purple" id="exampleModalLabel">EDITAR NIVEL
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation">
                        <div class="form-group border border-purple  p-3">
                            <div class="row">
                                <div class="col-lg-4">
                                    <center>
                                            <div>
                                                <label for="foto">IMAGEN</label>
                                                <div class="prevPhoto border border-0">
                                                <span class="delPhoto notBlock font-weight-bold">X</span>
                                                <label for="foto"></label>
                                                </div>
                                                <div class="upimg ">
                                                <input type="file" name="foto" id="foto">
                                                </div>
                                                <div id="form_alert"></div>
                                            </div>
                                    </center>
                                </div>
                                <div class="col-lg-8">
                                    <form action="">
                                        <div class="form-group">
                                            <input id="idnivel" type="hidden" value="">
                                            <label for="txtNombreE"> NOMBRE</label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtNombreE" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="txtDescripcionE"> DESCRIPCIÓN </label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtDescripcionE" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <label for="txtMontoMaximoE"> MONTO MÁXIMO</label>
                                            <input type="text"
                                                class="form-control border border-dark border-left-0 border-top-0 border-right-0 bg-white"
                                                value="" id="txtMontoMaximoE" required>
                                            <div class="valid-feedback">
                                                    OK
                                            </div>
                                            <div class="invalid-feedback">
                                                    No ok
                                            </div> 
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple" onclick="validarNivelE()">EDITAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BOTÓN CON MODAL DE EDITAR NIVEL -->

    <footer class="page-footer font-small unique-color-dark fixed-bottom"
        style="background-color: black;  color: white; ">
        <div class="footer-copyright text-center py-3" style=" background-color:rgb(39, 38, 38) ;"> © 2019 Copyright:
            <a href="#" style=" color: white; "> PAOLA CIEZA PS XD</a>
        </div>
    </footer>
</body>

</html>