<?php
require_once("conexion.php");
$sql="SELECT * FROM producto";
$ResultSet = $cnx->query($sql);
$cantreg = $ResultSet->rowCount();
$crxp=10;
$cantpag = ceil($cantreg/$crxp);
for($i=1;$i<=$cantpag;$i++){
	echo " <a href='#' class='btn btn-warning' onclick='listado(1,$i)'> $i </a> ";
}
?>