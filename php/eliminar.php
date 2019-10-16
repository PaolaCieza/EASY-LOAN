<?php
require_once("conexion.php");
$id = $_POST['idproducto'];
$sql="DELETE FROM producto WHERE idproducto='$id'";
$resp=1;
$cnx->query($sql) or $resp=0;



echo $resp;
?>