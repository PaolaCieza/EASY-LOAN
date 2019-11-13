<?php
require_once("conexion.php");
session_start();
$usuario = $_SESSION['usuario'];
$sql="SELECT * FROM cliente WHERE usuario='$usuario'";
$res = $cnx->query($sql);
$reg = $res->fetchObject();

echo json_encode($reg);
?>