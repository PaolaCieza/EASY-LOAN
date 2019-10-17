<?php
require_once("conexion.php");

$usuario = $_POST["txtusuario"];

$sql= "SELECT * FROM cliente where usuario = '$usuario'";

$rs = $cnx -> query($sql);

if ($rs == null) {
    echo('fallo');
}

if ($rs -> rowCount() == 1) {
    session_start();
    $_SESSION['usuario'] = $usuario;
    header("location: ../html/iniciarsesion2.html");
} else{
    header("location: ../html/iniciarsesion.html");
}

 ?>