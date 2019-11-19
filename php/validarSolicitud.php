<?php
require_once("conexion.php");
session_start();
$idcliente = $_SESSION['idusuario'];
$sql= "SELECT montomax from cliente c inner join nivel n on c.idnivel=n.idnivel where c.idcliente=$idcliente";
$result = $cnx->query($sql);
if($reg = $result->fetchObject()){
     echo $reg->montomax;
}