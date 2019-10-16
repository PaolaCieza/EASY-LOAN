<?php
require_once("conexion.php");

$id = $_POST["id"];

$sql="select * from producto where idproducto = '$id'";
$resultSet = $cnx->query($sql);

$registro = $resultSet -> fetchObject();

echo json_encode($registro);


?>