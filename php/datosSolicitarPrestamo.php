<?php
require_once("conexion.php");
session_start();
$idcliente = $_SESSION['idusuario'];
$sql= "SELECT * from cliente c where c.idcliente=$idcliente";
$result = $cnx->query($sql);
if($reg = $result->fetchObject()){
     echo json_encode([$reg->dni,$reg->email]);
}
                                           