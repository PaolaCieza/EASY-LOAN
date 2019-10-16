<?php
require_once("conexion.php");
	$sql="SELECT * FROM usuario";
	$result = $cnx->query($sql);
	
	while($reg = $result->fetchObject()){
        var_dump($reg);
	}