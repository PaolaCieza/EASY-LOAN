<?php
require_once("conexion.php");
session_start();
$id = $_SESSION['idusuario'];
$sentencia = $cnx->prepare("SELECT fn_validar_solicitud(?)");
$valor = $id;
$sentencia->bindParam(1, $valor); 
$sentencia->execute();
if($sentencia->fetchObject()->fn_validar_solicitud===true){
    echo 1;
}
else{
    echo 0;
}