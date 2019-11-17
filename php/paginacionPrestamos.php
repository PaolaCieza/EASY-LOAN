<?php
require_once("conexion.php");
session_start();
$idcliente = $_SESSION['idusuario'];
$sql="SELECT * from prestamo p inner join respuesta r on p.idrespuesta=r.idrespuesta 
inner join solicitud s on r.idsolicitud=s.idsolicitud
inner join cliente c on r.idcliente=c.idcliente
where s.idCliente=$idcliente";
$result = $cnx->query($sql);
$cantreg = $result->rowCount();
$crxp=10;
$cantpag = ceil($cantreg/$crxp);
for($i=1;$i<=$cantpag;$i++){
	echo " <a href='#' class='btn btn-warning' onclick='listarPrestamos($i)'> $i </a> ";
}
?>