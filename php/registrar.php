<?php
require_once("conexion.php");

$nombre = $_POST["txtnombre"];
$apellidos = $_POST["txtapellidos"];
$sexo = $_POST["txtsexo"];
$correo = $_POST["txtcorreo"];
$usuario = $_POST["txtusuario"];
$contraseña = $_POST["txtcontraseña"];

if ($sexo = 'masculino') {
    $sexo = true;
} else{
    $sexo = false;
}

$sql= "INSERT INTO persona values(DEFAULT, '$nombre', '$apellidos','$sexo','$correo','$usuario','$contraseña')";

$rs = $cnx -> query($sql);

header("location: ../index.html");




?>