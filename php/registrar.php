<?php
require_once("conexion.php");

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
        $sexo = 'false';
    } else{
        $sexo = 'true';
    }
    $sql= "INSERT INTO cliente VALUES ((select coalesce(max(id),0)+1 from cliente), '$nombre', 
    '$apellidos', '$dni','$fecha', $sexo, '$correo', '$usuario', '$contraseña', DEFAULT, DEFAULT, DEFAULT);";
    $resp=1;
    $cnx -> query($sql) or $resp=$sql;

}else{
    $resp = 2;
}


echo $resp;

// header("location: ../index.html");

?>