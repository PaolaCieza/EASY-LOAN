<?php
require_once("conexion.php");
$a = $_POST['a'];
if($a == 1){
	$usuario = $_POST['txtuser'];
	$sentencia = $cnx->prepare("SELECT * FROM cliente WHERE usuario = ? and vigencia=true");
	$sentencia->bindParam(1, $usuario); 
	$sentencia->execute() or die($sentencia);
	//$sql = "SELECT * FROM cliente WHERE usuario ='$usuario' and vigencia=true";
	$cantidad_registros = $sentencia->rowCount();		
	if($cantidad_registros==1) {
		session_start();
		$registro = $sentencia->fetchObject();
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
	$sentencia = $cnx->prepare("SELECT *,(case when tipoacceso=true then 'cliente'  else 'admin' end) as acceso
	FROM cliente where usuario = ? and clave = ? and vigencia=true");
	$sentencia->bindParam(1, $usuario); 
	$sentencia->bindParam(2, $passw); 
	$sentencia->execute() or die($sentencia);
	/*$sql = "SELECT *,(case when tipoacceso=true then 'cliente'  else 'admin' end) as acceso
	 FROM cliente where usuario = '$usuario' and clave = '$passw' and vigencia=true";	
	$rs = $cnx->query($sql) or die($sql);
	*/
	$cantidad_registros = $sentencia->rowCount();
	if($cantidad_registros==1) 
	{
		$registro = $sentencia->fetchObject();
		$_SESSION['idusuario']=$registro->idcliente;
		$_SESSION['usuario']=$registro->usuario;
		$_SESSION['acceso']=$registro->acceso;	
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
