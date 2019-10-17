<?php
require_once("conexion.php");

session_start();
$usuario = $_SESSION['usuario'];
$contrasena = $_POST["txtcontraseña"];

$sql= "SELECT * FROM cliente where usuario = '$usuario' and clave = '$contrasena'";

$rs = $cnx -> query($sql);

$numerointentos = 0;

if ($rs -> rowCount() == 1) {
    session_start();
    header("location: ../index.html");
} else{
        header("location: ../html/iniciarsesion2.html");
}

 ?>