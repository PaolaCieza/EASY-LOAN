<?php
require_once("conexion.php");

$nombre = $_POST["txtnombre"];
$apellidos = $_POST["txtapellidos"];
$dni = $_POST["txtdni"];
$fecha = $_POST["txtfecha"];
$sexo = $_POST["txtsexo"];
$correo = $_POST["txtcorreo"];
$usuario = $_POST["txtusuario"];
$contraseña = $_POST["txtcontraseña"];

if ($sexo = 'masculino') {
    $sexo = true;
} else{
    $sexo = false;
}

$sql= "INSERT INTO cliente VALUES ((select coalesce(max(id),0)+1 from usuario), '$nombre', '$apellidos', '$dni',
							'$fecha', '$sexo', '$correo', '$usuario', '$contraseña', DEFAULT, DEFAULT, DEFAULT);";

$rs = $cnx -> query($sql);

header("location: ../index.html");

?>