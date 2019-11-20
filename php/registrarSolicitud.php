<?php
require_once("conexion.php");
session_start();
$id = $_SESSION['idusuario'];
$monto = $_POST['monto'];
$periodo = $_POST['periodo'];
$cuotas = $_POST['cuotas'];
$sentencia = $cnx->prepare("INSERT INTO public.solicitud(
	idsolicitud, idcliente, fecha, hora, estado, monto, periodo, vencimiento, numerocuotas)
	VALUES ((select coalesce(max(idsolicitud),0)+1 from solicitud), ?, DEFAULT, DEFAULT, null, ?, ?, DEFAULT, ?);");
$sentencia->bindParam(1, $id);
$sentencia->bindParam(2, $monto);
$sentencia->bindParam(3, $periodo);
$sentencia->bindParam(4, $cuotas);
$resp = 1;
$sentencia->execute() or $resp = 0;
echo $resp;