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
        window.ready = listarClientes();
    </script>
    <title>MANTENIMIENTO CLIENTE</title>
</head>

<body class="bg-lightd">
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
                        MANTENIMIENTO USUARIO
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
    <section class="container mt-5 p-0">
        
        <div class="row">
            <div class=" col-md-2 mr-1">
                <select name="selectorC" id="selectorC" class="btn btn-outline-purple">
                    <!--<option value="" disabled selected>SELECCIONAR</option>-->
                    <option value="1" selected>DNI</option>
                    <option value="2">NOMBRE</option>
                    <option value="3">USUARIO</option>
                </select>
            </div>
            <div class="col-md-8">
                <input class="form-control mr-sm-2 " onkeyup="buscarCliente()" type="search" placeholder="BUSCAR" id="buscar"aria-label="Search">
            </div>

            <div class=" col-lg-2 row justify-content-end">
                <button class="btn btn-outline-dark m-1 text-warning " type="button" data-toggle="modal"
                    data-target="#modalClientesBaja" data-whatever="@mdo" onclick="listarDadosBaja()">DADOS DE BAJA</button>
            </div>
        </div>
        <div id="clientes">

        </div>
        <br><br><br>
    </section>

    <!--  BOTÓN CON MODAL DE CONTACTO -->
    <div class="modal fade" id="modalContactar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-monospace text-purple" id="exampleModalLabel">CONTACTO
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="contacto">
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple">PDF</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BOTÓN CON MODAL DE CONTACTO -->






    <!--  BOTÓN CON MODAL DE PRESTATARIO-->
    <div class="modal fade" id="modalPrestatario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-monospace text-purple" id="exampleModalLabel">LOS PRESTAMOS QUE PEDISTE
                    </h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 mb-2">
                        <input
                            class="form-control m-3 form-control-range border-top-0 border-left-0 border-right-0 border-info"
                            type="search" placeholder="BUSCAR PRESTAMISTA" aria-label="Search" id="txtPrestamista" onkeyup="buscarPrestatario()">
                    </div>
                    <div class="row m-2">
                        <button type="button" class="btn bg-transparent  dropdown-toggle font-weight-bold"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ORDENAR POR: </label>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item " onclick="filtrarPrestatario(0)">TODO</button>
                            <button class="dropdown-item " onclick="filtrarPrestatario(1)">MONTO MENOR</button>
                            <button class="dropdown-item " onclick="filtrarPrestatario(2)">MONTO MAYOR</button>
                            <button class="dropdown-item " onclick="filtrarPrestatario(3)">PENDIENTE</button>
                            <button class="dropdown-item " onclick="filtrarPrestatario(4)">PAGADOS</button>
                        </div>
                    </div>

                    <form id="prestatario">
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple">PDF</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BOTÓN CON MODAL DE PRESTATARIO -->




    <!--  BOTÓN CON MODAL DE PRESTAMISTA-->
    <div class="modal fade" id="modalPrestamista" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-monospace text-purple" id="exampleModalLabel">LOS PRESTAMOS QUE
                        OFRECISTE</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2 mb-2">
                        <input
                            class="form-control m-3 form-control-range border-top-0 border-left-0 border-right-0 border-success"
                            type="search" placeholder="BUSCAR PRESTATARIO" id="txtPrestatario" onkeyup="buscarPrestamista()" aria-label="Search">
                    </div>
                    <div class="row m-2">
                        <button type="button" class="btn bg-transparent  dropdown-toggle font-weight-bold"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ORDENAR POR: </label>
                        </button>
                        <div class="dropdown-menu">
                            <button class="dropdown-item " onclick="filtrarPrestamista(0)">TODO</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(1)">RECIENTES</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(2)">ANTIGUOS</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(3)">MONTO MENOR</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(4)">MONTO MAYOR</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(5)">PENDIENTE</button>
                            <button class="dropdown-item " onclick="filtrarPrestamista(6)">PAGADOS</button>
                        </div>
                    </div>

                    <form id="prestamista">
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-purple">PDF</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN BOTÓN CON MODAL DE PRESTAMISTA -->

    <!--  BOTÓN CON MODAL DE LISTAR CLIENTES DADOS DE BAJA-->
    <div class="modal fade  " id="modalClientesBaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h1 class="modal-title" id="exampleModalLabel" class="text-lowercase">CLIENTES DADOS DE BAJA</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 mr-5">
                            <select  class="btn btn-outline-purple" name="opcionBaja">
                                <option value="0" disabled selected>SELECCIONAR</option>
                                <option value="1">DNI</option>
                                <option value="2">NOMBRE</option>
                                <option value="3">USUARIO</option>
                            </select>
                        </div>
                        <div class="col-lg-7 mb-3 align-content-end">
                            <input class="form-control mr-sm-2 " type="search" placeholder="BUSCAR" aria-label="Search" id="buscarBaja" onkeyup="buscarDadoBaja()">
                        </div>
                    </div>
                    <form>
                        <table class="table table-responsive  table-striped table-warning">
                            <thead class="">
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIDO</th>
                                    <th>DNI</th>
                                    <th>NIVEL</th>
                                    <th>USUARIO</th>
                                    <th>PDF</th>
                                </tr>
                            </thead>
                            <tbody id="listaDadosDeBaja">

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








    <footer class="page-footer font-small unique-color-dark fixed-bottom"
        style="background-color: black;  color: white; ">
        <div class="footer-copyright text-center py-3" style=" background-color:rgb(39, 38, 38) ;"> © 2019 Copyright:
            <a href="#" style=" color: white; "> PAOLA CIEZA PS XD</a>
        </div>
    </footer>
</body>

</html>