<?php
require_once("conexion.php");
	$usuario = "fernando10";
	$sentencia = $cnx->prepare("SELECT * FROM cliente WHERE usuario = ? and vigencia=true");
	$sentencia->bindParam(1, $usuario); 
	$sentencia->execute();
	echo($sentencia->rowCount());
	//while($reg = $sentencia->fetchObject()){
      //  var_dump($reg->idcliente);
	//}