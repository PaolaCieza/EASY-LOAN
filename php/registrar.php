<?php
require_once("conexion.php");
$val = $_POST['validar'];
if($val == 1){
    $usuario = $_POST['txtusuario'];
    $sql = "SELECT * FROM cliente WHERE usuario ='$usuario' ";
	$rs = $cnx->query($sql) or die($sql);
	$cantidad_registros = $rs->rowCount();		
	if($cantidad_registros > 0) {
		echo 1;
	}
	else{
		echo 0;
	}
}
else{
    $nombre = $_POST['txtnombre'];
    $apellidos = $_POST['txtapellidos'];
    $dni = $_POST['txtdni'];
    $fecha = $_POST['txtfecha'];
    $sexo = $_POST['txtsexo'];
    $correo = $_POST['txtcorreo'];
    $usuario = $_POST['txtusuario'];
    $contraseña = $_POST['txtcontraseña'];
    
    $sql = "select date_part('year',age(current_date, '$fecha')) as edad;";
    $rs = $cnx->query($sql) ;
    $edad = $rs->fetchObject();
    if($edad->edad > 17){
        if ($sexo == 'femenino') {
            $sexo = false;
        } else{
            $sexo = true;
        }
        $sql= "INSERT INTO cliente VALUES ((select coalesce(max(idcliente),0)+1 from cliente), '$nombre', '$apellidos', '$dni','$fecha', '$sexo', '$correo', '$usuario', '$contraseña', DEFAULT, DEFAULT, DEFAULT);";
        $resp = 1;
        $cnx->query($sql); //or $resp=100;
        echo $resp;
    
    }else{
        echo 2;
    }
}


// header("location: ../index.html");

?>