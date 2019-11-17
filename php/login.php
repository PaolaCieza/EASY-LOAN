<?php
require_once("conexion.php");
$a = $_POST['a'];
if($a == 1){
	$usuario = $_POST['txtuser'];
	$sql = "SELECT * FROM cliente WHERE usuario ='$usuario' ";
	$rs = $cnx->query($sql) or die($sql);
	$cantidad_registros = $rs->rowCount();		
	if($cantidad_registros==1) {
		session_start();
		$registro = $rs->fetchObject();
		$_SESSION['usuario']=$registro->usuario;
		echo 1;
	}
	else{
		echo 2;
	}
}
else{
	$passw = $_POST['txtpass'];	
	session_start();
	$usuario = $_SESSION['usuario'];
	$sql = "SELECT * FROM cliente where usuario = '$usuario' and clave = '$passw'";	
	$rs = $cnx->query($sql) or die($sql);
	$cantidad_registros = $rs->rowCount();
	if($cantidad_registros==1) 
	{
		$registro = $rs->fetchObject();
		$_SESSION['idusuario']=$registro->idcliente;
		$_SESSION['usuario']=$registro->usuario;	
		$_SESSION['foto']=$registro->fotousuario;	
		$_SESSION['nombre']=$registro->nombre;	
		echo 1;				
	}
	else{
		//session_start();  
    	//unset($_SESSION['usuario']);
		//session_destroy();
		echo 2;
	}
}

?>
