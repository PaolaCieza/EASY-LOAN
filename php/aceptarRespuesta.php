<?php
require_once("conexion.php");
$id = $_POST['id'];
$sentencia = $cnx->prepare("SELECT fn_aceptar_respuesta(?)");
$valor = $id;
$sentencia->bindParam(1, $valor); 
$sentencia->execute();
if($sentencia->fetchObject()->fn_aceptar_respuesta===true){
    echo 1;
}
else{
    echo 0;
}
