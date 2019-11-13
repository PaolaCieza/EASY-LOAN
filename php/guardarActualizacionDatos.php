<?php
require_once("conexion.php");
session_start();
$usuario = $_SESSION['usuario'];
$nombre = $_POST['txtnombre'];
$apellidos = $_POST['txtapellidos'];
$dni = $_POST['txtdni'];
$fecha = $_POST['txtfecha'];
$sexo = $_POST['txtsexo'];
$correo = $_POST['txtcorreo'];
$usuario = $_POST['txtusuario'];
$contraseña = $_POST['txtcontraseña'];
$sql="UPDATE cliente SET nombre=$nombre, apellido=$apellidos, dni=$dni, fecha_nac=$fecha, sexo=$sexo, email=$correo, usuario=?, 
        clave=?, fotousuario=? WHERE usuario=$usuario";
$res = $cnx->query($sql);
$reg = $res->fetchObject();

echo json_encode($reg);
?>