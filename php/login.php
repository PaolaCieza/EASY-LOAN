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


/*

if($a == 1){
	$usuario = $_POST['txtuser'];
	$sql = "SELECT * FROM usuario 
	WHERE usuario='$usuario'";
	$rs = $cnx->query($sql) or die($sql);
	$cantreg = $rs->rowCount();		
	if($cantreg==1) {
		session_start();
		$reg = $rs->fetchObject();
		$_SESSION['usuario']=$reg->usuario;
		echo 1;
	}
	else{
		echo 2;
	}
	
}
else{
	$passw = md5($_POST['txtpass']);	
	session_start();
	$usuario = $_SESSION['usuario'];
	$sql = "SELECT * FROM usuario 
	WHERE  password = '$passw' and usuario ='$usuario'";	
	$rs = $cnx->query($sql) or die($sql);
	$cantreg = $rs->rowCount();
	if($cantreg==1) 
	{
		$reg = $rs->fetchObject();
		$_SESSION['idusuario']=$reg->idusuario;
		$_SESSION['usuario']=$reg->usuario;	
		echo 1;				
	}
	else{
		//session_start();  
    	//unset($_SESSION['usuario']);
		//session_destroy();
		echo 2;
	}
}

*/


 ?>